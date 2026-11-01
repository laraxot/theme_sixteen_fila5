---
id: dcp-133
title: "DCP-133: identita' dell'ente e recapiti reali al posto dei segnaposto"
type: story
epic: dc-parity-v2
status: needs-data
priority: P0
owner: theme:Sixteen + tenant
created: 2026-10-13
updated: 2026-10-13
qmd: "nome del comune segnaposto numero verde urp config comune.php footer header regione titolare trattamento"
related: [dcp-112, dcp-130, dcp-131]
tags: [docs, sixteen, bmad]
---

# DCP-133: il sito dice chi e' l'ente

Nata da DCP-112 (matrice normativa N-03, N-05, N-30; matrice interfaccia I-15).

## Lacuna e prova (2026-10-13)
Nell'HTML di `/it` (curl) compaiono i dati d'esempio del riferimento Design Comuni: «Nome del Comune», «Nome della Regione» (header slim, link 120x21 px), «Via Roma 123 - 00100 Comune», «Numero verde: 800 016 123», «SMS e WhatsApp: +39 320 1234567», «Centralino unico: 012 3456», link social a `https://twitter.com`, `https://facebook.com`, `https://youtube.com`. `laravel/config/comune.php` ha i valori di esempio (`Nome Comune`, `info@comune.it`, `comune@pec.it`, `00000000000`). Le fonti del footer sono `config/local/fixcity/database/content/sections/footer.json` e la copia del modulo.

## Norma
GDPR art. 13 par. 1 lett. a): identita' e dati di contatto del titolare (registro fonti 02). L. 7.6.2000 n. 150 art. 8 (URP) e CAD art. 53 e 54: riferimenti nel registro fonti 03; l'applicabilita' al singolo Comune e' una valutazione dell'ente.

## Requisiti
1. Una sola fonte per i dati dell'ente (tenant): nome, indirizzo, URP, PEC, telefono, orari, social reali; header, footer, informativa e dichiarazione di accessibilita' la leggono.
2. Nessun segnaposto in produzione: guardia che fallisce (test e controllo di salute) se `APP_ENV=production` e restano i valori d'esempio.
3. I social non configurati non vengono mostrati (non linkare le home generiche).

## Criteri di accettazione
- [ ] `curl -s http://.../it | grep -cE 'Nome del Comune|Nome della Regione|Via Roma 123|800 016 123|320 1234567'` = 0 con i dati del tenant impostati.
- [ ] Test Pest: con `APP_ENV=production` e dati d'esempio la guardia fallisce con messaggio che elenca i campi.
- [ ] Il testo di DCP-130 usa gli stessi dati (titolare, DPO).

## Dipendenze e priorita'
Servono i dati dal Comune (status `needs-data`). P0 per la produzione.
