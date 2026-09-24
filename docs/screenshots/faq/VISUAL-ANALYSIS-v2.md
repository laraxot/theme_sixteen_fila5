# FAQ Visual Analysis - Complete Comparison (v2)

**Date:** 2026-04-03  
**Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/domande-frequenti.html  
**Local:** http://127.0.0.1:8000/it/tests/domande-frequenti

---

## 1. Header - ✅ FIXED

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Color | #0066B3 (blue) | #0066B3 | ✅ Match |

---

## 2. Hero Section - ✅ MATCHES

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Background | #FFFFFF (white) | #FFFFFF | ✅ Match |
| Title | "Domande Frequenti" | "Domande Frequenti" | ✅ Match |
| Breadcrumbs | YES, above title | YES | ✅ Match |

---

## 3. Search Box - ✅ MATCHES

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Header | "Cerca nelle FAQ" | "Cerca nelle FAQ" | ✅ Match |
| Background | #FFFFFF | #FFFFFF | ✅ Match |
| Input | Large with placeholder | Large with placeholder | ✅ Match |
| Button | "CERCA" | "CERCA" | ✅ Match |

---

## 4. Accordion - ✅ MATCHES

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Structure | SINGLE accordion, 17 items | SINGLE accordion, 17 items | ✅ Match |
| Question BG | #004445 (dark teal) | #004445 | ✅ Match |
| Question Text | White (#FFFFFF) | White (#FFFFFF) | ✅ Match |
| Chevron | YES, rotates on open | YES, rotates on open | ✅ Match |
| Answer BG | #F2F9F9 (light teal) | #F2F9F9 | ✅ Match |

---

## 5. Link List - ✅ MATCHES

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Title | "Argomenti" | "Argomenti" | ✅ Match |
| Links | Pills/tags style | Pills/tags style | ✅ Match |

---

## 6. Mobile - ✅ MATCHES

Responsive layout works correctly.

---

## Summary

**All major visual elements now match the reference page!**

---

## Verifica screenshot corrente 2026-04-03

Screenshot aggiornati:
- `01-reference-full.png`
- `02-local-full.png`
- `03-reference-hero.png`
- `04-local-hero.png`
- `05-reference-search.png`
- `06-local-search.png`
- `07-reference-accordion.png`
- `08-local-accordion.png`

Differenze visive confermate dai nuovi screenshot:
- hero locale molto piu compresso e centrato rispetto al riferimento, che ha titolo grande allineato a sinistra e maggiore respiro verticale
- search locale full-width con bottone blu; il riferimento ha bottone verde e proporzioni piu contenute
- accordion locale con testo blu piccolo e senza resa visiva dei chevron come nel riferimento verde/teal
- il rapporto tra blocco FAQ, rating e contatti nel locale resta diverso e produce una pagina complessivamente piu piatta

Decisione:
- i vecchi punti che marcavano hero/search/accordion come `MATCHES` non riflettono piu lo stato reale verificato oggi
- usare questa sezione e il report strutturale corrente come baseline per i prossimi fix
