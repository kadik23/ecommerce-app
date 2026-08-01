import RestOrders from '@/libs/RestOrders';
import UserSessionRepository from '@/libs/UserSessionRepository';
import { loadStripe, type Stripe, type StripeElements } from '@stripe/stripe-js';
import type { AxiosInstance } from 'axios';
import { defineComponent, inject, nextTick, onMounted, ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRoute, useRouter } from 'vue-router';

export default defineComponent({
    name: 'Payment',
    setup() {
        const { t, locale } = useI18n();
        const order = ref<OrderEntity>();
        const isLoading = ref<boolean>(true);
        const isProcessing = ref<boolean>(false);
        const errorMessage = ref<string>('');
        const successMessage = ref<string>('');
        const clientSecret = ref<string>('');
        const paymentCurrency = ref<string>('DZD');
        const paymentAmount = ref<number>(0);

        let stripe: Stripe | null = null;
        let elements: StripeElements | null = null;

        const axios = inject<AxiosInstance>('axios');
        const userSessionRepository = new UserSessionRepository(localStorage);
        const access_token = userSessionRepository.getAccessToken();
        const restOrders: IRestOrders =new RestOrders(axios as AxiosInstance)
        const route = useRoute();
        const router = useRouter();
        const id = route.params.id as string;

        const stripeKey = import.meta.env.VITE_STRIPE_KEY || 'pk_test_51Tzat3RbiXfAKUL625bk5COvyfjEhUoFSg2f6B27WQIj3E8ZxPpI0NWJkzuOaQp7E6Gwu4piIjKH5D0tmrxjO7eE00Wq5zuVQ9';

        const initializeStripe = async () => {
            try {
                isLoading.value = true;
                errorMessage.value = '';

                if (!access_token) {
                    errorMessage.value = t('payment.session_expired');
                    return;
                }

                // 1. Fetch order details
                const response: any = await restOrders.getOrderById(id, access_token);
                if (response && response.data) {
                    order.value = response.data;
                } else if (response) {
                    order.value = response;
                }

                if (!order.value) {
                    errorMessage.value = t('payment.order_not_found');
                    return;
                }

                if (order.value.state === 'complete') {
                    successMessage.value = t('payment.already_paid');
                    setTimeout(() => {
                        router.push(`/order-preview/${id}`);
                    }, 2000);
                    return;
                }

                // 2. Request Stripe PaymentIntent from backend
                const intentRes = await restOrders.createPaymentIntent(id, access_token);
                if (intentRes && intentRes.status === 'success' && intentRes.data) {
                    clientSecret.value = intentRes.data.client_secret;
                    paymentCurrency.value = intentRes.data.currency || 'DZD';
                    paymentAmount.value = intentRes.data.amount || (order.value.quantity * (order.value.product?.price || 0));

                    // 3. Initialize Stripe.js and Elements with localized language & custom brand appearance
                    stripe = await loadStripe(stripeKey);
                    if (!stripe) {
                        errorMessage.value = t('payment.gateway_sdk_error');
                        return;
                    }

                    const stripeLocale = (locale.value || 'en') === 'ar' ? 'ar' : 'en';

                    elements = stripe.elements({
                        clientSecret: clientSecret.value,
                        locale: stripeLocale as any,
                        appearance: {
                            theme: 'flat',
                            variables: {
                                colorPrimary: '#b17b4f',
                                colorBackground: '#ffffff',
                                colorText: '#1f2937',
                                colorDanger: '#ef4444',
                                fontFamily: 'Inter, system-ui, sans-serif',
                                borderRadius: '12px',
                            },
                        },
                    });

                    // Set isLoading to false FIRST so Vue renders the #payment-element container div in DOM
                    isLoading.value = false;
                    await nextTick();

                    const paymentElement = elements.create('payment');
                    paymentElement.mount('#payment-element');
                } else {
                    errorMessage.value = intentRes?.message || t('payment.init_failed');
                    isLoading.value = false;
                }
            } catch (err: any) {
                console.error(err);
                errorMessage.value = err?.response?.data?.message || err.message || t('payment.unexpected_error');
                isLoading.value = false;
            }
        };

        const handlePaymentSubmit = async () => {
            if (!stripe || !elements) {
                errorMessage.value = t('payment.not_initialized');
                return;
            }

            try {
                isProcessing.value = true;
                errorMessage.value = '';

                const { error, paymentIntent } = await stripe.confirmPayment({
                    elements,
                    confirmParams: {
                        return_url: `${window.location.origin}/order-preview/${id}`,
                    },
                    redirect: 'if_required',
                });

                if (error) {
                    errorMessage.value = error.message || t('payment.payment_failed_default');
                } else if (paymentIntent && paymentIntent.status === 'succeeded') {
                    // Confirm status on backend
                    if (access_token) {
                        await restOrders.confirmPaymentStatus(paymentIntent.id, access_token);
                    }
                    successMessage.value = t('payment.payment_succeeded');
                    setTimeout(() => {
                        router.push(`/order-preview/${id}`);
                    }, 1500);
                } else if (paymentIntent && paymentIntent.status === 'processing') {
                    successMessage.value = t('payment.payment_processing');
                    setTimeout(() => {
                        router.push(`/order-preview/${id}`);
                    }, 2000);
                }
            } catch (err: any) {
                console.error(err);
                errorMessage.value = err?.message || t('payment.unexpected_error');
            } finally {
                isProcessing.value = false;
            }
        };

        const retryPayment = () => {
            errorMessage.value = '';
            handlePaymentSubmit();
        };

        onMounted(initializeStripe);

        return {
            order,
            isLoading,
            isProcessing,
            errorMessage,
            successMessage,
            paymentCurrency,
            paymentAmount,
            handlePaymentSubmit,
            retryPayment,
        };
    },
});