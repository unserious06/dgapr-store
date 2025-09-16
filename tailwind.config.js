import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
    //prefix: 'tw-',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary0: "#8B5E3C",     // warm brown
                secondary0: "#F4A261",   // soft orange
                background0: "#FFF8F0",  // off-white
                textcolor0: "#4B3B2F",   // dark brown
                accent0: "#E07A5F",      // rusty red
                neutral0: "#D9CAB3",     // beige
                success0: "#6AA84F",     // green
                error0: "#C94C4C",       // muted red
            },
        },
    },

    plugins: [forms],
}
