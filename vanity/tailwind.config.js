import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
                makeup: {
                    header: '#8B5A5A',
                    'header-dark': '#6D4444',
                    coral: '#FF9B8A',
                    'coral-dark': '#E67A6A',
                    peach: '#E6B8A8',
                    'peach-light': '#F5D4C8',
                    cream: '#D4BFBA',
                    'cream-light': '#E6D7D3',
                    footer: '#3D3D3D',
                    'footer-light': '#5D5D5D',
                },
            },
        },
    },

    plugins: [forms],
};
