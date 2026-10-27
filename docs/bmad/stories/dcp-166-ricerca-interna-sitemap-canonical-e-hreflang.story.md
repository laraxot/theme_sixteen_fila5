---
id: dcp-166
title: "DCP-166: ricerca interna funzionante, sitemap.xml, canonical e hreflang"
type: story
epic: dc-parity-v2
status: in-progress
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "ricerca interna cerca nel sito autocomplete sitemap xml canonical hreflang meta description seo linee guida design 4.3.9 motori di ricerca"
related: [dcp-163, dcp-147, 8.3, 8.4]
tags: [docs, sixteen, bmad]
---

# DCP-166: ricerca interna funzionante, sitemap.xml, canonical e hreflang

## Lacuna e prova (2026-10-14)
Requisito 4.3.9 (Linee guida di design della PA, capitolo 4 «Requisiti» (versione corrente, letto il 2026-10-14)): contenuti trovabili da motori esterni e interni. Misure (`lg-design-scan.py`): `sitemap.xml` 404; `canonical` assente in 48 su 48 combinazioni; `hreflang` assente in 48 su 48; meta description assente in 8 su 48 (accesso e registrazione); `robots.txt` presente. Ricerca interna: il campo «Cerca nel sito» ha `data-bs-autocomplete="[]"` (nessun dato) e `/it/search`, `/it/ricerca` rispondono 404: il campo non cerca nulla.

## Norma
Linee guida di design 4.3.9 (DEVE). SEO: nessuna norma, buone pratiche del capitolo «Content design» delle linee guida.

## Requisiti
1. `sitemap.xml` con le pagine pubbliche in tutte le lingue, indicata in `robots.txt`; escluse le pagine di prova gia' vietate.
2. `<link rel="canonical">` e `<link rel="alternate" hreflang>` con le 4 lingue + `x-default` su ogni pagina pubblica (nel layout, non pagina per pagina).
3. Meta description anche sulle pagine di accesso e registrazione, in 4 lingue.
4. Ricerca interna: o la si collega a un risultato reale (almeno segnalazioni pubbliche e pagine del sito) o si toglie il campo finche' non c'e'. Un campo che non funziona e' un difetto di usabilita' e di accessibilita'.

## Criteri di accettazione
- [ ] `curl /sitemap.xml` 200, valida, con le URL delle 4 lingue; `robots.txt` la cita.
- [ ] `lg-design-scan.py`: «senza canonical» 0/48, «senza hreflang» 0/48, «senza meta description» 0/48.
- [ ] Nel campo di ricerca una query reale (per esempio una parola del titolo di una segnalazione pubblica) restituisce almeno un risultato, oppure il campo non c'e'; axe senza violazioni.
- [ ] Test Pest sulla presenza di canonical e hreflang con prefisso di lingua corretto.

## Dipendenze e priorita'
Collegata a 8.3 (IA) e 8.4 (contenuti e SEO), che chiedono canonical e titoli ma non la sitemap ne' la ricerca. P1.

## Stato al 2026-10-14 (verificato)
- **canonical e hreflang**: `Themes/Sixteen/resources/views/components/layouts/seo-links.blade.php`, incluso da `main.blade.php` (tutti i layout passano da li). Gli indirizzi si costruiscono dal percorso della richiesta con la lingua sostituita; il canonical non porta mai la query (`?code=` del tracciamento). Scartato `LaravelLocalization::getLocalizedURL()`: dipende da una richiesta memorizzata nel singleton e nei test restituiva `/en` al posto di `/en/privacy`.
- **sitemap.xml**: rotta `/sitemap.xml` (`laravel/routes/web.php`, classe invocabile `Modules\Seo\Actions\Sitemap\BuildSitemapAction`). 10 pagine per 4 lingue = 40 URL, tutte 200; esclude le pagine di prova, quelle dietro `auth`, la conferma con `?code` e lo schema di dettaglio. Niente `lastmod` (manca una data affidabile: DCP-167).
- **meta description e titolo** di accesso e registrazione: erano in italiano in tutte le lingue (il titolo «Accedi a FixCity» e l'intestazione comparivano in italiano anche in en, de, es). Chiavi `fixcity::auth.*` nelle 4 lingue.
- Misura con `lg-design-scan.py` / `go-live-gate.py`: senza canonical 48/48 -> 0/48, senza hreflang 48/48 -> 0/48, senza meta description 8/48 -> 0/48, `sitemap.xml` 404 -> 200.
- Test: `Modules/Fixcity/tests/Feature/Pages/SeoLinksTest.php` (canonical e hreflang in 4 lingue, nessun codice di tracciamento, sitemap valida e senza pagine private).
- **Non fatto**: riga `Sitemap:` in `public_html/robots.txt` (file statico condiviso dai domini: l'URL assoluto si scrive quando il dominio e' deciso, DCP-155); ricerca interna (il campo con `data-bs-autocomplete="[]"` resta senza risultati, `/it/search` risponde 404): serve la scelta tra collegarlo a un risultato reale o toglierlo.

