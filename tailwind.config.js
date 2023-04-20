const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");
/** @type {import('tailwindcss').Config} */
module.exports = {
    presets: [require("./vendor/wireui/wireui/tailwind.config.js")],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        // Wuire ui
        "./vendor/wireui/wireui/resources/**/*.blade.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/View/**/*.php",
        "./App/Models/**/*.php",
        //Wire-element Modal
        "./vendor/wire-elements/modal/src/*.php",
        "./vendor/wire-elements/modal/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        //Calendar
        "../public/calendar/*.{html,js",
        "../public/**/*.js",
        "./public/calendar/*.js",
        //MAILS
        "./resources/views/mails/**/*.blade.php",
        "./node_modules/tw-elements/dist/js/**/*.js",
    ],
    safelist: [
        {
            pattern:
                /(bg|text|border)-(slate|gray|zinc|neutral|stone|red|orange|yellow|lime|green|emrald|teal|cyan|sky|blue|indigo|violet|purple|fushia|pink|rose)-(100|200|300|400|500|600|700|800|900)/,
            variants: ["after", "before", "hover", "selection"],
        },
        ...[...Array(100).keys()].flatMap((i) => [`w-[${i * 1}%]`]),
        {
            pattern: /(max|min)-(w)-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
            variants: ["sm", "md", "lg", "xl"],
        },
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Assistant", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require("tw-elements/dist/plugin.cjs"),
        require("@tailwindcss/forms")({
            strategy: "class",
        }),
    ],
};
