import { defineComponent, ref, inject, type Ref } from 'vue';
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue';
import axios from 'axios';
import { useI18n } from 'vue-i18n';

export default defineComponent({
    name: 'ContactVue',
    components: {
        Switch,
        SwitchGroup,
        SwitchLabel
    },
    setup() {
        const { t } = useI18n();
        const toastManager = inject<Ref<IToastsManager>>("toastManager");
        const agreed = ref(false);
        const firstName = ref('');
        const lastName = ref('');
        const email = ref('');
        const country = ref('DZ');
        const phoneNumber = ref('');
        const message = ref('');
        const isLoading = ref(false);

        const submitContact = async () => {
            if (!agreed.value) return;

            isLoading.value = true;
            try {
                const response = await axios.post('/api/contact', {
                    first_name: firstName.value,
                    last_name: lastName.value,
                    email: email.value,
                    country: country.value,
                    phone_number: phoneNumber.value,
                    message: message.value
                });

                if (response.status === 201 || response.data?.status === 'success') {
                    toastManager?.value?.alertSuccess(t('contact.success_msg'));
                    firstName.value = '';
                    lastName.value = '';
                    email.value = '';
                    phoneNumber.value = '';
                    message.value = '';
                    agreed.value = false;
                }
            } catch (error) {
                console.error('Error submitting contact form:', error);
                toastManager?.value?.alertError(t('contact.error_msg'));
            } finally {
                isLoading.value = false;
            }
        };

        return {
            agreed,
            firstName,
            lastName,
            email,
            country,
            phoneNumber,
            message,
            isLoading,
            submitContact
        };
    }
});