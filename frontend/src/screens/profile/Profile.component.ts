import { ref, onMounted, defineComponent, reactive, computed, inject, type Ref } from 'vue';
import axios from 'axios';
import RestUserSession from '@/libs/RestUserSession';
import UploadImage from '@/libs/UploadImage';
import UserSessionRepository from '@/libs/UserSessionRepository';

export default defineComponent({
    name: 'ProfileVue',
    props: {},
    setup() {
        const isLoading = ref(false);
        const RestUser = new RestUserSession(axios);
        const uploadImage = new UploadImage(axios);
        const form = reactive({
            username: '',
            email: '',
            phone: '',
            country: '',
            city: '',
            profileImage: '',
        });
        const errors = reactive({
            username: '',
            email: '',
            password: '',
            phone: '',
            country: '',
            city: '',
            image: '',
        });
        const image = ref<File | null>(null);
        const modal = ref<null | HTMLDialogElement>(null);
        const userSessionRepository = new UserSessionRepository(localStorage);
        let toastManager = inject<Ref<IToastsManager>>("toastManager");
        const access_token = userSessionRepository.getAccessToken();

        const profileImage = computed(() => `@/assets/images/profiles/${form.profileImage}`);

        onMounted(() => {
            modal.value = document.querySelector('dialog#my_modal_2');
            fetchUserData();
        });

        const showModal = () => {
            if (modal.value) modal.value.showModal();
        };

        const closeModal = () => {
            if (modal.value) modal.value.close();
        };

        const fetchUserData = async () => {
            isLoading.value = true;
            try {
                if (access_token) {
                    const data = await RestUser.getCurrentUser(access_token);
                    Object.assign(form, data);
                }
            } catch (error) {
                console.error('Error fetching user data:', error);
            } finally {
                isLoading.value = false;
            }
        };

        const updateProfile = async () => {
            isLoading.value = true;
            try {
                console.log(form)
                await RestUser.updateUserInfo(form);
                toastManager?.value?.alertSuccess("Sign in successfuly.");
                isLoading.value = true;
            } catch (error) {
                console.error('Error updating profile:', error);
                toastManager?.value.alertError(error as string);
            } finally {
                isLoading.value = false;
            }
        };

        const updateProfilePicture = async () => {
            isLoading.value = true;
            try {
                await uploadImage.UploadImage(image.value as File);
            } catch (error) {
                console.error('Error updating profile picture:', error);
            } finally {
                isLoading.value = false;
            }
        };

        return {
            form,
            errors,
            image,
            profileImage,
            showModal,
            closeModal,
            updateProfile,
            updateProfilePicture,
            isLoading,
        }
    }
});
