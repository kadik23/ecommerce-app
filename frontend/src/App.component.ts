import { defineComponent, provide, ref } from "vue";
import ToastsManager from "./libs/ToastsManager";
import { ToastVue } from "./components/toast";

export default defineComponent({
    name: 'AppVue',
    props: {},
    components: {
        ToastVue
    },
    setup() {
        let toastManager = ref(new ToastsManager());
        provide("toastManager", toastManager);

        return { 
            toasts: toastManager.value.toasts,
        };
    },
});
