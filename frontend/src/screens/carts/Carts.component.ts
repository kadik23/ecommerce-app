import { CartItemVue } from '@/components/cart_item';
import RestCarts from '@/libs/RestCarts';
import RestOrders from '@/libs/RestOrders';
import RestUserSession from '@/libs/RestUserSession';
import UserSessionRepository from '@/libs/UserSessionRepository';
import type { AxiosInstance } from 'axios';
import { defineComponent, ref, computed, onMounted, inject, type Ref } from 'vue';
import { useRouter } from 'vue-router';

export default defineComponent({
    name: 'Cart',
    components: {
        CartItemVue// Lazy-load the component
    },
    setup() {
        const carts = ref<CartEntity[]>([]);
        const isLoading = ref(false);
        const axios = inject<AxiosInstance>('axios')
        const restCarts: IRestCarts =new RestCarts(axios as AxiosInstance)
        const userSessionRepository = new UserSessionRepository(localStorage);
        const restUserSession = new RestUserSession(axios as AxiosInstance)
        const access_token = userSessionRepository.getAccessToken();
        const restOrder: IRestOrders =new RestOrders(axios as AxiosInstance)
        const quantities = ref<Record<string, number>>({});
        let toastManager = inject<Ref<IToastsManager>>("toastManager");
        const router = useRouter();

        const fetchCarts =async () => {
            try {
                isLoading.value = true
                const response = await restCarts.getAll(access_token as string)
                if(response.Carts){
                    carts.value = response.Carts
                    isLoading.value = false
                }
            } catch (err) {
                console.log(err)
                isLoading.value = false
            }
        }

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

        const submitOrder = async () => {
            try {
                if (access_token && carts.value.length > 0) {
                    isLoading.value = true;
                    const currentUser = await restUserSession.getCurrentUser(access_token);
                    const userId = currentUser.id;
        
                    // Prepare the order data
                    const orders: OrderEntity[] = carts.value.map( cart => ({
                        dateOrder: new Date(),
                        quantity: quantities.value[cart.id] || 1,
                        paymentMethod: 'card', 
                        deliveryMethod: 'delivery',
                        orderBy: userId as number, 
                        Product: cart.id,
                    }));
        
                    // Send the order data
                    const res = await restOrder.sendOrder(orders, access_token);
                    if(res.status === 201){
                        toastManager?.value.alertSuccess('Order submitted successfully')
                        setTimeout(()=>{
                            router.push({ path: 'orders' });
                        },1500)
                    }else{
                        toastManager?.value.alertError('Something went wrong')
                    }
                } else {
                    toastManager?.value.alertInfo('No items in cart or missing access token')
                }
            } catch (err) {
                console.log('Error submitting order:', err);
                toastManager?.value.alertError('Error submitting order')
            } finally {
                isLoading.value = false;
            }
        };        

        onMounted(fetchCarts);

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