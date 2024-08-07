import { ref, onMounted, inject, defineComponent } from 'vue';
import { useRouter } from 'vue-router';

export default {
    props: {
        categories: []
    },
    setup() {
        const selectedCategory = ref('All categories');
        const searchQuery = ref('');
        const formMethod = ref('GET');
        const formAction = ref('');

        const router = useRouter();
        const isAdmin = inject('isAdmin', false);
        const handleSubmit = () => {
            const action = isAdmin ? `/product/show/${selectedCategory.value}` : '/user/product/show';
            formAction.value = action;
            const params = {
                category: selectedCategory.value,
                search: searchQuery.value,
            };
            router.push({ path: formAction.value, query: params });
        };

        return{formMethod, handleSubmit, selectedCategory}
    }
}
