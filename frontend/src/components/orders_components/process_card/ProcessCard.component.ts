import { defineComponent, ref, type PropType } from 'vue';

export default defineComponent({
    props: {
        data: {
            type: Object as PropType<OrderEntity>,
            required: true,
        },
    },
});
