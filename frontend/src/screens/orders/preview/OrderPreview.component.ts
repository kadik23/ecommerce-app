import { ProcessCardVue } from '@/components/orders_components/process_card';
import { TagVue } from '@/components/orders_components/tag';
import RestOrders from '@/libs/RestOrders';
import UserSessionRepository from '@/libs/UserSessionRepository';
import { type AxiosInstance } from 'axios';
import { defineComponent, inject, onMounted, ref, computed } from 'vue';
import { useRoute } from 'vue-router';

type Istate = 'Processing' | 'Shipped' | 'Delivered'

export default defineComponent({
    name: 'Orders',
    components: {
        TagVue,
        ProcessCardVue,
    },
    setup() {
        const order = ref<OrderEntity>();
        const isLoading = ref<boolean>(false)
        const axios = inject<AxiosInstance>('axios')
        const userSessionRepository = new UserSessionRepository(localStorage);
        const access_token = userSessionRepository.getAccessToken();
        const restOrders: IRestOrders = new RestOrders(axios as AxiosInstance)
        const route = useRoute();
        const id = route.params.id;
        const fetchOrderById =async () => {
            try {
                isLoading.value = true
                if(access_token){
                    const response: any = await restOrders.getOrderById(id as string,access_token)
                    if(response.data){
                        order.value = response.data
                    }
                }
            } catch (err) {
                console.log(err)
            } finally {
                isLoading.value = false
            }
        };

        const formatDate = (dateStr?: string | Date) => {
            if (!dateStr) return '';
            try {
                const date = new Date(dateStr);
                return date.toLocaleDateString(undefined, {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                });
            } catch {
                return String(dateStr).split('T')[0] || '';
            }
        };

        const formatTime = (dateStr?: string | Date) => {
            if (!dateStr) return '';
            try {
                const date = new Date(dateStr);
                return date.toLocaleTimeString(undefined, {
                    hour: '2-digit',
                    minute: '2-digit',
                });
            } catch {
                return '';
            }
        };

        const isStepActive = (stepState: 'sent' | 'confirmed' | 'paid' | 'delivered') => {
            if (!order.value || !order.value.state) return false;
            const currentState = order.value.state.toLowerCase();
            switch (stepState) {
                case 'sent':
                    return ['pending', 'confirm', 'processing', 'complete', 'delivered'].includes(currentState);
                case 'confirmed':
                    return ['confirm', 'processing', 'complete', 'delivered'].includes(currentState);
                case 'paid':
                    return ['complete', 'delivered'].includes(currentState);
                case 'delivered':
                    return currentState === 'delivered';
                default:
                    return false;
            }
        };

        const getStepDataContent = (stepState: 'sent' | 'confirmed' | 'paid' | 'delivered') => {
            return isStepActive(stepState) ? '✓' : undefined;
        };

        const stateBadgeClass = computed(() => {
            if (!order.value || !order.value.state) return 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
            const s = order.value.state.toLowerCase();
            if (s === 'complete' || s === 'delivered') return 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200/80 dark:border-emerald-800/50';
            if (s === 'confirm' || s === 'processing') return 'bg-blue-100 text-blue-800 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200/80 dark:border-blue-800/50';
            if (s === 'pending') return 'bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200/80 dark:border-amber-800/50';
            if (s === 'canceled') return 'bg-rose-100 text-rose-800 dark:bg-rose-950/60 dark:text-rose-300 border border-rose-200/80 dark:border-rose-800/50';
            return 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300';
        });

        const timelineSteps: Array<{ key: 'sent' | 'confirmed' | 'paid' | 'delivered'; labelKey: string }> = [
            { key: 'sent', labelKey: 'order_preview.sent' },
            { key: 'confirmed', labelKey: 'order_preview.confirmed' },
            { key: 'paid', labelKey: 'order_preview.paid' },
            { key: 'delivered', labelKey: 'order_preview.delivered' },
        ];

        onMounted(fetchOrderById);

        return {
            isLoading,
            order,
            formatDate,
            formatTime,
            isStepActive,
            getStepDataContent,
            stateBadgeClass,
            timelineSteps,
        };
    }
});