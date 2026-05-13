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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    dark: '#0f172a',
                    DEFAULT: '#1e293b',
                    light: '#334155',
                },
                gold: {
                    DEFAULT: '#f5c518',
                    light: '#fef08a',
                    hover: '#eab308',
                }
            }
        },
    },

    plugins: [forms],
};
