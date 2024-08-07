import RestCarts from '@/libs/RestCarts';
import RestUserSession from '@/libs/RestUserSession';
import UserSessionRepository from '@/libs/UserSessionRepository';
import axios from 'axios';
import { defineComponent, inject, onMounted, ref, type Ref } from 'vue';

export default defineComponent({
    props: {
        id: {
            type: String,
            required: true
        },
        profile: {
            type: String,
            required: true
        },
        category: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        rating: {
            type: Number,
            required: true
        },
        quantity: {
            type: Number,
            required: true
        },
        sold: {
            type: Number,
            required: true
        },
        price: {
            type: Number,
            required: true
        },
        isAdmin: {
            type: Boolean,
            required: true
        }
    },
    setup(props) {
        const productId = ref<string>(props.id);
        const productName = ref<string>(props.name);
        const productPrice = ref<number>(props.price);
        const file = ref<File | null>(null);
        const isFavorite = ref<boolean>(false);
        const restCarts: IRestCarts = new RestCarts(axios);
        const userSessionRepository = new UserSessionRepository(localStorage);
        const access_token = userSessionRepository.getAccessToken();
        let toastManager = inject<Ref<IToastsManager>>("toastManager");
        const showModal = () => {
            const modal = document.querySelector('.modal') as HTMLElement;
            modal.style.display = 'block';
        };

        const closeModal = () => {
            const modal = document.querySelector('.modal') as HTMLElement;
            modal.style.display = 'none';
        };


        const handleFileUpload = (event: Event) => {
            const target = event.target as HTMLInputElement;
            if (target.files) {
                file.value = target.files[0];
            }
        };

        const updateProduct = () => {
            closeModal();
        };
        
        onMounted(() => {
            const storedFavoriteStatus = localStorage.getItem(`favorite-${props.id}`);
            isFavorite.value = storedFavoriteStatus === 'true';
        });
        
        const toggleFavorite = () => {
            isFavorite.value = !isFavorite.value;
            console.log(isFavorite.value)
            localStorage.setItem(`favorite-${props.id}`, isFavorite.value? 'true': 'false');
        };

        const addToCart = async () => {
            try {
                if (access_token) {
                    const data = await restCarts.Create(props.id, access_token);
                    if (data){
                        console.log(data)
                        toastManager?.value.alertSuccess("Cart added successfuly.");
                    }
                }else{
                    toastManager?.value.alertInfo("Please login to your account.");
                }
            } catch (error) {
                console.error('Error fetching user data:', error);
                toastManager?.value.alertError("Cart added failed.");
            } 
        }

        return {
            productId,
            productName,
            productPrice,
            file,
            showModal,
            closeModal,
            // editProduct,
            handleFileUpload,
            updateProduct,
            isFavorite,
            toggleFavorite,
            addToCart
        };
    }
});
