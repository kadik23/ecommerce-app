/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    "./node_modules/tw-elements/dist/js/**/*.js"

  ],
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
  theme: {
    extend: {
      colors: {
        'regal-brown': '#b17b4f',
      },},
  },
  darkMode: "class",

  plugins: [require('@tailwindcss/forms'), 
            require('flowbite/plugin')({
              charts: true,}),
            require("daisyui"),require("tw-elements/dist/plugin.cjs")
          ],
}

