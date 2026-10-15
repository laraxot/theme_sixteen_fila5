---
id: dcp-147
title: "DCP-147: meta description delle pagine CMS: oggetto per lingua letto come JSON grezzo, descrizioni mancanti"
type: story
epic: dc-parity-v2
status: done
priority: P2
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "meta description pagina cms per lingua json grezzo Page description non traducibile PageDescription tickets.confirmation tickets.index SEO"
related: [dcp-51, dcp-104, dcp-106]
tags: [docs, sixteen, bmad]
---

# DCP-147: meta description per lingua

## Fase BMAD
Correzione (dev) di un difetto annotato in DCP-104 ("meta description JSON-raw"), con verifica.

## Difetto misurato (curl, 2026-10-13 21:40 UTC)
| Pagina | `<meta name="description">` prima |
|---|---|
| `/it/tickets/confirmation` | l'intero oggetto JSON per lingua, con `&quot;` (`{ "it": "Conferma di invio...", "en": ... }`) |
| `/it/tickets` | "FixCity" (il JSON non aveva `description`) |
| `/it/tickets/track`, `/it/auth/login` | "FixCity" (pagine speciali senza JSON di descrizione) |
Perche' conta: e' il testo che i motori di ricerca e le anteprime dei social mostrano; un JSON grezzo e un nome generico non dicono al cittadino cosa trova nella pagina. Causa: `Page::description` non e' una colonna traducibile; nel JSON puo' essere un oggetto per lingua e il modello lo restituisce come testo. La home lo leggeva con una logica propria (DCP-51), le due pagine catch-all passavano l'attributo grezzo.

## Correzione
- Nuova funzione pura `Themes\Sixteen\Support\PageDescription::resolve(mixed $raw, string $locale): string` (lingua corrente, poi italiano, poi la prima voce non vuota; una stringa semplice resta com'e'; JSON non valido resta com'e').
- Usata nei tre punti: `pages/index.blade.php` (home, al posto della logica duplicata), `pages/[container0]/index.blade.php`, `pages/[container0]/[slug0]/index.blade.php`.
- `tickets.index.json` ha ora `description` in it/en/de/es nelle tre copie identiche (`config/local`, `config/eu`, `Modules/Fixcity/config`; un solo md5). Testi senza emoji ne' trattini lunghi.

## Prove
- curl dopo `view:clear`: `/it` e `/it/tickets/confirmation` con la descrizione corretta (non piu' JSON); `/{it,en,de,es}/tickets` con la descrizione nella lingua giusta.
- Pest `Modules/Fixcity/tests/Unit/PageDescriptionTest.php`: 4 verdi, 14 asserzioni (lingua corrente, ripiego su italiano e prima voce, stringa semplice, valori assenti, JSON non valido; `tickets.index` non vuota nelle 4 lingue). PHPStan (config unica) a zero su classe e test.
- Sentinelle `/it`, `/it/tickets`, `/it/tests/homepage`, `/it/tickets/confirmation`, `/it/tests/permessi-area-personale` a 200.
- Backup delle versioni precedenti: `scratchpad/dcp130-backup/`.

## Non coperto
- Le pagine speciali `tickets/track` e `auth/login` (rami Blade senza JSON) e le pagine `tests/*` restano con la descrizione generica "FixCity": per le pagine di prova e' voluto (parity con il riferimento); per login e traccia serve una chiave lingua dedicata, da aprire.
- `[container0]/index.blade.php` contiene ancora `__('pub_theme::segnalazione.elenco.subtitle', ['count' => 73])` per la pagina nativa `segnalazioni`: il numero 73 e' scritto nel codice e non e' un conteggio reale. Non l'ho cambiato (la pagina nativa `segnalazioni` e' fuori dal flusso attuale: `/it/tickets` e' la pagina CMS); da verificare se e' ancora raggiungibile e, se si', calcolare il conteggio o togliere il numero.
