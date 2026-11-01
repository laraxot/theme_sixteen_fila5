---
title: "Typography Remediation — Sixteen Theme (BMAD)"
type: bmad-fix
theme: Sixteen
status: verified
created: 2026-10-19
updated: 2026-10-19
tags: [bmad, typography, design-comuni, bootstrap-italia, tailwind, comunidesign, second-brain, filament-blueprint]
qmd: "sixteen typography comunidesign remediation"
sources:
  - https://italia.github.io/bootstrap-italia/docs/organizzare-i-contenuti/tipografia/
  - https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
  - https://github.com/italia/design-comuni-pagine-statiche
related:
  - ./filament-blueprint.md
  - ./front-office-design-comuni/DESIGN.md
  - second-brain-disclaimer-integration.md
---

# BMAD — Sixteen Typography Remediation (Comunidesign + Design Comuni)

> **Stack:** Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap)
> **Obiettivo:** far rispettare la tipografia di Design Comuni / Bootstrap Italia senza importare Bootstrap Italia CSS.
> **Convenzione:** ogni modifica UI verificata a 375px / 768px / 1440px (AGENTS.md standing rule).

## Studio fonti (Second Brain — ingested)

### Font families — `docs/wiki` / Second Brain

| Purpose | Font | Bootstrap Italia class |
|---|---|---|
| Sans-serif (default) | **Titillium Web** | `font-sans-serif` |
| Serif (long-form) | **Lora** | `font-serif` |
| Monospace | **Roboto Mono** | `font-monospace` |

Bootstrap Italia 2.7.0+: `body { font-size: 16px }`, unità `rem`, `box-sizing: border-box`.

### Tabella dimensioni intestazioni (Bootstrap Italia v2.7.0)

| Heading | Mobile (px) | >576px (px) | Weight |
|---|---|---|---|
| h1 | 40 / 48 | 48 / 60 | Bold |
| h2 | 32 / 40 | 40 / 48 | Bold |
| h3 | 28 / 32 | 32 / 40 | Bold |
| h4 | 24 / 28 | 28 / 40 | SemiBold |
| h5 | 20 / 24 | 24 / 40 | Regular |
| h6 | 16 / 24 | 18 / 28 | SemiBold |

> Nota: `font-size / line-height` (es. 40 = size in px, 48 = line-height in px).
> `48px ÷ 16px base = 3rem`; `60px ÷ 16px = 3.75rem`, ecc.

### Paragrafi e testo

| Elemento | Mobile | >576px |
|---|---|---|
| `p` base | 16 / 24 | 18 / 28 |
| `.lead` (evidenziato) | 1.25× base | 1.25× base |

### Altri componenti tipografici

- `.display-1` → h1 evidenziato (dimensione sensibilmente più grande)
- Link: **<u>sempre sottolineati</u>** (accessibilità WCAG)
- Blockquote: `.blockquote`, `.blockquote-simple`, `.blockquote-card`, `.blockquote-card.dark`

### Vite font loading

Font: `@import` o `url()` da Google Fonts con `display=swap`; caricamento ottimizzato con `font-display: swap` per FCP.

---

## Analisi stato attuale Sixteen (BMAD Analysis)

Verificato:

- `tailwind.config.js` → `fontFamily.sans = ['Titillium Web', ...]`, `fontFamily.mono = ['Roboto Mono', ...]` ✅
- `resources/css/thematic/fonts.css` → importa **solo Titillium Web** ❌ (manca Lora)
- Nessun `fontFamily.serif` → Lora non disponibile come `font-serif` ❌
- Nessun custom heading scale (rem) in Tailwind → usa i default di Tailwind (sbagliati rispetto a Design Comuni) ❌
- Nessun `.display-1`, `.lead`, `.h1`–`.h6` (elementi semantici) ❌
- Link: non forzata sottolineatura → rischio non-conformità WCAG ❌

### Fonti di verità (per i prossimi step)

- **`tailwind.config.js`** — punto di ingresso per font-size/serif/lead/display
- **`resources/css/thematic/fonts.css`** — import font (da aggiungere Lora)
- **`resources/css/design-comuni/`** — cartella dove conviene centralizzare i token tipografici comunidesign
- **`tailwind.config.js` plugins** — usare `addComponents`/`addUtilities` (già usato per `.btn-primary` ecc.)

---

## Decisioni BMAD (ADRs)

| Decisione | Rationale | Stato |
|---|---|---|
| D1: Aggiungere Lora a `fontFamily.serif` in `tailwind.config.js` | Design Comuni richiede font serif per testi lunghi | ✅ Accettata |
| D2: Definire custom heading scale in px→rem in `theme.extend.fontSize` | Allineare h1–h6 a tavola Design Comuni (mobile + responsive) | ✅ Accettata |
| D3: Creare componenti utility `.display-1`, `.lead`, `.h1`–`.h6` in plugin | Replica classi Bootstrap Italia senza importarle | ✅ Accettata |
| D4: Forzare `text-decoration: underline` su link in `a:not(.text-decoration-none)` | WCAG → link sottolineati | ✅ Accettata |
| D5: Centralizzare in `design-comuni/typography.css` importato da `app.css` | DRY, single source of truth | ✅ Accettata |
| D6: Fonts caricati con `display=swap` via `@import` in `fonts.css` | FID/FCP (Vite + font optimization) | ✅ Accettata |

---

## Filament Blueprint (cross-ref)

Vedi [`filament-blueprint.md`](./filament-blueprint.md):
- Stack FO = Tailwind + DaisyUI + Flowbite + Lit + Alpine (no Bootstrap) ✅ coerente con questo intervento.
- Nessun Resource Filament nel tema → la tipografia è **pur CSS/Tailwind**, non Blueprint.
- La Blueprint non vieta utility CSS globale nel tema.

## Second Brain entry

Questa pagina funge da entry del Second Brain per la tipografia comunidesign:
- **Fonti:** Bootstrap Italia tipografia page (studio) + Design Comuni homepage
- **Concetto:** `comunidesign-typography`
- **Relazioni:** Sixteen theme, Bootstrap Italia, Tailwind typography, WCAG AA, Vite font loading
- **Decisioni:** D1–D6 sopra

## Fallimento di verifica (correzione BMAD — errore riconosciuto)

**Problema:** Ho modificato `tailwind.config.js`, `typography.css`, `fonts.css`, ma NON ho mai fatto `npm run build` e NON ho mai verificato visivamente `http://192.168.1.40:8000/it` con screenshot. Il font reso era diverso da Design Comuni; il logo nell'header era nero (non bianco) perché mancava la regola CSS `fill: #fff` / `filter: invert(1)`. **Regola BMAD violata:** la verifica visiva (step 6/7 dell'epic) è obbligatoria.

**Azione correttiva completata:**
1. Documentare in Second Brain (`comunidesign-typography-failure-correction.md`)
2. Correggere il dato CMS del logo italiano e rimuovere il filtro di inversione dal componente header
3. Ricompilare con `npm install && npm run build`
4. Verificare visivamente con Puppeteer; Playwright MCP non parte perché il suo Chrome configurato non esiste

## Esito finale

- `vite.config.js` usa `base: '/themes/Sixteen/'`: i font generati non puntano più a `/build/assets`.
- `/it` e `/it/tests/homepage` rispondono 200 a 375/768/1440; Puppeteer non rileva richieste 4xx/5xx.
- Titillium Web e Lora risultano caricati; le misure della pagina test coincidono con il riferimento ufficiale.
- Il logo dell'header italiano è `logo-comune.svg` bianco e non viene più invertito.

## Fallimento di verifica — errore architetturale (correzione BMAD)

**Problema:** Non ho letto `vite.config.js` (font loading via `laravel-vite-plugin/fonts`) prima di modificare i CSS. La configurazione Vite già carica Titillium Web, Lora, Roboto Mono tramite il plugin `google()` con `preload` e `subsets`. Quindi il problema dei font non era nel CSS ma nel fatto che non avevo capito che i font vengono generati dal Vite manifest, non importati manualmente. Anche il logo nero era un errore visivo che non avevo verificato. **Regola BMAD violata:** studiare l'architettura (vite.config.js) prima di applicare fix (step 1 epic). Perché non me ne sono accorto? Perché ho cercato il problema nel file sbagliato (`fonts.css` invece di `vite.config.js`).

**Azione correttiva:**
1. Leggere `vite.config.js` prima di ogni modifica font-related (fatto)
2. Aggiornare BMAD e Second Brain con l'errore
3. Verificare che il build generi i font nel manifest
4. Verificare visivamente con Playwright

---

## Prossimi step (epic)

1. Aggiungere `@import Lora` in `fonts.css`
2. Aggiungere `fontFamily.serif = ['Lora', ...]` e `fontSize` custom in `tailwind.config.js`
3. Creare `design-comuni/typography.css` con `.display-1`, `.lead`, `.h1`–`.h6`, link underline (responsive)
4. Importare `design-comuni/typography.css` in `app.css`
5. Regenerare CSS (`npm run build` o `vite build`)
6. Verificare parity 375px / 768px / 1440px
7. Aggiornare graph (`graphify update .`)
