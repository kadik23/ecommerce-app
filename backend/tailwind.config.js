/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./public/index.html",
    "./src/**/*.{vue,js}",
    "./node_modules/tw-elements/dist/js/**/*.js",
    'node_modules/flowbite-vue/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        'regal-brown': '#b17b4f',
      },
    },
    daisyui: {
      themes: ["light", 
      "dark", 
      "cupcake",
      "bumblebee",
      "emerald",
      "corporate",
      "synthwave",
      "retro",
      "cyberpunk",
      "valentine",
      "halloween",
      "garden",
      "forest",
      "aqua",
      "lofi",
      "pastel",
      "fantasy",
      "wireframe",
      "black",
      "luxury",
      "dracula",
      "cmyk",
      "autumn",
      "business",
      "acid",
      "lemonade",
      "night",
      "coffee",
      "winter",],
    },
  },
  plugins: [require("tw-elements/dist/plugin.cjs"),require('flowbite/plugin'),require('flowbite-typography'),require("daisyui"),],
  darkMode: "class",
  
}

