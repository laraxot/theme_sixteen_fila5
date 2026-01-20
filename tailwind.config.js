import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import daisyui from 'daisyui'
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        // Theme resources
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.css',
        './resources/**/*.vue',
        './assets/**/*.js',
        './assets/**/*.css',

        // Filament core packages - Filament 4.x paths
        './vendor/filament/**/*.blade.php',

        // Laravel application paths
        '../../app/Filament/**/*.php',
        '../../resources/views/**/*.blade.php',
        '../../Modules/**/Filament/**/*.php',
        '../../Modules/**/resources/views/**/*.blade.php',
        '../../storage/framework/views/*.php',

        // Laravel pagination views
        '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',

        // Third-party packages
        './node_modules/flowbite/**/*.js',
        '../../../public_html/vendor/**/*.blade.php',

        // Additional Filament paths for themes
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Titillium Web', 'Inter var', ...defaultTheme.fontFamily.sans],
                mono: ['Roboto Mono', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                // Colori AGID ufficiali (Agenzia per l'Italia Digitale)
                // PRIMARY = VERDE PA (come Design Comuni)
                primary: {
                    50: '#e6f7f0',
                    100: '#b3e6d1',
                    200: '#80d5b2',
                    300: '#4dc493',
                    400: '#1ab374',
                    500: '#00814A', // Primary GREEN PA (Design Comuni)
                    600: '#006b3d',
                    700: '#005530',
                    800: '#003f23',
                    900: '#002916',
                    DEFAULT: '#00814A',
                },
                success: {
                    50: '#e6f7f0',
                    100: '#b3e6d1',
                    200: '#80d5b2',
                    300: '#4dc493',
                    400: '#1ab374',
                    500: '#00B373', // Success green AGID
                    600: '#008f5c',
                    700: '#006b45',
                    800: '#00472e',
                    900: '#002317',
                    DEFAULT: '#00B373',
                },
                danger: {
                    50: '#fce8ea',
                    100: '#f7b3b8',
                    200: '#f27e86',
                    300: '#ed4954',
                    400: '#e81422',
                    500: '#D9364F', // Error red AGID
                    600: '#ae2b3f',
                    700: '#83202f',
                    800: '#58151f',
                    900: '#2d0a0f',
                    DEFAULT: '#D9364F',
                },
                warning: {
                    50: '#fff8e6',
                    100: '#ffecb3',
                    200: '#ffe080',
                    300: '#ffd44d',
                    400: '#ffc81a',
                    500: '#F5A623', // Warning yellow AGID
                    600: '#c4851c',
                    700: '#936315',
                    800: '#62420e',
                    900: '#312107',
                    DEFAULT: '#F5A623',
                },
                // Manteniamo anche i nomi originali per compatibilità
                'italia-blue': {
                    50: '#e6f2ff',
                    100: '#b3d9ff',
                    200: '#80bfff',
                    300: '#4da6ff',
                    400: '#1a8cff',
                    500: '#0066CC',
                    600: '#0052a3',
                    700: '#003d7a',
                    800: '#002952',
                    900: '#001429',
                },
                'italia-green': {
                    50: '#e6f7f0',
                    100: '#b3e6d1',
                    200: '#80d5b2',
                    300: '#4dc493',
                    400: '#1ab374',
                    500: '#00B373',
                    600: '#008f5c',
                    700: '#006b45',
                    800: '#00472e',
                    900: '#002317',
                },
                'italia-red': {
                    50: '#fce8ea',
                    100: '#f7b3b8',
                    200: '#f27e86',
                    300: '#ed4954',
                    400: '#e81422',
                    500: '#D9364F',
                    600: '#ae2b3f',
                    700: '#83202f',
                    800: '#58151f',
                    900: '#2d0a0f',
                },
                'italia-yellow': {
                    50: '#fff8e6',
                    100: '#ffecb3',
                    200: '#ffe080',
                    300: '#ffd44d',
                    400: '#ffc81a',
                    500: '#F5A623',
                    600: '#c4851c',
                    700: '#936315',
                    800: '#62420e',
                    900: '#312107',
                },
            },
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
            },
            borderRadius: {
                'none': '0px',
                'sm': '2px',
                DEFAULT: '4px',
                'md': '6px',
                'lg': '8px',
                'xl': '12px',
                '2xl': '16px',
                '3xl': '24px',
            },
            boxShadow: {
                'agid': '0 2px 4px rgba(0, 0, 0, 0.1)',
                'agid-lg': '0 4px 8px rgba(0, 0, 0, 0.15)',
                'agid-xl': '0 8px 16px rgba(0, 0, 0, 0.2)',
            },
        },
    },
    plugins: [
        forms,
        typography,
        daisyui,
        require("flowbite/plugin"),
        // Plugin personalizzato per Filament 4.x con AGID Design System
        function({ addComponents, addUtilities, theme }) {
            // Componenti Filament con AGID styling
            addComponents({
                // Base button styling
                '.fi-btn': {
                    '@apply inline-flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed': {},
                },
                '.fi-btn-primary': {
                    '@apply bg-primary-500 text-white hover:bg-primary-600 focus:ring-primary-500 active:bg-primary-700': {},
                },
                '.fi-btn-secondary': {
                    '@apply bg-gray-200 text-gray-900 hover:bg-gray-300 focus:ring-gray-500 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600': {},
                },
                '.fi-btn-success': {
                    '@apply bg-success-500 text-white hover:bg-success-600 focus:ring-success-500 active:bg-success-700': {},
                },
                '.fi-btn-danger': {
                    '@apply bg-danger-500 text-white hover:bg-danger-600 focus:ring-danger-500 active:bg-danger-700': {},
                },
                '.fi-btn-warning': {
                    '@apply bg-warning-500 text-white hover:bg-warning-600 focus:ring-warning-500 active:bg-warning-700': {},
                },

                // Input components
                '.fi-input': {
                    '@apply w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 disabled:bg-gray-50 disabled:text-gray-500 dark:bg-gray-900 dark:border-gray-600 dark:text-white dark:focus:border-primary-500': {},
                },
                '.fi-input-error': {
                    '@apply border-danger-500 focus:ring-danger-500 focus:border-danger-500': {},
                },

                // Card components
                '.fi-card': {
                    '@apply bg-white rounded-lg shadow-agid border border-gray-200 dark:bg-gray-800 dark:border-gray-700': {},
                },
                '.fi-card-header': {
                    '@apply px-6 py-4 border-b border-gray-200 dark:border-gray-700': {},
                },
                '.fi-card-content': {
                    '@apply px-6 py-4': {},
                },
                '.fi-card-footer': {
                    '@apply px-6 py-4 border-t border-gray-200 dark:border-gray-700': {},
                },

                // Modal components
                '.fi-modal': {
                    '@apply bg-white rounded-lg shadow-agid-xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700': {},
                },
                '.fi-modal-header': {
                    '@apply px-6 py-4 border-b border-gray-200 dark:border-gray-700': {},
                },
                '.fi-modal-content': {
                    '@apply px-6 py-4': {},
                },
                '.fi-modal-footer': {
                    '@apply px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-lg dark:bg-gray-700 dark:border-gray-600': {},
                },

                // Notification components
                '.fi-notification': {
                    '@apply bg-white border border-gray-200 rounded-lg shadow-agid-lg dark:bg-gray-800 dark:border-gray-700': {},
                },
                '.fi-notification-success': {
                    '@apply border-success-200 bg-success-50 dark:border-success-800 dark:bg-success-950': {},
                },
                '.fi-notification-warning': {
                    '@apply border-warning-200 bg-warning-50 dark:border-warning-800 dark:bg-warning-950': {},
                },
                '.fi-notification-danger': {
                    '@apply border-danger-200 bg-danger-50 dark:border-danger-800 dark:bg-danger-950': {},
                },

                // Table components
                '.fi-table': {
                    '@apply bg-white rounded-lg shadow-agid border border-gray-200 overflow-hidden dark:bg-gray-800 dark:border-gray-700': {},
                },
                '.fi-table-header': {
                    '@apply bg-gray-50 border-b border-gray-200 dark:bg-gray-700 dark:border-gray-600': {},
                },
                '.fi-table-header-cell': {
                    '@apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400': {},
                },
                '.fi-table-row': {
                    '@apply border-b border-gray-200 hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700': {},
                },
                '.fi-table-cell': {
                    '@apply px-6 py-4 text-sm text-gray-900 dark:text-white': {},
                },

                // Badge components
                '.fi-badge': {
                    '@apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium': {},
                },
                '.fi-badge-primary': {
                    '@apply bg-primary-100 text-primary-800 dark:bg-primary-900 dark:text-primary-200': {},
                },
                '.fi-badge-success': {
                    '@apply bg-success-100 text-success-800 dark:bg-success-900 dark:text-success-200': {},
                },
                '.fi-badge-warning': {
                    '@apply bg-warning-100 text-warning-800 dark:bg-warning-900 dark:text-warning-200': {},
                },
                '.fi-badge-danger': {
                    '@apply bg-danger-100 text-danger-800 dark:bg-danger-900 dark:text-danger-200': {},
                },

                // Navigation components
                '.fi-navigation-item': {
                    '@apply flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:bg-gray-700 dark:focus:text-white': {},
                },
                '.fi-navigation-item-active': {
                    '@apply bg-primary-100 text-primary-700 hover:bg-primary-200 focus:bg-primary-200 dark:bg-primary-900 dark:text-primary-200 dark:hover:bg-primary-800 dark:focus:bg-primary-800': {},
                },

                // Form section components
                '.fi-section': {
                    '@apply bg-white rounded-lg shadow-agid border border-gray-200 p-6 dark:bg-gray-800 dark:border-gray-700': {},
                },
                '.fi-section-header': {
                    '@apply text-lg font-medium text-gray-900 mb-4 dark:text-white': {},
                },
                '.fi-section-description': {
                    '@apply text-sm text-gray-600 mb-6 dark:text-gray-400': {},
                },

                // AGID specific utilities
                '.agid-container': {
                    '@apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8': {},
                },
                '.agid-page-header': {
                    '@apply bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700': {},
                },
                '.agid-page-title': {
                    '@apply text-2xl font-bold text-gray-900 dark:text-white': {},
                },
                '.agid-page-subtitle': {
                    '@apply text-sm text-gray-600 dark:text-gray-400': {},
                },

                // Authentication forms styling
                '.agid-login-container': {
                    '@apply max-w-md mx-auto bg-white rounded-lg shadow-agid-lg p-8 border border-gray-200 dark:bg-gray-800 dark:border-gray-700': {},
                },
                '.agid-login-header': {
                    '@apply text-center mb-8': {},
                },
                '.agid-login-title': {
                    '@apply text-2xl font-bold text-gray-900 mb-2 dark:text-white': {},
                },
                '.agid-login-subtitle': {
                    '@apply text-gray-600 dark:text-gray-400': {},
                },
            });

            // Utilità personalizzate per AGID
            addUtilities({
                '.agid-focus': {
                    '@apply focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500': {},
                },
                '.agid-transition': {
                    '@apply transition-all duration-200 ease-in-out': {},
                },
            });
        },
    ],
    daisyui: {
        themes: [
            {
                light: {
                    primary: '#00814A', // Verde PA (Design Comuni)
                    secondary: '#6B7280',
                    accent: '#F5A623',
                    neutral: '#374151',
                    'base-100': '#ffffff',
                    'base-200': '#f9fafb',
                    'base-300': '#e5e7eb',
                    info: '#0066CC',
                    success: '#00B373',
                    warning: '#F5A623',
                    error: '#D9364F',
                },
                dark: {
                    primary: '#00814A', // Verde PA (Design Comuni)
                    secondary: '#9CA3AF',
                    accent: '#F5A623',
                    neutral: '#D1D5DB',
                    'base-100': '#111827',
                    'base-200': '#1F2937',
                    'base-300': '#374151',
                    info: '#0066CC',
                    success: '#00B373',
                    warning: '#F5A623',
                    error: '#D9364F',
                },
            },
        ],
        darkTheme: 'dark',
        logs: false,
    },
}
