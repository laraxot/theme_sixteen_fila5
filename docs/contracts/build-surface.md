---
title: "Contratto — build asset Sixteen"
type: build-contract
theme: Sixteen
created: 2026-11-23
updated: 2026-11-23
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
---

# Build asset Sixteen

## Input

- Sorgenti Vite del tema e `package.json`.
- `npm run build`, che esegue `prepare:static-assets`, `vite build` e `prune:assets`.

## Output

Asset compilati nella directory `public/` del tema, con base URL `/themes/Sixteen/` e manifest Vite.

## Invarianti

- La build usa il Vite config del tema e non una copia di configurazione del modulo.
- `public_html/themes/Sixteen` risolve la directory `public/` del tema tramite symlink gestito dal deploy.
- Il package non espone uno script `copy`.
- La build non modifica dati applicativi, routing o contratti di dominio.

## Effetti collaterali

- Prepara asset statici.
- Rimuove asset compilati non più presenti secondo `prune:assets`.

## Errori

Un fallimento Vite o degli script preparatori rende l'output non verificato; non si dichiara una build riuscita dal solo
manifest già presente.

## Non fa

- Non pubblica copiando file in `public_html`.
- Non possiede Action di dominio, policy o dati CMS.
- Non autorizza una pagina Folio aggiuntiva come workaround di build.
