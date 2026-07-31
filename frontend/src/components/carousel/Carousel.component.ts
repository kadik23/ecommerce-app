import { ref, onMounted, inject } from 'vue';
import type { AxiosInstance } from 'axios';
import defaultSlide1 from '@/assets/images/slider/slider1.png';
import defaultSlide2 from '@/assets/images/slider/slider2.png';

interface SliderItem {
    id?: number;
    image: string;
    title?: string;
    link?: string;
    isCustom?: boolean;
}

export default {
    name: 'CarouselVue',
    setup() {
        const axios = inject<AxiosInstance>('axios');
        const sliders = ref<SliderItem[]>([]);
        const activeSlideIndex = ref(0);

        const fetchSliders = async () => {
            try {
                if (axios) {
                    const res = await axios.get('/api/sliders');
                    if (Array.isArray(res.data) && res.data.length > 0) {
                        sliders.value = res.data.map((s: any) => ({
                            id: s.id,
                            image: `/assets/images/slider/${s.image}`,
                            title: s.title,
                            link: s.link,
                            isCustom: true,
                        }));
                        return;
                    }
                }
            } catch (err) {
                console.error('Error fetching sliders:', err);
            }

            // Fallback to default slides if no custom sliders exist
            sliders.value = [
                { image: defaultSlide1, title: 'Default Slide 1', isCustom: false },
                { image: defaultSlide2, title: 'Default Slide 2', isCustom: false },
            ];
        };

        const prevSlide = () => {
            if (sliders.value.length === 0) return;
            activeSlideIndex.value = (activeSlideIndex.value - 1 + sliders.value.length) % sliders.value.length;
        };

        const nextSlide = () => {
            if (sliders.value.length === 0) return;
            activeSlideIndex.value = (activeSlideIndex.value + 1) % sliders.value.length;
        };

        onMounted(fetchSliders);

        return {
            sliders,
            activeSlideIndex,
            prevSlide,
            nextSlide,
        };
    }
};
