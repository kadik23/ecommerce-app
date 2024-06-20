import { defineComponent, ref } from 'vue';

export default defineComponent({
    props: {
        id: {
            type: Number,
            required: true
        },
        profile: {
            type: String,
            required: true
        },
        category: {
            type: String,
            required: true
        },
        name: {
            type: String,
            required: true
        },
        rating: {
            type: Number,
            required: true
        },
        quantity: {
            type: Number,
            required: true
        },
        sold: {
            type: Number,
            required: true
        },
        price: {
            type: Number,
            required: true
        },
        isAdmin: {
            type: Boolean,
            required: true
        }
    },
    setup(props) {
        const productId = ref<number>(props.id);
        const productName = ref<string>(props.name);
        const productPrice = ref<number>(props.price);
        const file = ref<File | null>(null);

        const showModal = () => {
            const modal = document.querySelector('.modal') as HTMLElement;
            modal.style.display = 'block';
        };

        const closeModal = () => {
            const modal = document.querySelector('.modal') as HTMLElement;
            modal.style.display = 'none';
        };

        const editProduct = (event: MouseEvent) => {
            const target = event.target as HTMLButtonElement;
            productId.value = parseInt(target.dataset.id!);
            productName.value = target.dataset.name!;
            productPrice.value = parseFloat(target.dataset.price!);
        };

        const handleFileUpload = (event: Event) => {
            const target = event.target as HTMLInputElement;
            if (target.files) {
                file.value = target.files[0];
            }
        };

        const updateProduct = () => {
            closeModal();
        };

        return {
            productId,
            productName,
            productPrice,
            file,
            showModal,
            closeModal,
            editProduct,
            handleFileUpload,
            updateProduct
        };
    }
});
