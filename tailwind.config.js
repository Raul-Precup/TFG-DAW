import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            // Paleta de Precap's Book (dirección de arte "Marcapáginas")
            colors: {
                brand: { DEFAULT: '#1F3A33', press: '#172C26', soft: '#DDE7E1', ondark: '#B9D3C6' },
                cta: { DEFAULT: '#A8412F', hover: '#8E3526' },
                oro: '#B8913A',
                tinta: '#16201D',
                papel: { DEFAULT: '#F5F0E6', hondo: '#ECE4D4' },
                hueso: '#FFFDF8',
                linea: '#DDD3C1',
                gris: '#5E6661',
            },
            fontFamily: {
                sans: ['Manrope', ...defaultTheme.fontFamily.sans],
                display: ['"Libre Caslon Display"', 'Georgia', 'serif'],
            },
            borderRadius: {
                tapa: '5px 18px 18px 5px',
            },
        },
    },

    plugins: [forms, typography],
};
