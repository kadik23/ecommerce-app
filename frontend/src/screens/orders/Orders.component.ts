import { ProcessCardVue } from '@/components/orders_components/process_card';
import { TagVue } from '@/components/orders_components/tag';
import RestOrders from '@/libs/RestOrders';
import UserSessionRepository from '@/libs/UserSessionRepository';
import { type AxiosInstance } from 'axios';
import { defineComponent, inject, onMounted, ref } from 'vue';

export default defineComponent({
    name: 'Orders',
    components: {
        TagVue,
        ProcessCardVue,
    },
    setup() {
        const orders = ref<OrderEntity[]>([]);
        const isLoading = ref<Boolean>(false)
        const axios = inject<AxiosInstance>('axios')
        const userSessionRepository = new UserSessionRepository(localStorage);
        const access_token = userSessionRepository.getAccessToken();
        const restOrders: IRestOrders =new RestOrders(axios as AxiosInstance)
        
        const fetchOrders =async () => {
            try {
                isLoading.value = true
                if(access_token){
                    const response = await restOrders.getAll(access_token)
                    orders.value = response
                }
            } catch (err) {
                console.log(err)
            } finally {
                isLoading.value = false
            }
        }

        onMounted(fetchOrders);


        return {
            orders,
            fetchOrders,
            isLoading
        };
    }
});