# Guida ai Comandi di Build - Tema Sixteen

## Panoramica

Questa guida descrive i comandi necessari per buildare e pubblicare il tema Sixteen con supporto completo per Filament 4.x.

## Prerequisiti

### Dipendenze Richieste

- **Node.js**: 16+ (raccomandato 18+)
- **NPM**: 8+ (raccomandato 9+)
- **Composer**: 2.0+
- **PHP**: 8.1+

### Verifica Installazione

```bash
# Verificare versioni
node --version
npm --version
composer --version
php --version
```

## Comandi di Build

### 1. Preparazione Ambiente

```bash
# Navigare nella cartella del tema Sixteen
cd laravel/Themes/Sixteen

# Verificare struttura
ls -la
```

### 2. Installazione Dipendenze

```bash
# Installare dipendenze NPM
npm install

# Installare dipendenze Composer (se necessario)
composer install

# Verificare installazione
npm list --depth=0
composer show --installed
```

### 3. Build degli Asset

#### Build per Sviluppo

```bash
# Build con watch mode per sviluppo
npm run dev

# Build una tantum per sviluppo
npm run build
```

#### Build per Produzione

```bash
# Build ottimizzato per produzione
npm run build:production

# Build con analisi del bundle
npm run build:analyze

# Build con compressione
npm run build -- --minify
```

### 4. Pubblicazione Asset

```bash
# Copiare asset compilati nella directory pubblica
npm run copy

# Watch mode per sviluppo (copia automatica)
npm run copy:watch
```

## Configurazione Avanzata

### 1. Script NPM Personalizzati

Il tema Sixteen include script personalizzati per diverse esigenze:

```json
{
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "build:analyze": "vite build --mode analyze",
    "build:production": "vite build --mode production",
    "preview": "vite preview",
    "copy": "cp -r ./public/* ../../../public_html/themes/Sixteen/",
    "copy:watch": "nodemon --watch ./public --exec 'npm run copy'",
    "lint": "eslint resources/js/**/*.js",
    "lint:fix": "eslint resources/js/**/*.js --fix",
    "format": "prettier --write resources/**/*.{js,css,blade.php}",
    "test": "jest",
    "test:watch": "jest --watch",
    "analyze": "vite build --mode analyze",
    "analyze:serve": "npx serve dist",
    "bundle-report": "npm run analyze && open dist/stats.html"
  }
}
```

### 2. Configurazione Vite

Il file `vite.config.js` è configurato per supportare Filament 4.x:

```javascript
import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig({
    build: {
        outDir: './public',
        emptyOutDir: false,
        manifest: 'manifest.json',
    },
    ssr: {
        noExternal: ['chart.js/**']
    },
    plugins: [
        laravel({
            publicDirectory: '../../../public_html/',
            input: [
                __dirname + '/resources/css/app.css',
                __dirname + '/resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources',
        },
    },
});
```

### 3. Configurazione Tailwind

Il file `tailwind.config.js` include il preset Filament 4.x:

```javascript
import defaultTheme from 'tailwindcss/defaultTheme';
import preset from "./vendor/filament/support/tailwind.config.preset";

module.exports = {
    presets: [preset], // Preset Filament 4.x
    darkMode: 'class',
    theme: {
        extend: {
            // Configurazione personalizzata
        },
    },
    content: [
        // Paths Filament 4.x
        '../../app/Filament/**/*.php',
        '../../resources/views/**/*.blade.php',
        '../../vendor/filament/**/*.blade.php',
        // Paths tema Sixteen
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        // Paths moduli
        "../../Modules/**/Filament/**/*.php",
        "../../Modules/**/resources/views/**/*.blade.php",
        // Paths temi
        "../../Themes/**/resources/views/**/*.blade.php",
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('daisyui'),
        require("flowbite/plugin"),
    ],
};
```

## Workflow di Sviluppo

### 1. Sviluppo Locale

```bash
# Avviare watch mode per sviluppo
npm run dev

# In un altro terminale, avviare watch mode per copia
npm run copy:watch
```

### 2. Test e Linting

```bash
# Eseguire linting
npm run lint

# Correggere errori di linting
npm run lint:fix

# Formattare codice
npm run format

# Eseguire test
npm run test

# Eseguire test in watch mode
npm run test:watch
```

### 3. Analisi Bundle

```bash
# Analizzare dimensioni bundle
npm run analyze

# Servire report di analisi
npm run analyze:serve

# Generare report completo
npm run bundle-report
```

## Troubleshooting

### 1. Errori di Build

#### Errore: "Cannot find module"

```bash
# Pulire node_modules e reinstallare
rm -rf node_modules package-lock.json
npm install
```

#### Errore: "Vite manifest not found"

```bash
# Verificare che il build sia stato eseguito
npm run build

# Verificare che il copy sia stato eseguito
npm run copy
```

#### Errore: "Tailwind CSS not found"

```bash
# Verificare configurazione Tailwind
npx tailwindcss --init

# Verificare che le dipendenze siano installate
npm install @tailwindcss/forms @tailwindcss/typography
```

### 2. Errori di Pubblicazione

#### Errore: "Permission denied"

```bash
# Verificare permessi directory
ls -la ../../../public_html/themes/

# Correggere permessi se necessario
chmod -R 755 ../../../public_html/themes/Sixteen/
```

#### Errore: "Directory not found"

```bash
# Creare directory se non esiste
mkdir -p ../../../public_html/themes/Sixteen/

# Verificare struttura
ls -la ../../../public_html/themes/
```

### 3. Errori di Configurazione

#### Errore: "Vite config not found"

```bash
# Verificare che il file esista
ls -la vite.config.js

# Verificare sintassi
node -c vite.config.js
```

#### Errore: "Tailwind config not found"

```bash
# Verificare che il file esista
ls -la tailwind.config.js

# Verificare sintassi
npx tailwindcss --config tailwind.config.js --input input.css --output output.css
```

## Best Practices

### 1. Ordine dei Comandi

Sempre eseguire i comandi in questo ordine:

1. `npm install` - Installare dipendenze
2. `npm run build` - Buildare asset
3. `npm run copy` - Pubblicare asset

### 2. Verifica Build

Dopo ogni build, verificare:

```bash
# Verificare che i file siano stati generati
ls -la public/

# Verificare che i file siano stati copiati
ls -la ../../../public_html/themes/Sixteen/

# Verificare che il manifest sia presente
cat public/manifest.json
```

### 3. Pulizia Cache

Se si verificano problemi, pulire le cache:

```bash
# Pulire cache Laravel
php artisan view:clear
php artisan config:clear
php artisan cache:clear

# Pulire cache Vite
rm -rf public/hot
rm -rf public/build
```

### 4. Monitoraggio Performance

```bash
# Monitorare dimensioni bundle
npm run build:analyze

# Verificare performance build
time npm run build

# Verificare dimensioni file finali
du -sh ../../../public_html/themes/Sixteen/
```

## Automazione

### 1. Script di Build Completo

Creare uno script `build.sh`:

```bash
#!/bin/bash

echo "🚀 Avvio build tema Sixteen..."

# Navigare nella cartella del tema
cd laravel/Themes/Sixteen

# Installare dipendenze
echo "📦 Installazione dipendenze..."
npm install

# Build asset
echo "🔨 Build asset..."
npm run build

# Pubblicare asset
echo "📤 Pubblicazione asset..."
npm run copy

echo "✅ Build completato!"
```

### 2. Script di Sviluppo

Creare uno script `dev.sh`:

```bash
#!/bin/bash

echo "🚀 Avvio sviluppo tema Sixteen..."

# Navigare nella cartella del tema
cd laravel/Themes/Sixteen

# Avviare watch mode
echo "👀 Avvio watch mode..."
npm run dev &

# Avviare watch mode per copia
echo "📤 Avvio watch mode per copia..."
npm run copy:watch &

echo "✅ Sviluppo avviato!"
echo "Premi Ctrl+C per fermare"
```

## Collegamenti

- [Configurazione Stili Filament 4.x](filament-4x-styles-configuration.md)
- [Regole Critiche](critical-rules.md)
- [Configurazione Vite](vite-configuration-rules.md)
- [Documentazione Vite](https://vitejs.dev/guide/)
- [Documentazione Tailwind CSS](https://tailwindcss.com/docs)

---

**Ultimo aggiornamento**: Gennaio 2025
**Versione**: 1.0
**Compatibilità**: Filament 4.x, Vite 6.x, Tailwind CSS 3.x
