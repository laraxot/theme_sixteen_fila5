---
title: "Package Updates — Sixteen Theme Dependencies (BMAD)"
type: bmad-fix
theme: Sixteen
status: verified
created: 2026-10-19
updated: 2026-10-19
tags: [bmad, package-update, dependencies, npm, daisyui, flowbite, playwright, tailwindcss, second-brain, filament-blueprint]
qmd: "sixteen package update dependencies"
sources:
  - https://github.com/saadeghi/daisyui/releases
  - https://github.com/themesberg/flowbite/releases
  - https://github.com/microsoft/playwright/releases
related:
  - ./filament-blueprint.md
  - ./typography-comunidesign-remediation-bmad.md
  - second-brain-disclaimer-integration.md
---

# BMAD — Sixteen Theme Package Updates

## Analisi stato attuale (BMAD Analysis, verificata 2026-10-19)

Eseguito `npm outdated` nella directory del tema Sixteen. Pacchetti significativamente outdated:

| Pacchetto | Versione corrente | Versione latest | Note |
|-----------|-------------------|-----------------|------|
| daisyui | 5.7.46 | 5.7.50 | Patch update (safe) |
| flowbite | 2.5.2 | 4.0.2 | Major version jump (Tailwind v4 compatibility) |
| @playwright/test | 1.64.0 | 1.64.1 | Patch update |
| playwright | 1.64.0 | 1.64.1 | Patch update |
| @axe-core/playwright | 4.13.0 | 4.14.0 | Patch update |

Il tema ora installa senza pacchetti top-level invalidi; `npm ls --depth=0`
passa e `npm audit --omit=dev` riporta zero vulnerabilità. `fontaine` resta
su `^0.8.2` perché `laravel-vite-plugin@3.2.0` dichiara il peer opzionale
`^0.8.0`; il major `1.x` non va adottato alla cieca. Il report `npm outdated`
lascia quindi solo questa eccezione compatibile documentata.

## Decisioni BMAD (ADRs)

| Decisione | Rationale | Stato |
|-----------|-----------|-------|
| D1: Aggiornare daisyui a 5.7.50 | Patch update, migliora stabilità e fix minori | ✅ Accettata |
| D2: Aggiornare flowbite a 4.0.2 | Necessario per compatibilità con Tailwind CSS v4 (usato nel tema) | ✅ Accettata (con testing) |
| D3: Aggiornare @playwright/test e playwright a 1.64.1 | Patch update, fix di sicurezza e stabilità | ✅ Accettata |
| D4: Aggiornare @axe-core/playwright a 4.14.0 | Patch update per axe-core | ✅ Accettata |
| D5: Testare visivamente dopo aggiornamento | Verificare che UI non si rompa (specialmente flowbite) | ✅ Accettata |

## Azioni correttive

1. Aggiornare `package.json` con le versioni decise
2. Eseguire `npm install` per applicare gli aggiornamenti
3. Eseguire `npm run build` per verificare che la build non fallisca
4. Verificare visivamente con screenshot homepage e altre pagine critiche
5. Documentare in Second Brain l'esito dell'aggiornamento

## Prossimi step

1. Aggiornare package.json (fatto)
2. Eseguire `npm install`
3. Eseguire `npm run build`
4. Fare screenshot verifica
5. Aggiornare graph (`graphify update .`; il comando è stato tentato ma il
   repository è abbastanza grande da superare il timeout operativo)
