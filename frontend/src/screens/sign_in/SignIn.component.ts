import RestUserSession from "@/libs/RestUserSession";
import UserSessionRepository from "@/libs/UserSessionRepository";
import axios from "axios";
import { inject, ref } from "vue";
import { useRouter } from 'vue-router';

import { defineComponent } from 'vue'
import { LoadingVue } from "@/components/loading";

export default defineComponent({
    components: {
        LoadingVue
    },
    setup() {
        const form = ref({
            email: '',
            password: ''
        });

        const formErrors = ref({
            email: '',
            password: ''
        });

        const router = useRouter();
        let toastManager = inject<IToastsManager>("toastManager");
        const isLoading = ref(false);
        const restUserSession = new RestUserSession(axios);
        const userSessionRepository = new UserSessionRepository(localStorage);

        const handleErrorMessage = (error: string) => {
            toastManager?.alertError(error);
        }

        const handleSubmit = () => {
            isLoading.value = true;
            // Validation logic (Example: required fields)
            if (!form.value.email) {
                formErrors.value.email = 'Email is required';
                return;
            }
            if (!form.value.password) {
                formErrors.value.password = 'Password is required';
                return;
            }
            restUserSession.login({
                email: form.value.email,
                password: form.value.password
            }).then(response => {
                isLoading.value = false;
                console.log(response);
                if (response.access_token) {
                    userSessionRepository.save({ access_token: response.access_token, account_type: response.account_type });
                    toastManager?.alertSuccess("Sign in successfuly.");
                    setTimeout(() => {
                        router.push('/');
                    }, 3000);
                }
            }).catch(error => {
                isLoading.value = false;
                console.log(error);
                handleErrorMessage('Bad credentials');
            });
        };

        return {
            isLoading,
            form,
            formErrors,
            handleSubmit
        };
    }
})