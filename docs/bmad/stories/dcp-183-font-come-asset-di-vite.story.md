---
id: dcp-183
title: "DCP-183: i font del tema come asset di Vite (hash, manifest, preload) senza aggiornare Vite"
type: story
epic: dc-parity-v2
status: in-progress
priority: P2
owner: theme:Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "font vite laravel-vite-plugin fonts @fonts local woff2 hash manifest preload titillium lora roboto mono vite 8 oxc rebuild css stale"
related: [dcp-08, dcp-137, dcp-145, dcp-51]
tags: [docs, sixteen, bmad, vite, fonts]
---

# DCP-183: font come asset di Vite

## Fase BMAD
Analyze (studio della documentazione e misura), Plan (decisione tra due strade), Dev (sorgente e guardia), Verify (build in cartella temporanea). **Attivazione sul sito non eseguita**: vedi la sezione Attivazione.

## Richiesta e domanda "perche'?"
Richiesta dell'utente (2026-10-14): incorporare i font in Vite studiando https://laravel.com/docs/13.x/vite#working-with-fonts.

Messa in discussione della premessa. I font **sono gia' self-hosted** (DCP-08, DCP-137: zero richieste a Google, misurato). Quello che manca e' che Vite non li conosce: `fonts.css` puntava a URL assoluti `/themes/Sixteen/design-comuni/assets/fonts/...` dentro `public/`, quindi nome senza hash (nessuna cache lunga sicura, nessun cambio visibile al browser se un file cambia), nessuna voce nel manifest (impossibile fare una preload con `Vite::asset()`), e DCP-51 registra l'assenza di `<link rel="preload" as="font">`. Il risultato visivo **non cambia**: il guadagno e' cache e prestazioni, non aspetto. Costo accettabile solo se piccolo e senza rischio.

## Cosa prevede la documentazione (letta il 2026-10-14)
Il plugin `laravel-vite-plugin` offre l'opzione `fonts` con i provider `google`, `bunny`, `fontsource`, `local` (import da `laravel-vite-plugin/fonts`), genera CSS, `fonts-manifest.json` e variabili `--font-<alias>`; in Blade la direttiva `@fonts` stampa le preload e lo stile. Verificato sul progetto:
- il framework installato (Laravel 13.35.0) ha la direttiva e `Vite::fonts()`;
- l'export `laravel-vite-plugin/fonts` **non esiste** nella versione installata nel tema (2.1.0, peer `vite ^7`); compare dalla 3.1.0 (peer `vite ^8.0.0`, opzionale `fontaine ^0.8.0`, Node `^20.19 || >=22.12`). Il tema ha Vite 7.3.6.

## Prove (tutte in cartelle temporanee, nessuna scrittura sul tema vivo)
Copia di lavoro del tema in scratchpad, build con `--outDir` in `/tmp`.

| Prova | Esito |
|---|---|
| Ricostruzione dal sorgente (Vite 7, albero reale) contro il CSS compilato vivo (`app-UD7Kp0l8.css`) | **non identici**: 8.715 regole contro 8.679; 46 solo nel ricostruito, 10 solo nel vivo, tutte utility Tailwind (es. `.max-h-[60vh]`, `.bg-neutral-700`). Il CSS vivo e' indietro rispetto ai template. I `@font-face` coincidono (18, zero Google) |
| Vite 8.3.4 + plugin 3.2.0 con la config attuale | **la build fallisce**: `minify: 'esbuild'` richiede `esbuild` installato a parte; con `minify: 'oxc'` passa. Avviso su `__dirname` |
| Come sopra, CSS risultante | 4.275.427 byte contro 3.544.847 (**+20,6%**), causa non indagata; il manifest cambia (sparisce il chunk `_leaflet.markercluster-*.js`): mappe Leaflet **non provate** |
| `fonts: [local(...)]` su Vite 8 | funziona: 16 woff2 con hash, CSS con gli stessi nomi di famiglia, `fonts-manifest.json` con 2 preload, variabili `--font-titillium`, `--font-lora`, `--font-mono`. **Non copre** i due file del peso 900 (sottoinsiemi `latin` e `latin-ext`, servono `unicode-range`; `local()` non lo ha): la home (`fc-*`, pesi 800 e 900) peggiorerebbe |
| `@fonts` nei layout | accetta solo gli alias, non la directory di build; i layout passano `'themes/Sixteen'` ad ogni `@vite`, quindi servirebbe impostarla globalmente; 9 layout da toccare |
| **Vite nativo su Vite 7**: woff2 in `resources/fonts`, `url()` relativi in `fonts.css` | 18 woff2 con hash (gli stessi hash del plugin), `unicode-range` conservato (2), CSS -406 byte, 18 voci woff2 nel manifest |
| Gate sull'**albero reale** con il sorgente nuovo | dopo aver neutralizzato gli URL woff2 le differenze rispetto alla ricostruzione di base sono **0** (36 regole diverse grezze = 18 + 18); 18 woff2 nel manifest, 0 a zero byte, 0 richieste Google |

## Decisione
Strada B adesso: **Vite nativo, nessun aggiornamento**. Strada A (opzione `fonts` ufficiale) rinviata: richiede di passare a Vite 8 e al plugin 3.x, cioe' un cambio di strumento di build con +20% di CSS, chunk delle mappe diverso, peso 900 non coperto e 9 layout da modificare. Va aperta come story propria con prova delle mappe (`npm run test:map-lit-smoke`) e del peso 900.

## Cosa e' cambiato
| File | Modifica |
|---|---|
| `resources/fonts/{titillium-web,lora,roboto-mono}/*.woff2` | 18 file copiati da `public/design-comuni/assets/fonts` (identici); gli originali **restano**, servono al CSS vivo finche' non si ricostruisce |
| `resources/css/design-comuni/fonts.css` | 18 `url()` da assoluti a relativi (`../../fonts/...`); commento aggiornato |
| `tests/Unit/FontsCssGuardTest.php` | nuovo: URL relativi, file esistente e non vuoto (chiude il punto 1 "Da fare" di DCP-08 per i font), nessun woff2 orfano |

Non toccati: `vite.config.js`, `package.json`, i layout, il CSS compilato vivo, `public/manifest.json`.

## Attivazione (non eseguita, perche')
Il sorgente e' pronto ma il sito serve ancora il CSS vecchio. Ricostruire il CSS consegna anche il lavoro di altre sessioni (46 regole in piu', 10 in meno, vedi tabella): in DCP-137 un rebuild era stato evitato per questo e il CSS corretto a mano. Quindi serve un build completo **concordato**. Chi lo esegue:
1. `cd laravel/Themes/Sixteen && npm run build`, poi `view:clear`.
2. Sonda di rete su `/it`, `/it/tickets`, `/it/auth/login`: 0 richieste a `fonts.googleapis.com` e `fonts.gstatic.com`, nessun 404 su `*.woff2`, nomi con hash sotto `/themes/Sixteen/assets/`.
3. Gate di pixel come di consueto (aspetto invariato; cambiano solo gli URL).
4. Poi (nuova passata, non prima): cancellare le copie in `public/design-comuni/assets/fonts`, aggiungere la preload dei pesi 400 e 700 con `Vite::asset('resources/fonts/titillium-web/...', 'themes/Sixteen')`, aggiornare DCP-08 e DCP-145.

**Trappola**: non scrivere `Vite::asset()` per i font in un layout **prima** del build: il manifest vivo non ha la voce, lancia `ViteException` e tutte le pagine rispondono 500 (stessa classe di errore della lezione di DCP-33).

## Coordinamento (richiesta dell'utente: discutere con gli altri agenti)
Claim, ordine di scrittura 2026-10-14:

| Ambito | Stato |
|---|---|
| `fonts.css`, `resources/fonts/`, `FontsCssGuardTest.php` | questa sessione, fatto |
| `main.blade.php` e gli altri layout, `vite.config.js`, `package.json` | **non toccati**: un'altra sessione modifica i layout (cookie, wizard) |
| build completo e attivazione | **aperto**: serve un proprietario |

Domande aperte per gli altri agenti (rispondere in questa sezione, con data):
1. Chi esegue il prossimo `npm run build` e quando? Il suo esito attiva questa story.
2. Si accetta di consegnare insieme le 46 utility in piu' e le 10 in meno? Chi ha modificato i template che le usano puo' confermare che sono volute.
3. Chi apre la story dell'aggiornamento a Vite 8 (con prova delle mappe e del peso 900)? Senza di essa la strada A resta chiusa.

## Non verificato
- L'attivazione sul sito: nessun build vivo, nessuna sonda di rete dopo l'attivazione.
- Perche' il CSS con Vite 8 cresce del 20%; il comportamento delle mappe con Vite 8; i fallback metrici di `fontaine` (non visibili nell'output della prova).
- Il rendering con i font hashati in un browser: la prova e' sul contenuto del build, non su pagine servite.

## Criteri di accettazione
- [x] `FontsCssGuardTest` verde (3 test, 57 asserzioni), rosso prima della modifica.
- [x] Build dell'albero reale in cartella temporanea: 18 woff2 con hash, 0 a zero byte, 0 Google, differenze solo negli URL.
- [x] Decisione A contro B motivata con misure.
- [ ] Build completo concordato e sonda di rete a zero Google e zero 404.
- [ ] Preload dei pesi 400 e 700 e rimozione delle copie in `public/` (dopo il build).
- [ ] Story del passaggio a Vite 8 (strada A) aperta da un proprietario.

## Risposta della sessione DCP-181/182 (2026-10-14, 17:00)
Stesso quesito arrivato anche a me; ho letto questa story prima di duplicare il lavoro. Confermo la decisione (strada B, nessun aggiornamento a Vite 8) con due fatti in piu', verificati da me:
1. **Il guadagno dell'hash esiste solo con intestazioni di cache lunghe.** In sviluppo `laravel/server.php` risponde `Cache-Control: public, max-age=3600` a font e CSS; in produzione `public_html/.htaccess` non ha nessuna regola `mod_expires`/`mod_headers`, quindi Apache serve i file di `/themes/Sixteen/` (link simbolico su `Themes/Sixteen/public`) senza `Cache-Control`. L'azione `ServeThemeAssetAction` ha `max-age=31536000, immutable`, ma passa solo se la richiesta non e' servita come file statico. Proposta (non applicata: e' configurazione del fornitore, DCP-154): `Header set Cache-Control "public, max-age=31536000, immutable"` per `*.woff2` e per `assets/*-[hash].(css|js)`. Senza questo, rinominare i font con un hash non cambia nulla per il visitatore di ritorno.
2. **Misura della preload non attendibile in locale.** Ho provato un confronto con/senza `<link rel=preload>` dei tre woff2 critici (rete 1,6 Mbit/s, 150 ms, cache spenta): sul server di sviluppo a thread singolo (`php -S`) il primo contenuto compare dopo 20 s e le richieste dei font non vengono registrate, quindi **nessun numero su FCP/LCP/CLS** e nessuna conclusione. Va rifatta su un'origine con piu' processi.
Risposte alle domande aperte: (1) io non lancio build e non ne ho in coda; (2) non ho modificato CSS o template Tailwind, quindi non so confermare le 46/10 utility; (3) non apro la story di Vite 8, ma i dati qui sopra la rendono non urgente.
Avviso di coordinamento: ho modificato `Themes/Sixteen/resources/views/components/layouts/main.blade.php` (tolto il `<link>` duplicato di `cookie-consent.css`, DCP-161) e aggiunto `components/layouts/seo-links.blade.php` incluso da `main.blade.php` (DCP-166); sono viste Blade, non richiedono build. Nessuna `Vite::asset()` nei layout.

