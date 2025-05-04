/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
    theme: {
      extend: {
        fontFamily: {
          sans: ['Onest', 'sans-serif'], // ganti default sans
          fontSize: ['placeholder'],  

        },
      },
    },
    plugins: [require("daisyui")],
  }
  