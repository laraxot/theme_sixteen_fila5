---
title: "BMAD Story — s-improve-wcag-header-footer"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "bmad story   s-improve-wcag-header-footer sixteen"
---
# BMAD Story — s-improve-wcag-header-footer

- Type: epic-story
- Title: "WCAG/improvement — header/footer elements audit + fixes"
- Status: IN_PROGRESS
- References: phase-10-accessibility-audit.md (existing), css-visual-alignment.md
- Elementi da auditare e migliorare (uno per uno):

  1. **Footer** — titoli colonne (Amministrazione / Categorie di servizio / Novità / Contatti) su sfondo scuro:
     - problema: testo scuro su sfondo scuro → contrasto insufficiente (WCAG 2.1 AA Lc ≥75 body / ≥45 large-bold)
     - fix: testo bianco (#FFFFFF) o accent color, verificare con `ux_audit`
  2. **Header nav** — icone social:
     - problema: sottolineatura erronea + dimensioni icone non conformi scala modulare
     - fix: rimuovere underline, dimensione coerente (24px / 1.5rem secondo tokens)
  3. **Cambio lingua** (it/en):
     - problema: toggle non chiaro, stato attivo non visibile
     - fix: badge/lista con stato "active" chiaro (border/bold/accent)
  4. **Tasto "Accedi"** (`"Accedi all'area personale"` → /login):
     - problema: dimensione e stato :focus-visible insufficiente
     - fix: button primario con focus-visible ring, contrasto verificato
  5. **Header slim** (#0066B3) — contrasto link testuali
  6. **Skylinks** ("Vai al contenuto", "Vai al footer") — visibili al focus
  7. **Search trigger** (#0066B3, 48px) — icona size

- Output atteso: `docs/bmad/improve-wcag-header-footer.md` (audit element-per-element) + correzioni CSS + re-audit `ux_audit` + screenshot prima/dopo
- Stack: Tailwind + DaisyUI + Flowbite (NO Bootstrap)
- Second brain: kp-improve-wcag-header-footer (da registrare)
