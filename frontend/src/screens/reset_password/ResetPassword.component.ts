import axios from "axios";
import { inject, ref, type Ref } from "vue";
import { useRouter, useRoute } from 'vue-router';
import { defineComponent } from 'vue';

export default defineComponent({
    setup() {
        const form = ref({
            email: '',
            password: '',
            password_confirmation: '',
            token: ''
        });

        const formErrors = ref({
            email: '',
            password: ''
        });

        const router = useRouter();
        const route = useRoute();
        let toastManager = inject<Ref<IToastsManager>>("toastManager");
        const isLoading = ref(false);

        const logoUrl = ref(new URL('@/assets/images/logo.png', import.meta.url).href);
        const backgroundUrl = ref(new URL('@/assets/images/background.svg', import.meta.url).href);

        // Retrieve token from route params or query parameter
        form.value.token = (route.params.token as string) || (route.query.token as string) || '';
        form.value.email = (route.query.email as string) || '';

        const handleSubmit = () => {
            isLoading.value = true;
            formErrors.value.email = '';
            formErrors.value.password = '';

            if (!form.value.email) {
                formErrors.value.email = 'Email is required';
                isLoading.value = false;
                return;
            }
            if (!form.value.password) {
                formErrors.value.password = 'Password is required';
                isLoading.value = false;
                return;
            }
            if (form.value.password !== form.value.password_confirmation) {
                formErrors.value.password = 'Passwords do not match';
                isLoading.value = false;
                return;
            }

            axios.post('/api/auth/password/reset', form.value).then(response => {
                isLoading.value = false;
                toastManager?.value.alertSuccess("Your password has been reset successfully!");
                setTimeout(() => {
                    router.push('/sign-in');
                }, 3000);
            }).catch(error => {
                isLoading.value = false;
                console.log(error);
                if (error.response && error.response.data && error.response.data.errors) {
                    const errors = error.response.data.errors;
                    formErrors.value.email = errors.email ? errors.email[0] : '';
                    formErrors.value.password = errors.password ? errors.password[0] : '';
                } else {
                    toastManager?.value.alertError(error.response?.data?.message || 'Password reset failed.');
                }
            });
        };

        return {
            isLoading,
            form,
            formErrors,
            handleSubmit,
            logoUrl,
            backgroundUrl
        };
    }
});
