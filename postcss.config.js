export default {
  plugins: {
    'postcss-import': {},
    'postcss-nesting': {},
    '@tailwindcss/postcss': {},
    autoprefixer: {},
    // ultimo: limita le regole legacy con !important agli elementi fuori da .dc-page
    './postcss/isolate-legacy-important.cjs': {},
  },
}
