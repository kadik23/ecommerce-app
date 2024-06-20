import { ref, onMounted, inject, defineComponent } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default defineComponent({

    setup() {
        const selectedCategory = ref('All categories');
        const searchQuery = ref('');
        const categories = ref([]);
        const formMethod = ref('GET');
        const formAction = ref('');

        const router = useRouter();
        const isAdmin = inject('isAdmin', false);

        const fetchCategories = async () => {
            try {
                const response = await axios.get('/api/categories');
                categories.value = response.data;
            } catch (error) {
                console.error('Error fetching categories:', error);
            }
        };

        const handleSubmit = () => {
            const action = isAdmin ? `/product/show/${selectedCategory.value}` : '/user/product/show';
            formAction.value = action;
            const params = {
                category: selectedCategory.value,
                search: searchQuery.value,
            };
            router.push({ path: formAction.value, query: params });
        };

        onMounted(fetchCategories);
        return{formMethod}
    }
})
