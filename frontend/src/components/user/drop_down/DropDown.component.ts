import { defineComponent, ref, computed } from 'vue';

export default defineComponent({
    props: {
        label: String,
        items: Array as () => string[],
        links: Array as () => string[],
    },
    // @ts-ignore
    setup(props: { label: string, items: string[], links: string[] }) {
        const hasLogoutItem = computed(() => props.items.includes('Logout'));

        const handleItemClick = (link: string, item: string) => {
            if (item === 'Logout') {
                submitLogoutForm();
            } else {
                window.location.href = link;
            }
        };

        const submitLogoutForm = () => {
            const form = document.getElementById('logout-form') as HTMLFormElement | null;
            if (form) {
                form.submit();
            }
        };

        return {
            hasLogoutItem,
            handleItemClick,
            submitLogoutForm,
        };
    },
});