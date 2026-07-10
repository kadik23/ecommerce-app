import { ref, onMounted, defineComponent, provide, type Ref, inject } from 'vue';
import RestProducts from '@/libs/RestProducts';
import { CategoryCardVue } from '@/components/user/category_card';
import { ProductCardVue } from '@/components/product_card';
import { CarouselVue } from '@/components/carousel';
import phonesImage from '@/assets/images/categories/hal-gatewood-WcYeiHMexR0-unsplash.jpg';
import accessoriesImage from '@/assets/images/categories/marissa-grootes-D4jRahaUaIc-unsplash.jpg';
import electronicsImage from '@/assets/images/categories/umberto-jXd2FSvcRr8-unsplash.jpg';
import CardAnimation from '@/components/CardAnimation.component';
import type { AxiosInstance } from 'axios';

export default defineComponent({
    name: 'HomeVue',
    components: {
        CarouselVue,
        ProductCardVue,
        CategoryCardVue,
        CardAnimation,
    },
    props: {},
    setup() {
        const topProducts = ref<ProductEntity[]>([]);
        const latestProducts = ref<ProductEntity[]>([]);
        const electronics = ref<ProductEntity[]>([]);
        const phones = ref<ProductEntity[]>([]);
        const accessories = ref<ProductEntity[]>([]);
        const categories = ref<CategoryEntity[]>([]);
        const carts = ref<any[]>([]);
        const isLoading = ref(false);
        const axios = inject<AxiosInstance>('axios')

        const restProducts: IRestProducts = new RestProducts(axios as AxiosInstance);
        const fetchProducts = async () => {
            isLoading.value = true;
            try {
                const data: any = await restProducts.getAll();
                let productsRes: ProductEntity[] = data.products
                
                // Top Products sorted by sold count
                topProducts.value = [...productsRes].sort((a, b) => (b.sold || 0) - (a.sold || 0)).slice(0, 4);
                
                // Latest Products sorted by creation date
                latestProducts.value = [...productsRes].sort((a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime()).slice(0, 4);
                
                electronics.value = productsRes.filter((product: ProductEntity) => product.category === "Electronics").slice(0, 4);
                phones.value = productsRes.filter((product: ProductEntity) => product.category === "Phones").slice(0, 4);
                accessories.value = productsRes.filter((product: ProductEntity) => product.category === "Accessories").slice(0, 4);
                categories.value = data.categories;
                carts.value = data.carts;
            } catch (error) {
                console.error('Error fetching products:', error);
            } finally {
                isLoading.value = false;
            }
        };

        onMounted(fetchProducts);

        return {
            topProducts,
            latestProducts,
            electronics,
            phones,
            accessories,
            isLoading,
            phonesImage,
            accessoriesImage,
            electronicsImage,
        };
    }
});
