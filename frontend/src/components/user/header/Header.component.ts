import logo from '@/assets/images/logo.png';
import RestUserSession from "@/libs/RestUserSession";
import { ref, inject, type Ref, onMounted, computed } from 'vue'
import axios from "axios";
import { DropDownVue } from '../drop_down';
import { SearchBarVue } from '@/components/search_bar';
import { DrawerVue } from '../drawer';
import RestProducts from '@/libs/RestProducts';
import RestCarts from '@/libs/RestCarts';
import UserSessionRepository from '@/libs/UserSessionRepository';
import echo from '@/libs/Pusher';
import { useRoute } from 'vue-router';

export default {
    components: {
        DropDownVue,
        SearchBarVue,
        DrawerVue
    },
    setup() {
        const isLoggedIn = inject<any>("isLoggedIn");
        const searchBarHidden = ref<boolean>(true);
        const itemsLoggedIn = ['Profile', 'Logout'];
        const linksLoggedIn = ['profile', 'sign-out'];
        const itemsLoggedOut = ['Login', 'Register'];
        const linksLoggedOut = ['sign-in', 'sign-up'];
        const categoriesLinks = ref(['Phones', 'Accessories', 'Electronics']);
        const toastManager = inject<Ref<IToastsManager>>("toastManager");
        let isShow = ref(false)
        let isShow2 = ref(false)
        const isLoading = ref(false);
        const restUserSession = new RestUserSession(axios);
        const favoriteNbr = ref<number>(0);
        const route = useRoute();
        const currentPath = computed(() => route.path);

        const toggleSearch = () => {
            searchBarHidden.value = !searchBarHidden.value;
            console.log(searchBarHidden.value)
        }
        const favoriteProducts = ref<ProductEntity[]>([]);
        const restCarts: IRestCarts = new RestCarts(axios);
        const userSessionRepository = new UserSessionRepository(localStorage);
        const access_token = userSessionRepository.getAccessToken();
        const carts = ref<any[]>([])
        const sectionRefElectronics = ref<HTMLElement | null>(null);
        const sectionRefPhones = ref<HTMLElement | null>(null);
        const sectionRefAccessories = ref<HTMLElement | null>(null);
        const notificationCount = ref(0);
        const restUser = new RestUserSession(axios);
        const user_id = ref<number|undefined>();
        const products = ref<ProductEntity[]>([]);
        const restProducts: IRestProducts = new RestProducts(axios);

        const handleErrorMessage = (error: string): void => {
            toastManager?.value.alertError(error);
        }

        const logout = () => {
            isLoading.value = true;
            restUserSession.logout().then(response => {
                isLoading.value = false;
                console.log(response);
                if (response.message) {
                    location.href = "/";
                }
            }).catch(error => {
                isLoading.value = false;
                console.log(error);
                handleErrorMessage('Bad credentials');
            });
        }

        function scrollTo(view: HTMLElement | null) {
            if (view && view.scrollIntoView) {
                view.scrollIntoView({ behavior: 'smooth' });
            } else {
                console.warn('Element not found or not scrollable:', view);
            }
        }

        const countFavorites = () => {
            let count = 0;
            let favorites: ProductEntity[] = [];
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                if (key?.startsWith('favorite-') && localStorage.getItem(key) === 'true') {
                    const productId = key.split('-')[1];
                    const product = products.value.find(p => p.id.toString() === productId.toString());
                    if (product) {
                        favorites.push(product);
                        count++;
                    }
                }
            }
            favoriteNbr.value = count;
            favoriteProducts.value = favorites;
        }

        const fetchProducts = async () => {
            try {
                const data: any = await restProducts.getAll();
                let productsRes: ProductEntity[] = data.products
                products.value = productsRes;
                countFavorites();
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        };

        const fetchCarts = async () => {
            try {
                if (access_token) {
                    const data: any = await restCarts.getAll(access_token);
                    carts.value = data.Carts as CartEntity[]
                    console.log(carts.value.length)
                    notificationCount.value = carts.value.length
                    console.log(data)
                }
            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        }

        const fetchUserData = async () => {
            try {
                if (access_token) {
                    const data = await restUser.getCurrentUser(access_token);
                    user_id.value = data.id;
                    console.log(user_id.value)
                    setupPusher()
                }
            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        };

        const setupPusher = () => {
            const channelName = `user.${user_id.value}`;
            echo.private(channelName).listen('my-event', (data: CartEntity) => {
                notificationCount.value += 1;
                carts.value.push(data);
                const template = `
                <a href="#" class="flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="w-32 overflow-hidden">
                    <img class="object-cover h-20" src="/assets/images/products/${data.img}" alt="Product image">
                    </div>
                    <div class="w-full pl-3">
                    <div class="text-gray-500 text-md mb-1 dark:text-gray-400"><span class="font-bold text-gray-900 dark:text-white">${data.name}</span></div>
                    <div class="text-gray-500 text-sm mb-1 dark:text-gray-400"><span class="opacity-80 text-gray-900 dark:text-white">${data.user_id}</span></div>
                    <div class="text-lg text-bold text-regal-brown dark:text-regal-amber-700">${data.price}</div>
                    </div>
                </a>
                <a href="#" product_id="${data.id}" class="delete_cart hover:bg-transparent">
                    <span class="ml-2 material-symbols-outlined cursor-pointer text-regal-brown hover:bg-transparent hover:text-amber-700">
                    close
                    </span>
                </a>
                <hr class="opacity-70 p-0">
                `;
                const ulElement = document.getElementById('scrollable-container') as HTMLElement;
                const newLiElement = document.createElement('li');
                newLiElement.classList.add('flex', 'flex-row', 'items-center');
                newLiElement.innerHTML = template;
                ulElement.insertBefore(newLiElement, ulElement.firstChild);
            });
        };

        const resetToZero = async () => {
            if(notificationCount.value === 0){
                return;
            }
            if (access_token) {
                const unReadCarts = carts.value.filter(carts => !carts.isRead)
                await restCarts.markItRead(unReadCarts, access_token)
                notificationCount.value = 0;
            }
        };

        onMounted(() => {
            sectionRefAccessories.value = document.getElementById('accessories');
            sectionRefElectronics.value = document.getElementById('electronics');
            sectionRefPhones.value = document.getElementById('phones');
            fetchProducts()
            fetchCarts()
            fetchUserData()
        })

        const deleteCard = (id: any) => {
            try{
                if (access_token) {
                    const res = restCarts.Delete(id, access_token)
                    if (res.data) {
                        carts.value.map((c: any) => c[0].id !== id)
                        toastManager?.value.alertSuccess("Cart deleted succefully.");
                    }
                }else{
                    toastManager?.value.alertInfo("Please login to your account.");
                }
            }catch(err){
                console.log(err)
            }
        }

        return {
            logo, isShow, isShow2, logout,
            isLoggedIn,
            itemsLoggedIn,
            linksLoggedIn,
            itemsLoggedOut,
            linksLoggedOut,
            toggleSearch,
            categoriesLinks,
            scrollTo,
            sectionRefElectronics,
            sectionRefPhones,
            sectionRefAccessories,
            searchBarHidden,
            favoriteNbr,
            favoriteProducts,
            carts,
            resetToZero,
            deleteCard,
            notificationCount,
            currentPath
        }
    }
}
