import logo from '@/assets/images/logo.png';
import RestUserSession from "@/libs/RestUserSession";
import { ref, inject, type Ref, onMounted, computed, watch } from 'vue'
import axios from "axios";
import { DropDownVue } from '../drop_down';
import { SearchBarVue } from '@/components/search_bar';
import { DrawerVue } from '../drawer';
import RestProducts from '@/libs/RestProducts';
import RestCarts from '@/libs/RestCarts';
import UserSessionRepository from '@/libs/UserSessionRepository';
import echo from '@/libs/Pusher';
import { useRoute, useRouter } from 'vue-router';

import { PopconfirmModalVue } from '@/components/popconfirm';

export default {
    components: {
        DropDownVue,
        SearchBarVue,
        DrawerVue,
        PopconfirmModalVue
    },
    setup() {
        const isLoggedIn = inject<any>("isLoggedIn");
        const searchBarHidden = ref<boolean>(true);
        const itemsLoggedIn = ['Profile', 'Logout'];
        const linksLoggedIn = ['/profile', '/sign-out'];
        const itemsLoggedOut = ['Login', 'Register'];
        const linksLoggedOut = ['/sign-in', '/sign-up'];
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

        const router = useRouter();

        const scrollTo = (sectionId: string) => {
            if (route.path !== '/') {
                router.push({ path: '/', hash: `#${sectionId}` }).then(() => {
                    setTimeout(() => {
                        const view = document.getElementById(sectionId);
                        if (view) {
                            view.scrollIntoView({ behavior: 'smooth' });
                        }
                    }, 500);
                });
            } else {
                const view = document.getElementById(sectionId);
                if (view) {
                    view.scrollIntoView({ behavior: 'smooth' });
                }
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
                let productsRes: ProductEntity[] = data.products;
                products.value = productsRes;
                if (data.categories && Array.isArray(data.categories)) {
                    categoriesLinks.value = data.categories.map((c: any) => c.name || c);
                }
                countFavorites();
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        };

        const fetchCarts = async () => {
            try {
                const token = userSessionRepository.getAccessToken();
                if (token && isLoggedIn?.value) {
                    const data: any = await restCarts.getAll(token);
                    if (data && data.Carts) {
                        carts.value = data.Carts as CartEntity[];
                        notificationCount.value = carts.value.length;
                    }
                }
            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        }

        const fetchUserData = async () => {
            try {
                const token = userSessionRepository.getAccessToken();
                if (token && isLoggedIn?.value) {
                    const data = await restUser.getCurrentUser(token);
                    user_id.value = data.id;
                    setupPusher();
                }
            } catch (error) {
                console.error('Error fetching user data:', error);
            }
        };

        const setupPusher = () => {
            const channelName = `user.${user_id.value}`;
            echo.private(channelName).listen('.my-event', (data: any) => {
                notificationCount.value += 1;
                carts.value.unshift({
                    ...data,
                    name: data.product_name,
                    price: data.product_price,
                    user_id: data.user
                });
            });
        };

        const resetToZero = async () => {
            if(notificationCount.value === 0){
                return;
            }
            const token = userSessionRepository.getAccessToken();
            if (token && isLoggedIn?.value) {
                const unReadCarts = carts.value.filter(carts => !carts.isRead)
                await restCarts.markItRead(unReadCarts, token)
                notificationCount.value = 0;
            }
        };

        onMounted(() => {
            sectionRefAccessories.value = document.getElementById('accessories');
            sectionRefElectronics.value = document.getElementById('electronics');
            sectionRefPhones.value = document.getElementById('phones');
            fetchProducts();
            if (isLoggedIn?.value) {
                fetchCarts();
                fetchUserData();
            }
        });

        watch(isLoggedIn, (newVal) => {
            if (newVal) {
                fetchCarts();
                fetchUserData();
            } else {
                carts.value = [];
                notificationCount.value = 0;
            }
        });

        const pendingDeleteCartId = ref<any>(null);
        const deleteCartHeaderModal = ref<any>(null);

        const confirmDeleteCart = (id: any) => {
            pendingDeleteCartId.value = id;
            if (deleteCartHeaderModal.value) {
                deleteCartHeaderModal.value.showModal();
            }
        };

        const executeDeleteCart = async () => {
            if (pendingDeleteCartId.value !== null) {
                const idToDelete = pendingDeleteCartId.value;
                pendingDeleteCartId.value = null;
                await deleteCard(idToDelete);
            }
        };

        const deleteCard = async (id: any) => {
            try{
                const token = userSessionRepository.getAccessToken();
                if (token && isLoggedIn?.value) {
                    const res = await restCarts.Delete(id, token);
                    if (res) {
                        carts.value = carts.value.filter((c: any) => c.id !== id);
                        notificationCount.value = carts.value.length;
                        toastManager?.value?.alertSuccess("Cart deleted successfully.");
                    }
                }else{
                    toastManager?.value?.alertInfo("Please login to your account.");
                }
            }catch(err){
                console.log(err)
            }
        }

        const changeLanguage = async (lang: string) => {
            if (isLoggedIn.value) {
                try {
                    await restUserSession.updateUserInfo({ lang } as any);
                } catch (error) {
                    console.error('Failed to update language on backend', error);
                }
            }
            import('@/i18n').then(module => {
                const i18n = module.default;
                (i18n.global.locale as any).value = lang;
                document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
            });
        };

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
            confirmDeleteCart,
            executeDeleteCart,
            deleteCartHeaderModal,
            notificationCount,
            currentPath,
            changeLanguage
        }
    }
}
