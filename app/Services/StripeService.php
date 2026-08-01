<?php

namespace App\Services;

use App\Models\Order;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\Webhook;
use Exception;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe PaymentIntent for an Order.
     */
    public function createPaymentIntent(Order $order): array
    {
        $order->loadMissing('product');

        if (!$order->product) {
            throw new Exception('Order product not found.');
        }

        $unitPrice = (float) $order->product->price;
        $quantity = (int) $order->quantity;
        $totalAmount = $unitPrice * $quantity;
        $amountCents = (int) round($totalAmount * 100);

        $currency = strtolower(config('services.stripe.currency', 'dzd'));

        $intent = PaymentIntent::create([
            'amount' => $amountCents,
            'currency' => $currency,
            'metadata' => [
                'order_id' => (string) $order->id,
                'user_id' => (string) $order->orderBy,
                'product_id' => (string) $order->productOrdered,
                'product_name' => (string) $order->product->name,
                'quantity' => (string) $order->quantity,
            ],
            'description' => "Order #{$order->id} - {$order->product->name} (x{$order->quantity})",
        ]);

        return [
            'client_secret' => $intent->client_secret,
            'payment_intent_id' => $intent->id,
            'amount' => $totalAmount,
            'currency' => strtoupper($currency),
        ];
    }

    /**
     * Complete an order and record wallet transaction upon successful payment.
     */
    public function handlePaymentSuccess(PaymentIntent $intent): ?Order
    {
        $orderId = $intent->metadata->order_id ?? null;

        if (!$orderId) {
            Log::warning('Stripe PaymentIntent missing order_id metadata.', ['intent_id' => $intent->id]);
            return null;
        }

        $order = Order::find($orderId);

        if (!$order) {
            Log::error('Stripe PaymentIntent order not found.', ['order_id' => $orderId]);
            return null;
        }

        // Update order state to complete/paid
        $order->state = 'complete';
        $order->save();

        WalletTransaction::updateOrCreate(
            ['idempotency_key' => $intent->id],
            [
                'user_id' => $order->orderBy,
                'order_id' => $order->id,
                'amount' => ((float) $intent->amount) / 100,
                'type' => 'order_payment',
                'payment_info' => [
                    'payment_intent_id' => $intent->id,
                    'status' => $intent->status,
                    'currency' => strtoupper($intent->currency),
                    'payment_method_types' => $intent->payment_method_types,
                    'latest_charge' => $intent->latest_charge ?? null,
                    'client_secret' => $intent->client_secret ?? null,
                    'recorded_at' => now()->toIso8601String(),
                ],
            ]
        );

        return $order;
    }

    /**
     * Handle incoming Stripe webhook payload.
     */
    public function handleWebhook(Request $request): array
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            if ($webhookSecret && $sigHeader && !str_contains($webhookSecret, 'whsec_test')) {
                $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
            } else {
                $event = json_decode($payload);
            }
        } catch (Exception $e) {
            Log::error('Stripe Webhook Signature Verification Failed: ' . $e->getMessage());
            throw new Exception('Webhook signature verification failed: ' . $e->getMessage());
        }

        $eventType = $event->type ?? null;

        if ($eventType === 'payment_intent.succeeded') {
            /** @var PaymentIntent $intent */
            $intent = $event->data->object;
            $this->handlePaymentSuccess($intent);
            return ['status' => 'success', 'message' => 'Payment recorded successfully'];
        }

        if ($eventType === 'payment_intent.payment_failed') {
            $intent = $event->data->object;
            Log::warning('Stripe Payment Failed.', ['intent_id' => $intent->id ?? null]);
            return ['status' => 'failed', 'message' => 'Payment attempt failed'];
        }

        return ['status' => 'ignored', 'message' => "Unhandled event type: {$eventType}"];
    }

    /**
     * Retrieve PaymentIntent status directly from Stripe API for verification fallback.
     */
    public function confirmStatus(string $paymentIntentId): array
    {
        $intent = PaymentIntent::retrieve($paymentIntentId);

        if ($intent->status === 'succeeded') {
            $order = $this->handlePaymentSuccess($intent);
            return [
                'status' => 'succeeded',
                'order' => $order,
            ];
        }

        return [
            'status' => $intent->status,
            'order' => null,
        ];
    }
}
