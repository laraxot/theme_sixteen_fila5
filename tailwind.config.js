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
                // PRIMARY = VERDE PA (Design Comuni Italia)
                primary: {
                    50: '#e6f7f0',
                    100: '#b3e6d1',
                    200: '#80d5b2',
                    300: '#4dc493',
                    400: '#1ab374',
                    500: '#007A52', // Primary GREEN Design Comuni Italia (updated)
                    600: '#006945',
                    700: '#005838',
                    800: '#00472b',
                    900: '#00361e',
                    DEFAULT: '#007A52',
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
            container: {
                center: true,
                padding: {
                    DEFAULT: '1rem',
                    sm: '1rem',
                    md: '1rem',
                    lg: '1rem',
                    xl: '1rem',
                    '2xl': '1rem',
                },
                screens: {
                    sm: '540px',
                    md: '720px',
                    lg: '960px',
                    xl: '1320px',
                    '2xl': '1320px',
                },
            },
        },
    },
    corePlugins: {
        container: false,  // Disable Tailwind's built-in container - use custom CSS only
    },
    plugins: [
        forms,
        typography,
        daisyui,
        require("flowbite/plugin"),
        // Bootstrap Italia Components - @apply classes
        function({ addComponents, addUtilities, theme }) {
            addComponents({
                // Header Slim
                '.it-header-slim-wrapper': {
                    '@apply bg-[#0066CC]': {},
                },
                '.it-header-slim': {
                    '@apply py-2': {},
                },
                '.it-header-slim-region a': {
                    '@apply text-white text-[14px] font-semibold no-underline hover:underline': {},
                },
                '.it-header-slim-language': {
                    '@apply text-white text-[14px] flex items-center gap-3': {},
                },
                '.it-header-slim-language-active': {
                    '@apply text-white font-bold no-underline': {},
                },
                '.it-header-slim-language-item': {
                    '@apply text-white opacity-70 no-underline hover:opacity-100': {},
                },
                '.it-header-slim-login': {
                    '@apply inline-flex items-center gap-2 bg-white text-[#0066CC] px-3 py-1.5 rounded text-[14px] font-semibold no-underline hover:bg-[#F0F0F0] hover:text-[#0052A3] transition-all': {},
                },
                
                // Footer
                '.it-footer': {
                    '@apply font-sans': {},
                },
                '.it-footer-main': {
                    '@apply bg-[#003D73] text-white': {},
                },
                '.it-footer-secondary': {
                    '@apply bg-[#000000] border-t border-[#333]': {},
                },
                '.footer-heading-title': {
                    '@apply text-white text-[16px] font-bold uppercase mb-4': {},
                },
                '.footer-list': {
                    '@apply list-none p-0 m-0': {},
                },
                '.footer-list li': {
                    '@apply mb-2': {},
                },
                '.footer-list li a': {
                    '@apply text-white no-underline text-[14px] opacity-80 hover:opacity-100 hover:no-underline transition-opacity': {},
                },
                
                // Cards
                '.card': {
                    '@apply bg-white rounded-lg border border-gray-200 shadow-sm': {},
                },
                '.card-teaser': {
                    '@apply bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow': {},
                },
                '.card-bg': {
                    '@apply bg-white': {},
                },
                '.card-body': {
                    '@apply p-4': {},
                },
                '.card-title': {
                    '@apply text-base font-semibold mb-2': {},
                },
                '.card-text': {
                    '@apply text-sm text-gray-600': {},
                },
                '.card-date': {
                    '@apply text-[#0066CC] text-sm': {},
                },
                '.card-category': {
                    '@apply text-[#5C6F82] text-xs uppercase tracking-wide mb-2': {},
                },
                '.card-list': {
                    '@apply list-none p-0 m-0 text-sm': {},
                },
                '.card-list li': {
                    '@apply mb-1': {},
                },
                
                // Sections
                '.section-title': {
                    '@apply text-2xl lg:text-3xl font-semibold text-gray-900 mb-4': {},
                },
                
                // Calendar
                '.calendar-list': {
                    '@apply space-y-4': {},
                },
                '.calendar-event': {
                    '@apply border-b border-gray-200 pb-3 mb-3': {},
                },
                '.calendar-date': {
                    '@apply text-[#0066CC] text-3xl font-bold block leading-none': {},
                },
                '.calendar-day': {
                    '@apply text-[#5C6F82] text-xs uppercase block mt-1': {},
                },
                '.event-list': {
                    '@apply list-none p-0 m-0': {},
                },
                '.event-list li': {
                    '@apply mb-2': {},
                },
                '.event-list li a': {
                    '@apply text-gray-700 no-underline hover:text-[#0066CC] hover:no-underline transition-colors': {},
                },
                
                // Buttons
                '.btn': {
                    '@apply inline-flex items-center justify-center gap-1.5 px-4 py-2 text-sm font-semibold rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed no-underline': {},
                },
                '.btn-primary': {
                    '@apply bg-[#0066CC] text-white hover:bg-[#0052A3] focus:ring-[#0066CC]': {},
                },
                '.btn-outline-primary': {
                    '@apply bg-transparent text-[#0066CC] border border-[#0066CC] hover:bg-[#0066CC] hover:text-white': {},
                },
                '.btn-sm': {
                    '@apply px-3 py-1.5 text-xs': {},
                },
                '.btn-link': {
                    '@apply text-[#0066CC] no-underline hover:underline bg-transparent border-0 p-0': {},
                },
                
                // Icons
                '.icon': {
                    '@apply inline-block w-4 h-4 align-middle': {},
                },
                '.icon-xs': {
                    '@apply w-3 h-3': {},
                },
                '.icon-sm': {
                    '@apply w-4 h-4': {},
                },
                '.icon-lg': {
                    '@apply w-6 h-6': {},
                },
                '.icon-primary': {
                    '@apply text-[#0066CC]': {},
                },
                '.icon-white': {
                    '@apply text-white': {},
                },
                
                // Utilities
                '.text-primary': {
                    '@apply text-[#0066CC]': {},
                },
                '.text-muted': {
                    '@apply text-[#5C6F82]': {},
                },
                '.text-uppercase': {
                    '@apply uppercase': {},
                },
                '.shadow-sm': {
                    '@apply shadow-[0_2px_4px_rgba(0,0,0,0.1)]': {},
                },
                '.shadow-md': {
                    '@apply shadow-[0_4px_8px_rgba(0,0,0,0.15)]': {},
                },
            });
        },
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
