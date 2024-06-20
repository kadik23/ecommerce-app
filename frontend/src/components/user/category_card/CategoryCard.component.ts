import { ref } from "vue";

export default {
    props: {
        category: {
            type: String,
            required: true
        },
        image: {
            type: String,
            required: true
        },
        route: {
            type: String,
            required: true
        }
    },
    setup() {
        const square1 = ref<HTMLElement | null>(null);
        const square2 = ref<HTMLElement | null>(null);

        const handleMouseOver = (event: MouseEvent) => {
            const card = event.currentTarget as HTMLElement;
            const cardRect = card.getBoundingClientRect();

            if (square1.value && square2.value) {
                square1.value.style.width = `${cardRect.width}px`;
                square1.value.style.height = `${cardRect.height}px`;

                square2.value.style.width = `${cardRect.width}px`;
                square2.value.style.height = `${cardRect.height}px`;
            }
        };

        const handleMouseOut = () => {
            if (square1.value && square2.value) {
                square1.value.style.width = '0';
                square1.value.style.height = '0';
                square2.value.style.width = '0';
                square2.value.style.height = '0';
            }
        };

        return {
            square1,
            square2,
            handleMouseOver,
            handleMouseOut,
        };
    },
}   
