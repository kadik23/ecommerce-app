import { ProcessCardVue } from '@/components/orders_components/process_card';
import { TagVue } from '@/components/orders_components/tag';
import RestOrders from '@/libs/RestOrders';
import axios from 'axios';
import { defineComponent, onMounted, ref } from 'vue';

export default defineComponent({
    name: 'Orders',
    components: {
        TagVue,
        ProcessCardVue,
    },
    setup() {
        const orders = ref<OrderEntity[]>([]);
        const isLoading = ref<Boolean>(false)

        const restOrders: IRestOrders =new RestOrders(axios)
        const fetchOrders =async () => {
            try {
                isLoading.value = true
                orders.value = await restOrders.getAll()
            } catch (err) {
                console.log(err)
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