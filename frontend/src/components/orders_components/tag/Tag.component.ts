import { defineComponent, ref, type PropType } from 'vue';

export default defineComponent({
    name: 'Tag',
    props: {
        tagname: {
            type: String,
            required: true,
        },
        isCurrentState: {
            type: Boolean,
            required: true,
        }
    },  
    setup(props: any, {emit}:any){
        const changeState = () => {
            emit('recievedCurrentState',props.tagname);
        }

        return{
            changeState
        }
    }
});
