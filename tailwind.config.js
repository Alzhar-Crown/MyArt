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
          ptsans: ['PT Sans', 'sans-serif'],
          righteous: ['Righteous', 'sans-serif'],

        
        }, animation: {
          typing: 'blink 1s step-start infinite',
        },
        keyframes: {
          blink: {
            '0%, 100%': { borderColor: 'transparent' },
            '50%': { borderColor: 'black' },
          }
        },
         perspective: {
        '1000': '1000px',
        '500': '500px',
       },
       rotate: {
          'y-180': 'rotateY(180deg)',
          'y-90': 'rotateY(90deg)',
        },
      },
    },
    plugins: [require("daisyui")],
    plugins: [
    function ({ addUtilities }) {
      addUtilities({
        '.preserve-3d': {
          'transform-style': 'preserve-3d',
        },
        '.rotate-y-180': {
          transform: 'rotateY(180deg)',
        },
        '.perspective-1000': {
          perspective: '1000px',
        },
        '.backface-hidden': {
          'backface-visibility': 'hidden',
        },
      });
    },
  ],
  }
  