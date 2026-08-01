<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class PaymentController extends Controller
{
    protected StripeService $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Generate Stripe PaymentIntent for a given order.
     */
    public function createIntent(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::with('product')->find($request->order_id);

        if (!$order) {
            return response()->json(['message' => __('Order not found')], 404);
        }

        if ($order->orderBy !== Auth::id() && Auth::user()->role !== 'admin') {
            return response()->json(['message' => __('Unauthorized order access')], 403);
        }

        try {
            $intentData = $this->stripeService->createPaymentIntent($order);
            return response()->json([
                'status' => 'success',
                'data' => $intentData,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Confirm PaymentIntent status directly with Stripe.
     */
    public function confirmStatus(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
        ]);

        try {
            $result = $this->stripeService->confirmStatus($request->payment_intent_id);
            return response()->json([
                'status' => 'success',
                'data' => $result,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Process Stripe webhook notifications.
     */
    public function webhook(Request $request)
    {
        try {
            $result = $this->stripeService->handleWebhook($request);
            return response()->json($result, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
