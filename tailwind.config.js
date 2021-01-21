const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            cyan: colors.cyan,
            teal: colors.teal,
        },
        fontFamily: {
            sans: ['Poppins', 'sans-serif']
        }
    },
  },
  variants: {
    extend: {
        display: ['group-hover'],
        opacity: ['disabled'],
    },
  },
  plugins: [],
}
