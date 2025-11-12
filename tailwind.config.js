import defaultTheme from 'tailwindcss/defaultTheme'
import defaultConfig from 'tailwindcss/defaultConfig'

export default {
  presets: [defaultConfig],
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './resource/**/*.css',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [],
}
