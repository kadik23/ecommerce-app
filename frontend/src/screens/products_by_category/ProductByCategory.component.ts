import { ProductCardVue } from "@/components/product_card";
import RestProducts from "@/libs/RestProducts";
import type { AxiosInstance } from "axios";
import { computed, defineComponent, inject, onMounted, ref } from "vue";
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
        const isLoading = ref(false)
        const axios = inject<AxiosInstance>('axios')
        const products = ref<ProductEntity[]>([]);
        const restProducts: IRestProducts = new RestProducts(axios as AxiosInstance);

        const fetchProducts = async () => {
            isLoading.value = true;
            try {
                const data: any = await restProducts.getAll();
                let productsRes: ProductEntity[] = data.productsController
                products.value = productsRes.filter((product: ProductEntity) => product.category === category);
                console.log(products.value )
            } catch (error) {
                console.error('Error fetching products:', error);
            } finally {
                isLoading.value = false;
            }
        };

        onMounted(fetchProducts);


        return {
            category,
            isLoading,
            products
        };
    }
});