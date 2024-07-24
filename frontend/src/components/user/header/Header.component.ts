import logo from '@/assets/images/logo.png';
import RestUserSession from "@/libs/RestUserSession";
import {ref,inject, type Ref, onMounted} from 'vue'
import axios from "axios";  
import { DropDownVue } from '../drop_down';
import { SearchBarVue } from '@/components/search_bar';
import { DrawerVue } from '../drawer';

export default {
    components: {
        DropDownVue,
        SearchBarVue,
        DrawerVue
    },
    setup(){
        const isLoggedIn = inject<any>("isLoggedIn"); 
        const searchBarHidden = ref<boolean>(false);
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

        const toggleSearch = ()=> {
            searchBarHidden.value = !searchBarHidden.value;
            console.log(searchBarHidden.value)
        }
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
        
        onMounted (()=>{
            sectionRefAccessories.value = document.getElementById('accessories');
            sectionRefElectronics.value = document.getElementById('electronics');
            sectionRefPhones.value = document.getElementById('phones');
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
        }
    }
}
