import { defineComponent, type PropType } from 'vue';

export default defineComponent({
    props: {
        data: {
            type: Object as PropType<OrderEntity>,
            required: true,
        },
    },
    setup(props) {
        const dateObj = new Date(props.data.created_at);

        // Extract the date in 'YYYY-MM-DD' format
        const date = dateObj.toISOString().split('T')[0];

        // Extract the time in 'HH:MM:SS' format
        const time = dateObj.toTimeString().split(' ')[0];

        return {
            date, 
            time
        };
    }
});
