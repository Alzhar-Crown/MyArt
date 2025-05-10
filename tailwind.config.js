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

        }, fontFamily: {
          righteous: ['Righteous', 'sans-serif'],
        }, fontFamily: {
          ptsans: ['PT Sans', 'sans-serif'],
          fontweight: [400],

        }, animation: {
          typing: 'blink 1s step-start infinite',
        },
        keyframes: {
          blink: {
            '0%, 100%': { borderColor: 'transparent' },
            '50%': { borderColor: 'black' },
          }
        }
      },
    },
    plugins: [require("daisyui")],
  }
  