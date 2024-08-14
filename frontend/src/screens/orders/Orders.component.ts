import { ProcessCardVue } from '@/components/orders_components/process_card';
import { TagVue } from '@/components/orders_components/tag';
import RestOrders from '@/libs/RestOrders';
import UserSessionRepository from '@/libs/UserSessionRepository';
import { type AxiosInstance } from 'axios';
import { defineComponent, inject, onMounted, ref } from 'vue';

type Istate = 'Processing' | 'Shipped' | 'Delivered'

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
        const currentStatus =ref<Istate>("Processing")
        const filteredOrders = ref<null | OrderEntity[]>(null)
        const changeCurrentState = (newState: Istate) => {
            currentStatus.value = newState
            if(newState == 'Processing'){
                filteredOrders.value = orders.value.filter(or => or.state == 'confirm' || or.state == 'pending')
            }else if(newState == 'Shipped'){
                filteredOrders.value = orders.value.filter(or => or.state == 'complete' )
            }else{
                filteredOrders.value = orders.value.filter(or => or.state == 'canceled' )
            }
        }

        const fetchOrders =async () => {
            try {
                isLoading.value = true
                if(access_token){
                    const response: any = await restOrders.getAll(access_token)
                    orders.value = response.data
                    filteredOrders.value = orders.value.filter(or => or.state == 'confirm' || or.state == 'complete')
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