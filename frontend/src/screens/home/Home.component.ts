import { ref, onMounted, defineComponent, onBeforeUnmount } from 'vue';
import RestProducts from '@/libs/RestProducts';
import axios from 'axios';
import { CategoryCardVue } from '@/components/user/category_card';
import { ProductCardVue } from '@/components/product_card';
import { CarouselVue } from '@/components/carousel';
import phonesImage from '@/assets/images/categories/hal-gatewood-WcYeiHMexR0-unsplash.jpg';
import accessoriesImage from '@/assets/images/categories/marissa-grootes-D4jRahaUaIc-unsplash.jpg';
import electronicsImage from '@/assets/images/categories/umberto-jXd2FSvcRr8-unsplash.jpg';
import eventBus from '@/eventBus';
import CardAnimation from '@/components/CardAnimation.component';

export default defineComponent({
    name: 'HomeVue',
    components: {
        CarouselVue,
        ProductCardVue,
        CategoryCardVue,
        CardAnimation
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
                electronics.value = productsRes.filter((product: ProductEntity) => product.category === Category.Electronics);
                phones.value = productsRes.filter((product: ProductEntity) => product.category === Category.Phones);
                accessories.value = productsRes.filter((product: ProductEntity) => product.category === Category.Accessories);
                categories.value = data.Categories;
                carts.value = data.carts;
            } catch (error) {
                console.error('Error fetching products:', error);
            } finally {
                isLoading.value = false;
            }
        };

        onMounted(fetchProducts);

        const scrollToSection = (section: string) => {
            const element = document.getElementById(section);
            if (element) {
                gsap.to(window, {
                    scrollTo: { y: element, offsetY: 70 }, 
                    duration: 1.5,
                    ease: 'power2.inOut'
                });
            }
        };

        onMounted(() => {
            eventBus.on('scroll-to', scrollToSection);
        });

        onBeforeUnmount(() => {
            eventBus.off('scroll-to', scrollToSection);
        });

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
