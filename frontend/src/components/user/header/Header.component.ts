import logo from '@/assets/images/logo.png';
import RestUserSession from "@/libs/RestUserSession";
import {ref,inject, type Ref, onMounted} from 'vue'
import axios from "axios";  
import { DropDownVue } from '../drop_down';
import { SearchBarVue } from '@/components/search_bar';
import { DrawerVue } from '../drawer';
import RestProducts from '@/libs/RestProducts';

export default {
    components: {
        DropDownVue,
        SearchBarVue,
        DrawerVue
    },
    setup(){
        const isLoggedIn = inject<any>("isLoggedIn"); 
        const searchBarHidden = ref<boolean>(true);
        const itemsLoggedIn = ['Profile', 'Logout'];
        const linksLoggedIn = ['profile', 'sign-out'];
        const itemsLoggedOut = ['Login', 'Register'];
        const linksLoggedOut = ['sign-in', 'sign-up'];
        const categoriesLinks = ref(['Phones', 'Accessories', 'Electronics']);
        let toastManager = inject<IToastsManager>("toastManager");
        let isShow = ref(false)
        let isShow2 = ref(false)
        const isLoading = ref(false);
        const restUserSession = new RestUserSession(axios);
        const favoriteNbr = ref<number>(0);
        const toggleSearch = ()=> {
            searchBarHidden.value = !searchBarHidden.value;
            console.log(searchBarHidden.value)
        }
        const favoriteProducts = ref<ProductEntity[]>([]); 


        const handleErrorMessage = (error: string): void => {
            toastManager?.alertError(error);
        }

        const logout = () => {
            isLoading.value = true;
            restUserSession.logout().then(response => {
                isLoading.value = false;
                console.log(response);
                if(response.message){
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

        const sectionRefElectronics = ref<HTMLElement | null >(null);
        const sectionRefPhones = ref<HTMLElement | null >(null);
        const sectionRefAccessories = ref<HTMLElement | null >(null);
        const products = ref<ProductEntity[]>([]);
        const restProducts: IRestProducts = new RestProducts(axios);

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
                let productsRes: ProductEntity[] = data.productsController
                products.value = productsRes;
                countFavorites();
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        };

        
        onMounted (()=>{
            sectionRefAccessories.value = document.getElementById('accessories');
            sectionRefElectronics.value = document.getElementById('electronics');
            sectionRefPhones.value = document.getElementById('phones');
            fetchProducts()
        })
        
        return { logo ,isShow ,isShow2 , logout,
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
            sectionRefAccessories ,
            searchBarHidden,
            favoriteNbr,
            favoriteProducts
        }
    }
}
