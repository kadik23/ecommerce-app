import RestUserSession from '@/libs/RestUserSession';
import axios from 'axios';
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
        const restUserSession = new RestUserSession(axios)
        const handleItemClick = (link: string, item: string) => {
            if (item === 'Logout') {
                submitLogoutForm();
            } else {
                window.location.href = link;
            }
        };

        const submitLogoutForm = () => {
            try{
                restUserSession.logout()
                window.location.href = '/'
            }catch(err) {
                console.log(err);
            }
        };

        return {
            hasLogoutItem,
            handleItemClick,
            submitLogoutForm,
        };
    },
});