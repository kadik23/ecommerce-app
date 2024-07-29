import { ref, onMounted, defineComponent, provide, type Ref } from 'vue';
import RestProducts from '@/libs/RestProducts';
import axios from 'axios';
import { CategoryCardVue } from '@/components/user/category_card';
import { ProductCardVue } from '@/components/product_card';
import { CarouselVue } from '@/components/carousel';
import phonesImage from '@/assets/images/categories/hal-gatewood-WcYeiHMexR0-unsplash.jpg';
import accessoriesImage from '@/assets/images/categories/marissa-grootes-D4jRahaUaIc-unsplash.jpg';
import electronicsImage from '@/assets/images/categories/umberto-jXd2FSvcRr8-unsplash.jpg';
import CardAnimation from '@/components/CardAnimation.component';

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
        const products = ref<ProductEntity[]>([]);
        const electronics = ref<ProductEntity[]>([]);
        const phones = ref<ProductEntity[]>([]);
        const accessories = ref<ProductEntity[]>([]);
        const categories = ref<CategoryEntity[]>([]);
        const carts = ref<any[]>([]);
        const isLoading = ref(false);
        const restProducts: IRestProducts = new RestProducts(axios);
        const fetchProducts = async () => {
            isLoading.value = true;
            try {
                const data: any = await restProducts.getAll();
                let productsRes: ProductEntity[] = data.productsController
                products.value = productsRes;
                console.log(products.value )
                electronics.value = productsRes.filter((product: ProductEntity) => product.category === "Electronics");
                phones.value = productsRes.filter((product: ProductEntity) => product.category === "Phones");
                accessories.value = productsRes.filter((product: ProductEntity) => product.category === "Accessories");                categories.value = data.categories;
                carts.value = data.carts;
            } catch (error) {
                console.error('Error fetching products:', error);
            } finally {
                isLoading.value = false;
            }
        };

        onMounted(fetchProducts);

        return {
            products,
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
