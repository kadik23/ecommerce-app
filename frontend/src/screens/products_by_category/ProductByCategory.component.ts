import { ProductCardVue } from "@/components/product_card";
import RestProducts from "@/libs/RestProducts";
import type { AxiosInstance } from "axios";
import { computed, defineComponent, inject, onMounted, onUnmounted, ref } from "vue";
import { useRoute } from "vue-router";

export default defineComponent({
    name: 'Cart',
    components: {
        ProductCardVue
    },
    props:{
        products:{
            required: true
        }
    },
    setup() {
        const route = useRoute();
        const category = route.params.category;
        const isLoading = ref(false);
        const axios = inject<AxiosInstance>('axios');
        const products = ref<ProductEntity[]>([]);
        const allProducts = ref<ProductEntity[]>([]);
        const restProducts: IRestProducts = new RestProducts(axios as AxiosInstance);
        const page = ref(1);
        const perPage = 8;

        const fetchProducts = async () => {
            isLoading.value = true;
            try {
                const data: any = await restProducts.getAll();
                let productsRes: ProductEntity[] = data.products;
                if (category === 'All') {
                    allProducts.value = productsRes;
                } else {
                    allProducts.value = productsRes.filter((product: ProductEntity) => product.category === category);
                }
                products.value = allProducts.value.slice(0, perPage);
            } catch (error) {
                console.error('Error fetching products:', error);
            } finally {
                isLoading.value = false;
            }
        };

        const loadMore = () => {
            if (isLoading.value) return;
            const nextPage = page.value + 1;
            const start = page.value * perPage;
            const end = nextPage * perPage;
            
            if (start < allProducts.value.length) {
                isLoading.value = true;
                // Add a small delay to simulate loading visually
                setTimeout(() => {
                    products.value = [...products.value, ...allProducts.value.slice(start, end)];
                    page.value = nextPage;
                    isLoading.value = false;
                }, 500);
            }
        };

        const handleScroll = () => {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
                loadMore();
            }
        };

        onMounted(() => {
            fetchProducts();
            window.addEventListener('scroll', handleScroll);
        });

        onUnmounted(() => {
            window.removeEventListener('scroll', handleScroll);
        });

        return {
            category,
            isLoading,
            products
        };
    }
});