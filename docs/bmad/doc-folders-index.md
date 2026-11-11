---
frontmatter: true
title: DOC Folders Index (BMAD + Second Brain)
type: bmad-index
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "doc folders index sixteen"
---
# DOC Folders Index

> 🧠 **From Second Brain (knowledge.md)** — R001: folder naming must include slug + descrizione; R003: no Bootstrap nella documentazione; R004: focus-visible + accessibility nei componenti.

## Theme (Sixteen) — docs/bmad/
- `stories/` — 121 .story.md (homepage-visual-parity-97, risultati-ricerca, eventi, evento-dettaglio, accesso-servizio, segnalazione-01-privacy, segnalazione-dettaglio, segnalazioni-elenco)
- `architecture/` — homepage-visual-parity-arch.md + index
- `brainstorm/` — accesso-servizio.md, eventi.md, documenti-dati.md
- `decisions/` — decision-accessibility-improvements.md, decision-header-footer-consolidation.md, decision-header-footer-fixes.md, parity-root-cause-and-guardrails.md
- `evidence/` — reference PNG + JSON screenshots (risultati-ricerca, amministrazione, accesso-servizio a 1440/768)
- `prompts/` — homepage/index.md, search-results/index.md
- `README.md` + `55-md-conventions-enhanced.md`

## Theme — docs/second-brain/
- `knowledge.md` — R001-R003 regole, token `bg-primary-600`, focus-visible, NO Bootstrap
- `header-footer-rationale.md` — consolidamento header/footer JSON-driven

## Theme — docs/ (root)
- `chat/chat/INDEX.md` — log conversazioni
- `bmad/` — as above
- `bmad/story/homepage-visual-parity.story.md` — principale (97% target, 14 difformità, 90% HTML verified)
- `visual-parity/scripts/` — script verifica

## Module (example) — Modules/*/docs/
- Ogni modulo ha `docs/` con `stories/`, `investigation/`, `decision-log.md` (per BMAD compliance della documentazione)
- `Modules/Quaeris/docs/` — pulse-dashboard-custom-cards story (esempio esistente)
- `Modules/Cms/docs/` — page management docs
- `Modules/User/docs/` — auth/user docs
- Tutti i moduli seguenti con `docs/`: Activity, AI, Blog, Cms, Comment, Fixcity, Gdpr, Geo, Job, Lang, Media, Mobile, Notify, Rating, Seo, Tenant, UI, User, Xot

## Status File (repo root)
- `/STATUS_RISULTATI_RICERCA.md` — stato risultati ricerca (200 OK, 152522B, 645 risultati)

## Index / Search
- `qmd` indexing per ricerche rapide su `docs/`
- `stories/` è il punto operativo per nuove conversazioni di lavoro, claim, handoff,
  decisioni e verifiche BMAD
- `docs/chat/` è legacy/archive: non creare nuove note operative lì

## Filament Wizard — /it/tickets/create (NEW)
- Story: `docs/bmad/stories/fil-tickets-create-filament-wizard-parity.story.md`
- WHY: design-comuni `segnalazione-01-privacy.html` = multi-step form → Filament wizard = step navigation (97% parity)
- Component: Filament wizard (native), NO custom form HTML
- JSON: `tickets.create.json` (config/local/fixcity; verifica con `bashscripts/tools/cms/page-json-for-url.sh`)
- Module docs: update per module owning tickets
- Second brain rule: wizard = Filament component (not custom HTML)

## Stack confirmation
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap Italia). Token `bg-primary-600` / `bg-primary-500` per primario; `focus:ring-primary-500` per accessibilità.

## Filament Wizard Rule (new, from tickets/create request)
When visual parity requires multi-step form (design-comuni segnalazione/privay/accesso), USE Filament `Wizard` component, NOT custom Blade form. Matches design-comuni pattern exactly.
