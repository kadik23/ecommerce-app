import { ProcessCardVue } from '@/components/orders_components/process_card';
import { TagVue } from '@/components/orders_components/tag';
import { defineComponent, ref } from 'vue';


interface OrderCard {
    id: number;
    status: 'Processing' | 'Shipped' | 'Delivered';
}

export default defineComponent({
    name: 'Orders',
    components: {
        TagVue,
        ProcessCardVue
    },
    setup() {
        const orders = ref<OrderCard[]>([
            { id: 1, status: 'Processing',},
            { id: 2, status: 'Shipped',},
            { id: 3, status: 'Delivered',},
        ]);
        return {
            orders,
        };
    }
});