import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueJsx from '@vitejs/plugin-vue-jsx'
import VueDevTools from 'vite-plugin-vue-devtools'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    vueJsx(),
    VueDevTools(),
  ],
  server: {
    proxy: {
        '/api': {
            target: 'https://ecommerce-app-laravel.onrender.com/',
            changeOrigin: true, 
        },
        '/storage': {
            target: 'http://127.0.0.1:8000',
        }
    },
    host: '0.0.0.0', 
    port: 5173, 
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  }
})
