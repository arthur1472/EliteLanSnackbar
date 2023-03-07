const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                'extreme': '4.5rem',
            },
            textColor: {
                'discord': '#7289DA'
            },
            backgroundColor: {
                'discord': '#7289DA'
            },
            colors: {
                green: colors.emerald,
                yellow: colors.amber,
                purple: colors.violet,
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio')
    ],
};
