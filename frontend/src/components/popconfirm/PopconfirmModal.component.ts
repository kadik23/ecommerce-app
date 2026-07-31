import { defineComponent, ref } from 'vue';

export default defineComponent({
    name: 'PopconfirmModal',
    props: {
        id: {
            type: String,
            required: true
        },
        title: {
            type: String,
            default: ''
        },
        message: {
            type: String,
            default: ''
        },
        confirmText: {
            type: String,
            default: ''
        },
        cancelText: {
            type: String,
            default: ''
        },
        confirmClass: {
            type: String,
            default: 'bg-red-600 hover:bg-red-700'
        },
        titleClass: {
            type: String,
            default: 'text-red-600'
        },
        icon: {
            type: String,
            default: 'warning'
        }
    },
    emits: ['confirm', 'cancel'],
    setup(props, { emit }) {
        const modalRef = ref<HTMLDialogElement | null>(null);

        const showModal = () => {
            const el = document.getElementById(props.id) as HTMLDialogElement;
            if (el && typeof el.showModal === 'function') {
                el.showModal();
            } else if (modalRef.value) {
                modalRef.value.showModal();
            }
        };

        const closeModal = () => {
            const el = document.getElementById(props.id) as HTMLDialogElement;
            if (el && typeof el.close === 'function') {
                el.close();
            } else if (modalRef.value) {
                modalRef.value.close();
            }
        };

        const handleConfirm = () => {
            closeModal();
            emit('confirm');
        };

        const handleCancel = () => {
            closeModal();
            emit('cancel');
        };

        return {
            modalRef,
            show: showModal,
            showModal,
            close: closeModal,
            closeModal,
            handleConfirm,
            handleCancel
        };
    }
});
