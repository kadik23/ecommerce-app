/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
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

  plugins: [
    require('@tailwindcss/forms'), 
    require('flowbite/plugin')({
      charts: true,
    }),
    require("daisyui"),
  ],
}

