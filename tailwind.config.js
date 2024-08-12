/** @type {import('tailwindcss').Config} */
export default {
  mode: 'jit',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    "./resources/**/*.html",
    "./resources/**/*.jsx",
    "./resources/**/*.tsx",
  ],
  daisyui: {
    themes: ["light", 
    "dark", 
    "cupcake",
    "bumblebee",
  ,],
  },
  theme: {
    extend: {
      colors: {
        'regal-brown': '#b17b4f',
      },
    },
  },
  darkMode: "class",
  safelist: [
    'lg:p-5',
    'overflow-x-scroll',
    'lg:flex-row',
    'capitalize'
  ],
  plugins: [
    require('@tailwindcss/forms'), 
    require('flowbite/plugin')({
      charts: true,
    }),
    require("daisyui"),
  ],
}

