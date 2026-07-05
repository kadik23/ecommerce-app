import axios from "axios";
import { inject, ref, type Ref } from "vue";
import { useRouter } from 'vue-router';
import { defineComponent } from 'vue';

export default defineComponent({
    setup() {
        const form = ref({
            email: ''
        });

        const formErrors = ref({
            email: ''
        });

        const router = useRouter();
        let toastManager = inject<Ref<IToastsManager>>("toastManager");
        const isLoading = ref(false);

        const logoUrl = ref(new URL('@/assets/images/logo.png', import.meta.url).href);
        const backgroundUrl = ref(new URL('@/assets/images/background.svg', import.meta.url).href);

        const handleSubmit = () => {
            isLoading.value = true;
            formErrors.value.email = '';

            if (!form.value.email) {
                formErrors.value.email = 'Email is required';
                isLoading.value = false;
                return;
            }

            axios.post('/api/auth/password/email', {
                email: form.value.email
            }).then(response => {
                isLoading.value = false;
                toastManager?.value.alertSuccess("We have emailed your password reset link!");
                setTimeout(() => {
                    router.push('/sign-in');
                }, 3000);
            }).catch(error => {
                isLoading.value = false;
                console.log(error);
                if (error.response && error.response.data && error.response.data.errors) {
                    formErrors.value.email = error.response.data.errors.email[0];
                } else {
                    toastManager?.value.alertError(error.response?.data?.message || 'Password reset link request failed.');
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
