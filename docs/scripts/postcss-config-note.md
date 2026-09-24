# postcss.config.cjs — Design Decision

- **location**: **theme root** (`laravel/Themes/Sixteen/postcss.config.cjs`), NOT in `scripts/`
- **movement decision**: **intentionally kept in root — May 16 2026**
- **deps**: postcss-import, postcss-nesting, autoprefixer (installed in theme node_modules)

## Rationale

`postcss.config.cjs` is a **build artifact / build tool configuration**. PostCSS plugins are resolved and executed
at the theme root — the standard Node.js convention for PostCSS is that the config file lives at the project root
or in the directory where npm scripts run. Moving it to `scripts/` would break `npm run build` / `npm run dev`.

## plugins

```js
module.exports = {
  plugins: {
    'postcss-import': { resolve(id) { return require.resolve(id); } },
    'postcss-nesting': {},
    autoprefixer: {},
  }
}
```

Configures:
- **postcss-import** with `require.resolve` — inlines CSS imports as the theme expects
- **postcss-nesting** — enables SCSS-style nesting in plain CSS
- **autoprefixer** — vendor prefixes
