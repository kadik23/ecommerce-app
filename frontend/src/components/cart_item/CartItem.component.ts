import { ref } from 'vue';
export default {
    props: {
    id: {
        type: String,
        required: true
    },
    productName: {
        type: String,
        required: true
    },
    price: {
        type: Number,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    img: {
        type: String,
        required: true
    }
    },
    emits: ['increment', 'decrement', 'remove'],
    setup(props: any, { emit }: any) {
        const quantity = ref(1);

        const incrementQuantity = () => {
            quantity.value++;
            emit('increment', props.id);
        };
    
        const decrementQuantity = () => {
        if (quantity.value > 1) {
            quantity.value--;
            emit('decrement', props.quantities);
        }
        };
    
        const removeItem = () => {
            emit('remove', props.quantities);
        };
    
        return {
            quantity,
            incrementQuantity,
            decrementQuantity,
            removeItem
        };
    }
}
