
export default {
    props: {
        toasts: Array,
    },
    setup(props:any){

        return {
            toasts: props.toasts
        }
    }
}
