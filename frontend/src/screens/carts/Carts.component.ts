import { CartItemVue } from '@/components/cart_item';
import RestCarts from '@/libs/RestCarts';
import axios from 'axios';
import { defineComponent, ref, computed, onMounted } from 'vue';

export default defineComponent({
    name: 'Cart',
    components: {
        CartItemVue// Lazy-load the component
    },
    setup() {
        const carts = ref<CartEntity[]>([]);
        const isLoading = ref(false);
        const restCarts: IRestCarts =new RestCarts(axios)

        const fetchCarts =async () => {
            try {
                isLoading.value = true
                carts.value = await restCarts.getAll()
            } catch (err) {
                console.log(err)
            }
        }

        onMounted(fetchCarts);

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
            submitOrder,
            isLoading
        };
    }
});