import { ProductCardVue } from "@/components/product_card";
import RestProducts from "@/libs/RestProducts";
import type { AxiosInstance } from "axios";
import { defineComponent, inject, onMounted, ref } from "vue";

export default defineComponent({
    name: 'Wishlist',
    components: {
        ProductCardVue
    },
    setup() {
        const isLoading = ref(false);
        const axios = inject<AxiosInstance>('axios');
        const products = ref<ProductEntity[]>([]);
        const restProducts: IRestProducts = new RestProducts(axios as AxiosInstance);

        const fetchProducts = async () => {
            isLoading.value = true;
            try {
                const data: any = await restProducts.getAll();
                let productsRes: ProductEntity[] = data.products;
                
                let favorites: ProductEntity[] = [];
                for (let i = 0; i < localStorage.length; i++) {
                    const key = localStorage.key(i);
                    if (key?.startsWith('favorite-') && localStorage.getItem(key) === 'true') {
                        const productId = key.split('-')[1];
                        const product = productsRes.find(p => p.id.toString() === productId.toString());
                        if (product) {
                            favorites.push(product);
                        }
                    }
                }
                products.value = favorites;
            } catch (error) {
                console.error('Error fetching products:', error);
            } finally {
                isLoading.value = false;
            }
        };

        onMounted(() => {
            fetchProducts();
        });

        return {
            isLoading,
            products
        };
    }
});
