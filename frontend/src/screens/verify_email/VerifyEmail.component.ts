import axios from "axios";
import { inject, ref, type Ref } from "vue";
import { defineComponent } from 'vue';
import UserSessionRepository from "@/libs/UserSessionRepository";

export default defineComponent({
    setup() {
        let toastManager = inject<Ref<IToastsManager>>("toastManager");
        const isLoading = ref(false);

        const logoUrl = ref(new URL('@/assets/images/logo.png', import.meta.url).href);
        const backgroundUrl = ref(new URL('@/assets/images/background.svg', import.meta.url).href);
        const userSessionRepository = new UserSessionRepository(localStorage);
        const access_token = userSessionRepository.getAccessToken();

        const handleResend = () => {
            isLoading.value = true;

            axios.post('/api/auth/email/resend', {}, {
                headers: {
                    Authorization: `Bearer ${access_token}`
                }
            }).then(response => {
                isLoading.value = false;
                toastManager?.value.alertSuccess("A fresh verification link has been sent to your email address.");
            }).catch(error => {
                isLoading.value = false;
                console.log(error);
                toastManager?.value.alertError(error.response?.data?.message || 'Verification link resend failed.');
            });
        };

        return {
            isLoading,
            handleResend,
            logoUrl,
            backgroundUrl
        };
    }
});
