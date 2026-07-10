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
            let cat = selectedCategory.value;
            if (cat === 'All categories') {
                cat = 'All';
            }
            const action = isAdmin ? `/product/show/${cat}` : `/product-by-categroy/${cat}`;
            formAction.value = action;
            const params = {
                search: searchQuery.value,
            };
            router.push({ path: formAction.value, query: params });
        };

        return{formMethod, handleSubmit, selectedCategory, searchQuery}
    }
}
