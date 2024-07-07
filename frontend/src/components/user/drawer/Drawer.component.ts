import { defineComponent } from 'vue'

export default defineComponent({
    props: {
        navItems: {
            type: Array,
            default: () => [
                { name: 'Home', section: 'home' },
                { name: 'Phones', section: 'phones' },
                { name: 'Accessories', section: 'accessories' },
                { name: 'Electronics', section: 'electronics' },
            ],
        },
        isLoggedIn: {
            type: Boolean,
            default: false,
        },
        darkMode: {
            type: Boolean,
            default: false,
        },
        DrawerId: {
            type: String,
            required: true,
        },
        drawerButtonStyles: {
            type: String,
            default: 'bg-regal-brown text-white',
            
        },
    },
    setup() {

        return {}
    }
})
