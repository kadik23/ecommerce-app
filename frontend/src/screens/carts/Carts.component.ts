import { CartItemVue } from '@/components/cart_item';
import { defineComponent, ref, computed } from 'vue';

interface CartItem {
    id: string;
    name: string;
    price: number;
    description: string;
    profileImage: string;
}

export default defineComponent({
    name: 'Cart',
    components: {
        CartItemVue// Lazy-load the component
    },
    setup() {
        const carts = ref<CartItem[]>([
            { id: '1', name: 'Product 1', price: 100, description: 'Description 1', profileImage: 'image1.jpg' },
            { id: '2', name: 'Product 2', price: 200, description: 'Description 2', profileImage: 'image2.jpg' },
        ]);
        const quantities = ref<Record<string, number>>({});

        const totalPrice = computed(() => {
            return carts.value.reduce((total, cart) => total + cart.price * (quantities.value[cart.id] || 1), 0);
        });

        const incrementQuantity = (id: string) => {
            if (!quantities.value[id]) quantities.value[id] = 1;
            quantities.value[id]++;
        };

        const decrementQuantity = (id: string) => {
            if (!quantities.value[id]) quantities.value[id] = 1;
            if (quantities.value[id] > 1) quantities.value[id]--;
        };

        const submitOrder = () => {
            // Handle form submission
            console.log('Order submitted');
        };

        return {
            carts,
            quantities,
            totalPrice,
            incrementQuantity,
            decrementQuantity,
            submitOrder
        };
    }
});