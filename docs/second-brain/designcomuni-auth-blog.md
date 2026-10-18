---
type: second-brain-initiative
tags: [design-comuni, auth, register, second-brain, bmad, eec, filament-blueprint]
status: open
created: 2026-10-17
updated: 2026-10-17
initiative_id: kp-designcomuni-auth-blog
---
# Second Brain: DesignComuni Auth + Blog/Eventi

## Regole estratte da design-comuni-pagine-statiche
- Header con slim-wrapper (logo regione + accesso area personale + ricerca)
- Navbar con collapsible, megamenu, link: Amministrazione, Novità, Servizi, Vivere il Comune
- Card per contenuto, ombra, bordi, bordi arrotondati
- Badge stato per stati (risolto, scartato, delegato, non risolto)
- Footer con link servizi correlati, contatti, dichiarazione accessibilità, conformità WCAG 2.1 AA
- Pagine: argomenti, argomento, lista-risorse, lista-risorse-categorie, novità, novità-dettaglio, eventi, evento-dettaglio

## Pattern da applicare su FixCity
- Register: card gradient header + form + footer accessibilità + link login/recovery + link registrazione + CTA bottom
- Login: card gradient header + form widget Filament + footer accessibilità + link registrazione/recovery + CTA SPID/CIE
- Blog/Eventi: grid card con immagine, titolo, descrizione breve, badge stato/data, link a pagine correlate, footer standard

## Decisioni EEC (Every Exception Counts)
- Ogni pagina auth deve avere il footer di accessibilità (WCAG 2.1 AA) per rispettare il principio BMAD (ogni eccezione conta)
- Le pagine di blog ed eventi devono seguire la stessa struttura card delle pagine DesignComuni per garantire consistenza
- Nessun documento deve restare in `bmad-output/`; ogni memoria va nel modulo owner (Fixcity, User) o nel theme docs

## Integrazione con BMAD
Doc: `laravel/Modules/Comment/docs/bmad/designcomuni-auth-blog.md`
