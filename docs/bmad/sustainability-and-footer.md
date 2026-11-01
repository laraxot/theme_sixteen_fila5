---
title: "Sostenibilità e footer del tema Sixteen"
type: bmad-reference
status: decision-input
updated: 2026-10-15
tags: [sixteen, footer, sustainability, bmad]
qmd: "scopo sixteen"
---

<!--
gateguard: supersedes shorter version of same path; linked from how-to-sustain.md and
footer-partner-sponsorship-marketing.md; user verbatim: "studia come potremmo sostenere il progetto e documenta tutto dentro le cartelle docs dentro i moduli e dentro i temi , fa tutto con bmad + second brain"
-->

# Scopo

Sixteen è il **vestito** del front office, non la strategia economica. Il footer
resta `<x-section slug="footer">` + JSON locale (DCP-222). Questo documento fissa
i vincoli UX se/quando partner o CTA di sostegno entreranno nel contratto.

## Come il tema sostiene (indirettamente) il progetto

1. Mantiene fiducia civica: chrome istituzionale leggibile e accessibile.
2. Può mostrare recognition «Partner e sostenitori» (loghi statici) *dopo* GO.
3. Preferisce CTA verso pagina dedicata CMS piuttosto che banner in linea.
4. Non introduce ad-tech, caroselli o endorsement impliciti.

## Linea guida UX

- Loghi statici + nome testuale + disclosure; alt text corretto.
- Reflow / zoom / tastiera / reduced motion: nessun layout a «fila banner»
  fragile.
- Copy: «Partner e sostenitori» o «Collabora» — non «Sponsor» come default.
- Designers Italia: partner ammessi nella fascia branding; non inventori ads.

## Confini

Niente campi JSON, Resource Filament, pagamenti o asset sponsor finché readiness
BMAD ≠ GO. Policy, beneficiario e diritti logo restano fuori dal tema.

## SSoT

- [how-to-sustain.md](../../../../../bmad-output/footer-sponsorship/how-to-sustain.md)
- [recommendation.md](../../../../../bmad-output/footer-sponsorship/recommendation.md)
- [footer-partner-sponsorship-marketing.md](../wiki/concepts/footer-partner-sponsorship-marketing.md)
- [Fixcity sustainability](../../../Modules/Fixcity/docs/sustainability-and-funding.md)
- Story: [footer-sponsor-marketing.story.md](./stories/footer-sponsor-marketing.story.md)

## Dossier sostenibilità completa

- [project-sustainability](../../../../../bmad-output/project-sustainability/README.md)
- [project-sustainability-front-office.md](../project-sustainability-front-office.md)
