---
title: "Header/footer JSON data model"
type: architecture
tags: [bmad, json, sections, header, footer, design-comuni, wcag]
qmd: "Sixteen header footer JSON brand navigation contact social data model"
status: draft
updated: 2026-10-11
---

# Modello dati delle sections

## Ownership

Il tema Sixteen possiede markup, responsive behavior, accessibilità e stile.
Il tenant `fixcity` possiede contenuti, URL, identità e ordine dei link. La
separazione consente di cambiare comune senza copiare Blade e impedisce che
un blocco di un modulo diventi una replica del tema Design Comuni.

## Header

| Elemento visuale | Chiave | Forma | Comportamento |
|---|---|---|---|
| fascia istituzionale | `region` | `{name,url}` | link localizzato, opzionale |
| identità | `brand.name` | stringa o mappa locale | titolo sempre visibile |
| slogan | `brand.tagline` | stringa o mappa locale | secondario da tablet in su |
| stemma/logo | `brand.logo` | asset relativo public | link alla home, alt decorativo |
| link utilità | `utility_links[]` | `{label,url}` | top bar, nascosti su mobile stretto |
| cambio lingua | runtime | locale Laravel | menu Alpine con `aria-expanded` |
| area personale | `account` | `{label,url}` | CTA sempre reale |
| menu principale | `navigation[]` | `{label,url}` | lista semantica + `aria-current` |
| ricerca/menu mobile | runtime | Alpine | target minimo 44px, focus visibile |

## Footer

| Elemento visuale | Chiave | Forma | Comportamento |
|---|---|---|---|
| identità | `brand` | `{name,description,logo}` | link home |
| gruppi | `columns[]` | `{title,links[]}` | heading + `ul` |
| contatti | `contact` oppure colonna | dati opzionali | `address`, `mailto`, `tel` |
| canali social | `social[]` | `{label,url}` | esterni sicuri; voci vuote escluse |
| link legali | `legal_links[]` | `{label,url}` | riga conclusiva localizzata |
| copyright | `copyright` | stringa o mappa locale | fallback solo senza blocco |

## Regole di rendering

1. `Section` risolve locale e blocchi prima del renderer.
2. `v1` conserva `blocks`; i props diretti sono solo compatibilità/fallback.
3. Il primo blocco fornisce `data`; chiavi assenti non attivano contenuto
   inventato quando esiste un blocco configurato.
4. I path interni passano da LaravelLocalization; gli esterni non vengono
   alterati.
5. Nessun link applicativo usa `href="#"`; una voce senza URL è omessa.
6. Il renderer usa Tailwind + Alpine; nessun CSS/CDN Bootstrap Italia.

## Acceptance criteria BMAD

- [ ] `<x-section slug="header" />` mostra i valori del JSON locale.
- [ ] `<x-section slug="footer" tpl="full" />` mostra colonne, social e legali.
- [ ] rendering diretto `v1` conserva i test di fallback FixCity.
- [ ] 375/768/1440 px senza overflow o errori console.
- [ ] focus, contrasto e semantica rispettano il contratto WCAG AA.
