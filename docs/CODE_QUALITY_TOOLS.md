---
<<<<<<< .merge_file_dvYGWh
title: "Sixteen — tool di qualità"
type: reference
status: stable
source_of_truth: true
theme: Sixteen
created: 2025-01-27
updated: 2026-10-15
tags: [quality, phpstan, theme, sixteen]
qmd: "sixteen code quality tools phpstan eslint prettier stylelint markdown gate"
related:
  - ./CODE_QUALITY_ANALYSIS.md
  - ./README.md
  - ../../../../bashscripts/docs/prompts/03-quality-gates.md
  - ../../../../bashscripts/docs/prompts/11-phpstan.md
  - ../../../../bashscripts/ai/wiki/memories/phpstan-quality-docs-bmad-standing-order.md
issues: []
discussions: []
---

# Sixteen: tool di qualità
=======
title: "CODE QUALITY TOOLS"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "CODE QUALITY TOOLS"
issues: []
discussions: []
status: draft
---

# 🔍 Code Quality Tools - Tema Sixteen

**Data Creazione**: 2025-01-27  
**Status**: 🚀 ATTIVO  
**Scope**: Tema Sixteen  
**Priority**: HIGH  

---
## 🎯 OVERVIEW

Il tema Sixteen utilizza una suite completa di strumenti di analisi del codice per garantire la massima qualità, sicurezza e manutenibilità delle funzionalità frontend.

## 🛠️ STRUMENTI INTEGRATI

### **Frontend**
- **ESLint**: ✅ Configurato
- **Prettier**: ✅ Configurato
- **Stylelint**: ✅ Configurato
- **HTMLHint**: ✅ Configurato

### **CSS/SCSS**
- **Stylelint**: ✅ Configurato
- **PostCSS**: ✅ Configurato
- **Autoprefixer**: ✅ Configurato

### **JavaScript/TypeScript**
- **ESLint**: ✅ Configurato
- **Prettier**: ✅ Configurato
- **TypeScript**: ✅ Configurato

### **Documentation**
- **Markdownlint**: ✅ Configurato

## 📊 METRICHE CORRENTI

### **Frontend Quality**
- **ESLint**: ✅ 0 errori
- **Prettier**: ✅ Conforme
- **Stylelint**: ✅ 0 errori
- **HTMLHint**: ✅ 0 errori

### **Performance**
- **Bundle Size**: ~400kb (target: <300kb)
- **FCP**: ~2.1s (target: <1.5s)
- **LCP**: ~3.2s (target: <2.5s)
- **Lighthouse**: 78 (target: 95+)

### **Security**
- **Gitleaks**: ✅ Nessun segreto rilevato
- **OSV Scanner**: ✅ Nessuna vulnerabilità

## 🚀 UTILIZZO

### **Controllo Completo**
```bash
# Esegue tutti gli strumenti di analisi
./scripts/full-code-quality-check.sh
```

### **Correzione Automatica**
```bash
# Corregge automaticamente i problemi risolvibili
./scripts/fix-code-quality-issues.sh
```

### **Controlli Specifici**

#### Frontend
```bash
# ESLint
npx eslint "resources/js/**/*.{js,ts,jsx,tsx}"

# Prettier
npx prettier --check "resources/**/*.{js,ts,jsx,tsx,css,scss,html,md}"

# Stylelint
npx stylelint "resources/**/*.{css,scss}"

# HTMLHint
npx htmlhint "resources/views/**/*.blade.php"
```

#### Build Tools
```bash
# Vite build
npm run build

# Vite dev
npm run dev

# Vite watch
npm run watch
```

## 📋 CONFIGURAZIONI

### **ESLint**
- **File**: `.eslintrc.js`
- **Rules**: Recommended + TypeScript
- **Exclude**: node_modules, vendor, build

### **Prettier**
- **File**: `.prettierrc`
- **Rules**: Single quotes, semicolons, 80 chars
- **Exclude**: node_modules, vendor, build

### **Stylelint**
- **File**: `.stylelintrc.json`
- **Rules**: Standard + Prettier
- **Exclude**: node_modules, vendor, build

### **Vite**
- **File**: `vite.config.js`
- **Features**: Hot reload, CSS processing, asset optimization
- **Exclude**: node_modules, vendor

## 🎯 BEST PRACTICES

### **Pre-commit**
1. Esegui analisi completa
2. Applica correzioni automatiche
3. Verifica che tutti i check passino
4. Commit solo se tutto è pulito

### **Code Review**
1. Controlla report di qualità
2. Verifica metriche di performance
3. Assicurati che la documentazione sia aggiornata
4. Testa le modifiche

### **CI/CD Integration**
- Esegui controlli automatici su ogni PR
- Blocca merge se la qualità non è sufficiente
- Genera report automatici
- Notifica per problemi critici

## 📊 REPORT

I report vengono generati nella cartella `reports/` e includono:
- **eslint-report.json**: Problemi JavaScript/TypeScript
- **stylelint-report.json**: Problemi CSS
- **htmlhint-report.json**: Problemi HTML
- **summary-report.md**: Riepilogo completo

## 🚨 TROUBLESHOOTING

### **Problemi Comuni**
>>>>>>> .merge_file_XdmcY8

## Scopo

Il tema Sixteen serve il front office (layout, componenti, asset). La qualità
qui significa: markup/CSS/JS coerenti col design system e nessun silenziatore
che nasconda errori statici nei moduli PHP che il tema consuma.

## Gate rilevanti

| Area | Dove | Prompt |
|------|------|--------|
| PHP (moduli usati dal tema) | `cd laravel && ./vendor/bin/phpstan analyse Modules` | [11-phpstan.md](../../../../bashscripts/docs/prompts/11-phpstan.md) |
| Gate sessione | perimetro toccato + lock | [03-quality-gates.md](../../../../bashscripts/docs/prompts/03-quality-gates.md) |
| Docs tema | questa cartella `docs/` | [44-module-docs-continuous.md](../../../../bashscripts/docs/prompts/44-module-docs-continuous.md) |

Standing order:
[phpstan-quality-docs-bmad-standing-order.md](../../../../bashscripts/ai/wiki/memories/phpstan-quality-docs-bmad-standing-order.md).

## Frontend (quando il task tocca asset del tema)

<<<<<<< .merge_file_dvYGWh
- Lint/format del tree del tema (ESLint, Prettier, Stylelint) solo se i binari
  e le config esistono nel tema; assenza binario = skip ambiente, non pass.
- Niente claim di "0 errori" senza output allegato della run.
=======
### **Guide Specifiche**
- [Frontend Code Quality Guide](../../Modules/Xot/docs/frontend-code-quality.md)
- [Performance Optimization Guide](./performance-optimization.md)
- [AGID Design System Guide](./agid-design-system.md)
>>>>>>> .merge_file_XdmcY8

## Docs

- Un canonico per argomento; nomi `.md` minuscoli kebab-case senza date
  (eccezione case: `README.md`). Prima di creare:
  `python3 -I bashscripts/tools/docs/md-filenames.py name <percorso>`.
- Analisi storica: [CODE_QUALITY_ANALYSIS.md](./CODE_QUALITY_ANALYSIS.md)
  (evidence; non sostituisce una rimisurazione).

## Divieti

Git forward-only; niente ignore/baseline PHPStan; niente nuove cartelle `docs/`.
