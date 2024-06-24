import RestUserSession from "@/libs/RestUserSession";
import axios from "axios";
import { inject, ref } from "vue";
import { useRouter } from "vue-router";
import { defineComponent } from 'vue'
import type { Ref } from 'vue'
import { LoadingVue } from "@/components/loading";

export default defineComponent({
    components: {
        LoadingVue
    },
    setup(){
        let toastManager = inject<IToastsManager>("toastManager");

        const isLoading = ref(false);
        const restUserSession = new RestUserSession(axios);

        const form: Ref<UserEntity> = ref({
            username: '',
            email: '',
            password: '',
            password_confirmation: '',
        });

        const formErrors: Ref<UserEntity> = ref({
            username: '',
            email: '',
            password: ''
        });
        
        
        const logoUrl = ref(new URL('@/assets/images/logo.png', import.meta.url).href);
        const googleIconUrl = ref(new URL('@/assets/images/icons8-google-48.png', import.meta.url).href);
        const backgroundUrl = ref(new URL('@/assets/images/background2.svg', import.meta.url).href);
        const router = useRouter();

        const handleErrorMessage = (error: any) => {
            let keys = Object.keys(error);
            let t = 0;
            for(let key of keys){
                setTimeout(() => {
                    toastManager?.alertError(`${error[key]}`);
                }, t);
                t += 300;
            }
        }

        const signUp = () => {
            formErrors.value = { username: '', email: '', password: '' };

            isLoading.value = true;
            restUserSession.register(form.value).then(response => {
                isLoading.value = false;
                console.log(response);
                if(response.error){
                    handleErrorMessage(response.data);
                }else{
                    toastManager?.alertSuccess("Sign up successfuly.");
                    router.push('/sign-in');
                }
            }).catch(error => {
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;
                    formErrors.value.username = errors.username ? errors.username[0] : '';
                    formErrors.value.email = errors.email ? errors.email[0] : '';
                    formErrors.value.password = errors.password ? errors.password[0] : '';
                } else {
                isLoading.value = false;
                console.log(error);
                alert('Bad credentials');
                }
            });
        }

        return {
            form,
            formErrors,
            signUp,
            isLoading,
            googleIconUrl,
            backgroundUrl,
            logoUrl,
            handleErrorMessage,
        };
    }
})