---
title: "Research — DesignComuni static pages and frontend direction"
type: research
status: verified
tags: [design-comuni, research, wcag, ui-ux-pro-max, impeccable, taste]
sources:
  - "https://italia.github.io/design-comuni-pagine-statiche/index.html"
  - "https://italia.github.io/design-comuni-pagine-statiche/servizi/index.html"
  - "https://github.com/italia/design-comuni-pagine-statiche"
  - "https://impeccable.style/"
  - "https://www.tasteskill.dev/"
  - "https://github.com/nextlevelbuilder/ui-ux-pro-max-skill"
  - "https://github.com/cloudai-x/threejs-skills"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "verified findings sixteen"
---

# Verified findings

## DesignComuni catalogue

The catalogue groups templates into Generali, Amministrazione, Novità, Servizi,
Vivere il Comune, booking, assistance and Segnalazione Disservizio. The reporting
family is explicit and complete:

- service presentation;
- privacy consent;
- report data entry;
- summary and correction;
- submission confirmation;
- personal-area activity;
- report list and map.

The service family establishes the same information architecture for `servizi`,
category pages and a service detail page: breadcrumb, page title, contextual page
index, structured sections, access CTA, conditions, contacts, feedback and footer.

## What must be preserved

- institutional slim/header/navigation hierarchy and footer;
- breadcrumb before the page title;
- a strong, left-aligned title and readable content column;
- explicit headings such as “A chi è rivolto”, “Descrizione”, “Come fare”, “Cosa
  serve”, “Cosa si ottiene”, “Costi/Tempi”, “Condizioni di servizio” and “Contatti”;
- a visible four-step service stepper for the report flow;
- list + map for report discovery, with a usable list alternative;
- feedback and recovery states, not decorative motion.

## Implementation interpretation

Impeccable and Taste are used as quality filters: reduce AI-slop, preserve the
public-sector trust language, avoid gratuitous gradients/cards, and make hierarchy
and next action obvious. UI UX Pro Max supplies concrete accessibility and form
recovery checks. Three.js skills are installed for future decorative enhancement,
but no 3D is allowed in critical civic journeys unless it survives reduced-motion,
keyboard and low-power checks.

The official repository is the source for information architecture and markup
patterns. The application implementation uses Tailwind + Alpine + Lit + DaisyUI +
Flowbite and local assets; Bootstrap Italia is not copied as a runtime dependency.

## Additional official references

- [UI Kit Italia v3](https://github.com/italia/design-ui-kit) is the official design
  resource for foundations and components; its tokens are maintained separately in
  `design-tokens-italia`.
- [Design system .italia](https://designers.italia.it/design-system/) defines the
  foundations/components workflow and token levels; we map those decisions into
  Tailwind CSS variables instead of installing a competing CSS framework.
- [Comuni model](https://designers.italia.it/modelli/comuni/) confirms the public,
  citizen-centred purpose and ready-to-use municipal model.
- [LG design servizi web](https://docs.italia.it/italia/design/lg-design-servizi-web/it/versione-corrente/)
  establishes accessibility, reliability/security, simplicity of consultation,
  monitoring, UI and implementation as explicit requirements.
- [Bootstrap Italia](https://italia.github.io/bootstrap-italia/) was studied only
  as historical/reference material for the .italia visual language. It is not an
  allowed implementation dependency for Sixteen.
# Addendum — ODS architettura informativa comunale (2026-10-11)

È stato scaricato e studiato il modello ufficiale Designers Italia v2.0
[Architettura dell'informazione dei siti web dei Comuni](https://designers.italia.it/files/resources/modelli/comuni/adotta-il-modello-di-sito-comunale/definisci-architettura-e-contenuti/Architettura-informazione-sito-Comuni.ods).
Il file organizza ontologia, tassonomie, coreografia, sistema di navigazione e
tipologie di contenuto. Il redesign Fixcity mappa la segnalazione come pratica
civica collegata a un servizio, con luogo, punto di contatto, messaggi e
documenti pubblici; il tema Sixteen ne cura solo la resa.
