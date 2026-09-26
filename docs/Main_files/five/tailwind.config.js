/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,ts,jsx,tsx}'],
  safelist: [
    'text-green-600',
    'text-gray-800',
    'text-gray-700',
    'hover:bg-gray-100',
    'hover:text-green-600',
    'bg-white',
    'border-gray-200'
  ],
  theme: {
    extend: {
      colors: {
        'bootstrap-primary': '#0066cc',
        'bootstrap-secondary': '#6c757d',
        'bootstrap-success': '#28a745',
        'bootstrap-info': '#17a2b8',
        'bootstrap-warning': '#ffc107',
        'bootstrap-danger': '#dc3545',
        'bootstrap-light': '#f8f9fa',
        'bootstrap-dark': '#343a40',
        'bootstrap-muted': '#5c6f82',
        'bootstrap-border': '#dfe5eb',
        'bootstrap-bg-grey': '#f6f9fc',
      },
      fontFamily: {
        'bootstrap': ['Titillium Web', 'sans-serif'],
      },
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
      },
      borderRadius: {
        'bootstrap': '0.375rem',
      }
    },
  },
  plugins: [
    require('daisyui')
  ],
  daisyui: {
    themes: [
      {
        bootstrap_italia: {
          "primary": "#007a52",
          "primary-focus": "#00614a",
          "primary-content": "#ffffff",
          "secondary": "#5d7083",
          "secondary-focus": "#4a5a6b",
          "secondary-content": "#ffffff",
          "accent": "#006cc6",
          "accent-focus": "#0056b3",
          "accent-content": "#ffffff",
          "neutral": "#17334f",
          "neutral-focus": "#0f2238",
          "neutral-content": "#ffffff",
          "base-100": "#ffffff",
          "base-200": "#f8f9fa",
          "base-300": "#e9ecef",
          "base-content": "#17334f",
          "info": "#17a2b8",
          "success": "#008055",
          "warning": "#ffc107",
          "error": "#dc3545",
        },
      },
      "light", // fallback theme
    ],
    styled: true,
    base: true,
    utils: true,
    logs: true,
    rtl: false,
  },
}
