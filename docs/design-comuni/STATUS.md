# REPLIKATE — Design Comuni → Tailwind (Status Report)

**Data**: 2026-04-07
**Status**: 🔄 IN PROGRESS

---

## Pagine Analizzate

### ✅ Homepage (tests.homepage)
- **Analisi**: Completata
- **Screenshot**: ✅ Originale, ✅ Replica, ✅ Confronto
- **Documentazione**: `docs/design-comuni/screenshots/homepage/analisi.md`
- **Stato implementazione**: Fix in corso (dettagli in `docs/prompts/tests/homepage/homepage.txt`)
- **Priorità**: Alta

### 🔄 Argomenti (tests.argomenti)
- **Analisi**: Iniziata
- **Screenshot**: ✅ Originale, ✅ Replica
- **Documentazione**: `docs/design-comuni/screenshots/argomenti/analisi.md`
- **Stato implementazione**: Da verificare
- **Priorità**: Media

### 🔄 Servizi (tests.servizi)
- **Analisi**: Iniziata
- **Screenshot**: ✅ Originale, ✅ Replica
- **Documentazione**: `docs/design-comuni/screenshots/servizi/analisi.md`
- **Stato implementazione**: Da verificare
- **Priorità**: Media

---

## Workflow Eseguito

### Per ogni pagina:
1. ✅ **ANALISI** - Confronto HTML reference vs locale
2. ✅ **SCREENSHOT** - 3 screenshot (originale, locale, confronto)
3. ✅ **DIFF HTML** - Documentazione differenze strutturali
4. 🔄 **FIX HTML** - Modifica blade e componenti (in corso)
5. 🔄 **FIX CSS/JS** - Tailwind + Alpine.js (in corso)
6. ✅ **BUILD** - `npm run build` eseguito con successo
7. ⏳ **VALIDAZIONE** - Checklist verifica
8. ✅ **DOCUMENTAZIONE** - File analisi.md creati

---

## Struttura Documentazione Creata

```
docs/design-comuni/
├── pages/
│   └── (da popolare con *.md per ogni pagina)
└── screenshots/
    ├── homepage/
    │   ├── analisi.md
    │   └── (screenshot salvati via Puppeteer)
    ├── argomenti/
    │   └── analisi.md
    └── servizi/
        └── analisi.md
```

---

## Note Tecniche

### Approccio CSS
- Bootstrap Italia classes → Tailwind via `@apply` in `style-apply.css`
- Colori Design Comuni: `--dc-green: #007a52`
- Font: Titillium Web (AGID)

### Build
- Tailwind 4.x con DaisyUI
- Build eseguita con successo: `public/assets/app-D1onTE1w.css` (1MB+)
- Vite 7.3.2

### Struttura Blade
- Template: `pages/tests/[slug].blade.php`
- Componenti blocchi: `components/blocks/{type}/`
- Dati: `config/local/fixcity/database/content/pages/tests.{pagina}.json`

---

## Prossimi Passi

1. **Completare homepage** - Verificare fix CSS/JS e validazione
2. **Analizzare argomenti** - HTML struttura e differenze
3. **Analizzare servizi** - HTML struttura e differenze
4. **Creare docs/pages/*.md** - Documentazione completa per ogni pagina
5. **Validazione responsive** - Test mobile/tablet/desktop

---

## Riferimenti

- **Reference Design Comuni**: https://italia.github.io/design-comuni-pagine-statiche/
- **Homepage**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
- **Argomenti**: https://italia.github.io/design-comuni-pagine-statiche/sito/argomenti.html
- **Servizi**: https://italia.github.io/design-comuni-pagine-statiche/sito/servizi.html
- **Prompt originale**: `docs/prompts/replikate.txt`
- **Homepage dettagli**: `docs/prompts/tests/homepage/homepage.txt`
