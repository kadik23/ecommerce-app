import { ProcessCardVue } from '@/components/orders_components/process_card';
import { TagVue } from '@/components/orders_components/tag';
import RestOrders from '@/libs/RestOrders';
import UserSessionRepository from '@/libs/UserSessionRepository';
import { type AxiosInstance } from 'axios';
import { defineComponent, inject, onMounted, ref } from 'vue';
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
        const isLoading = ref<Boolean>(false)
        const axios = inject<AxiosInstance>('axios')
        const userSessionRepository = new UserSessionRepository(localStorage);
        const access_token = userSessionRepository.getAccessToken();
        const restOrders: IRestOrders =new RestOrders(axios as AxiosInstance)
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
        }

        onMounted(fetchOrderById);

        return {
            isLoading,
            order
        };
    }
});