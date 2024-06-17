/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx,html}",
    "./node_modules/flowbite/**/*.js"
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
    require('flowbite/plugin'),
    require('daisyui'),
  ]
}

