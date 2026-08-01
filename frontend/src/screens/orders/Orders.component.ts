import { ProcessCardVue } from '@/components/orders_components/process_card';
import { TagVue } from '@/components/orders_components/tag';
import { OrderSkeletonVue } from '@/components/skeleton';
import RestOrders from '@/libs/RestOrders';
import UserSessionRepository from '@/libs/UserSessionRepository';
import { type AxiosInstance } from 'axios';
import { defineComponent, inject, onMounted, ref } from 'vue';
import { useI18n } from 'vue-i18n';

type Istate = 'Processing' | 'Confirmed' | 'Paid' | 'Delivered' | string;

export default defineComponent({
    name: 'Orders',
    components: {
        TagVue,
        ProcessCardVue,
        OrderSkeletonVue
    },
    setup() {
        const { t } = useI18n();
        const orders = ref<OrderEntity[]>([]);
        const isLoading = ref<Boolean>(false)
        const axios = inject<AxiosInstance>('axios')
        const userSessionRepository = new UserSessionRepository(localStorage);
        const access_token = userSessionRepository.getAccessToken();
        const restOrders: IRestOrders = new RestOrders(axios as AxiosInstance)
        const currentStatus = ref<Istate>("Processing")
        const filteredOrders = ref<null | OrderEntity[]>(null)

        const changeCurrentState = (newState: Istate) => {
            currentStatus.value = newState;
            const stateStr = String(newState).toLowerCase();

            if (stateStr === 'processing' || stateStr === t('order.processing').toLowerCase()) {
                filteredOrders.value = orders.value.filter(or => or.state === 'processing' || or.state === 'pending');
            } else if (stateStr === 'confirmed' || stateStr === t('order.confirmed').toLowerCase()) {
                filteredOrders.value = orders.value.filter(or => or.state === 'confirm');
            } else if (stateStr === 'paid' || stateStr === t('order.paid').toLowerCase()) {
                filteredOrders.value = orders.value.filter(or => or.state === 'complete');
            } else if (stateStr === 'delivered' || stateStr === t('order.delivered').toLowerCase()) {
                filteredOrders.value = orders.value.filter(or => or.state === 'delivered');
            } else {
                filteredOrders.value = orders.value;
            }
        };

        const fetchOrders =async () => {
            try {
                isLoading.value = true
                if(access_token){
                    const response: any = await restOrders.getAll(access_token)
                    orders.value = response.data
                    // Initialize with Processing tab's condition
                    filteredOrders.value = orders.value.filter(or => or.state == 'processing' || or.state == 'pending')
                }
            } catch (err) {
                console.log(err)
            } finally {
                isLoading.value = false
            }
        }

        onMounted(fetchOrders);


        return {
            fetchOrders,
            isLoading,
            currentStatus,
            changeCurrentState,
            filteredOrders
        };
    }
});