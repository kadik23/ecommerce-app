import { defineComponent, ref } from 'vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { Switch, SwitchGroup, SwitchLabel } from '@headlessui/vue'


export default defineComponent({
    components: {
        Switch,
        SwitchGroup,
        SwitchLabel
    },
    setup(){
        const agreed = ref(false)
        

        return {
            agreed,
        };
    }
})