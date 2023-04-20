const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './resources/views/mails/**/*.blade.php',
    ],
    theme: {
        screens: {
            'xxs': '375px',
            'xs': '475px',
            ...defaultTheme.screens,
        },
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.sky,
                success: colors.lime,
                warning: colors.yellow,
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
