import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        // Force-generate all brand-* utilities
        { pattern: /bg-brand-(50|100|200|300|400|500|600|700|800|900|950)(\/\d+)?/, variants: ['hover', 'focus', 'active', 'group-hover'] },
        { pattern: /text-brand-(50|100|200|300|400|500|600|700|800|900|950)(\/\d+)?/, variants: ['hover', 'focus', 'group-hover'] },
        { pattern: /border-brand-(50|100|200|300|400|500|600|700|800|900|950)(\/\d+)?/, variants: ['hover', 'focus'] },
        { pattern: /ring-brand-(50|100|200|300|400|500|600|700|800|900|950)(\/\d+)?/, variants: ['focus'] },
        { pattern: /from-brand-(50|100|200|300|400|500|600|700|800|900|950)/ },
        { pattern: /to-brand-(50|100|200|300|400|500|600|700|800|900|950)/ },
        { pattern: /via-brand-(50|100|200|300|400|500|600|700|800|900|950)/ },
        // Force-generate all accent-* utilities
        { pattern: /bg-accent-(50|100|400|500|600)(\/\d+)?/, variants: ['hover', 'focus', 'group-hover'] },
        { pattern: /text-accent-(50|100|400|500|600)(\/\d+)?/, variants: ['hover', 'focus', 'group-hover'] },
        { pattern: /border-accent-(50|100|400|500|600)(\/\d+)?/, variants: ['hover', 'focus'] },
        // venture-* for backward compat with dashboard
        { pattern: /bg-venture-(50|100|200|300|400|500|600|700|800|900)(\/\d+)?/, variants: ['hover', 'focus', 'active', 'group-hover'] },
        { pattern: /text-venture-(50|100|200|300|400|500|600|700|800|900)(\/\d+)?/, variants: ['hover', 'focus', 'group-hover'] },
        { pattern: /border-venture-(50|100|200|300|400|500|600|700|800|900)(\/\d+)?/, variants: ['hover', 'focus'] },
        { pattern: /ring-venture-(50|100|200|300|400|500|600|700|800|900)(\/\d+)?/, variants: ['focus'] },
        // Named shadow utilities
        'shadow-card', 'shadow-card-hover', 'shadow-glow',
        // Custom background images
        'bg-brand-gradient', 'bg-brand-gradient-dark', 'bg-hero-pattern',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans:    ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Space Grotesk', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // New unified brand palette (violet-based)
                brand: {
                    50:  '#f4f0ff',
                    100: '#e9e0ff',
                    200: '#d1c0ff',
                    300: '#b39aff',
                    400: '#8b6bff',
                    500: '#6d28d9',   // Core violet
                    600: '#5b21b6',
                    700: '#4c1d95',
                    800: '#3b0f7a',
                    900: '#2e0a5f',
                    950: '#1f053f',   // Deepest violet for dark mode
                },
                // Cyan accent
                accent: {
                    50:  '#ecfeff',
                    100: '#cffafe',
                    400: '#22d3ee',
                    500: '#06b6d4',   // Vibrant cyan
                    600: '#0891b2',
                },
                // Keep venture palette for backward compat with dashboard & auth
                venture: {
                    50:  '#f0f9ff',
                    100: '#e0f2fe',
                    200: '#bae6fd',
                    300: '#7dd3fc',
                    400: '#38bdf8',
                    500: '#0ea5e9',
                    600: '#0284c7',
                    700: '#0369a1',
                    800: '#075985',
                    900: '#0c4a6e',
                },
                // Custom deep navy for dark elements
                neutral: {
                    850: '#1e2235',
                    950: '#0c0f1a',
                },
            },
            backgroundImage: {
                'brand-gradient':      'linear-gradient(135deg, #6d28d9 0%, #06b6d4 100%)',
                'brand-gradient-dark': 'linear-gradient(135deg, #2e0a5f 0%, #0c0f1a 100%)',
                'hero-pattern':        "url('/images/hero-bg.svg')",
                'grid-pattern':        "url('/images/grid-bg.svg')",
            },
            boxShadow: {
                'card':       '0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -2px rgba(0,0,0,0.05)',
                'card-hover': '0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.05)',
                'glow':       '0 0 20px rgba(109,40,217,0.3)',
            },
            keyframes: {
                blob: {
                    '0%':   { transform: 'translate(0px, 0px) scale(1)' },
                    '33%':  { transform: 'translate(30px, -50px) scale(1.1)' },
                    '66%':  { transform: 'translate(-20px, 20px) scale(0.9)' },
                    '100%': { transform: 'translate(0px, 0px) scale(1)' },
                },
            },
            animation: {
                blob: 'blob 7s infinite',
            },
        },
    },

    plugins: [forms],
};
