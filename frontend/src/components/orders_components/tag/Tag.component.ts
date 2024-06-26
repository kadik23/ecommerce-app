import { defineComponent, ref, type PropType } from 'vue';

export default defineComponent({
    name: 'Tag',
    props: {
        tagname: {
            type: String as PropType<string>,
            required: true,
        },
    },
});
