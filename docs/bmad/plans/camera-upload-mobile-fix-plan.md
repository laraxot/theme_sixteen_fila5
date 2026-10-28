---
title: "Camera upload mobile fix — BMAD plan"
type: plan
status: superseded
updated: 2026-10-27
tags: [media, camera, mobile, heic, fixcity, second-brain, bmad, filament-blueprint]
qmd: "camera upload mobile heic fixcity bmad"
related:
  - ../docs/bmad/completion.md
  - ../docs/bmad/auth-login-architettura.md
issue: "https://github.com/laraxot/base_fixcity_fila5/issues/HEIC-MOBILE-UPLOAD"
---

# Camera Upload Mobile Fix — BMAD Plan

> Superseded: la pianificazione operativa è ora nella story owner
> [FIXCITY-MEDIA-001](../../../../Modules/Fixcity/docs/bmad/stories/mobile-camera-upload.story.md).
> Questo documento resta come ricerca storica; non aggiungere qui claim,
> handoff o stato.

## Intent

Risolvere l'errore "Caricamento non riuscito, riprova" quando si carica una foto dalla fotocamera su mobile (iOS Safari / Android). Radice: `normalizeCameraImage()` in `dc-file-upload.blade.php` ritorna `null` quando il browser non può decodificare HEIC/HEIF (canvas decode fallisce su iOS) o quando `FixcityCameraUpload.toJpeg` non è disponibile / fallisce, così il componente mostra l'errore generico invece di provare a inviare il file al server.

## Evidence / Research (studia a fondo — link forniti dall'utente)

| Fonte | Cosa insegna per questo fix |
|---|---|
| Filament Discussion #11974 | Mobile camera uploads falliscono spesso per formato HEIC e dimensioni; soluzione = conversione lato client + validazione lato server |
| `filament-take-picture-field` (emmanpbarrameda) | Plugin dedicato per cattura foto camera in Filament; usa `accept="image/*"`, `capture="environment"`, conversione lato client; pattern da replicare per UX affidabile |
| `SpykApp/uppy-upload-plugin` | Upload resumabile con supporto camera; utile come riferimento per gestione errori e progressi, ma non serve sostituire il componente attuale |
| Medium — "Efficient image conversion" | Pattern: `Spatie\Image\Image` o `Intervention\Image` per conversione server-side come backup quando il client fallisce |
| Medium — "Custom file uploads" | `SpatieMediaLibraryFileUpload` resta il componente Filament; il client solo prepara il file; il server valida / converte tramite `MediaConvert` o `ConvertAction` |

> 🧠 **From Second Brain (Hindsight)** — Il componente `dc-file-upload.blade.php` usa già `SpatieMediaLibraryFileUpload`; il server accetta solo `image/jpeg`, `image/png`, `application/pdf`; il picker client accetta anche `image/heic`, `image/heif` per conversione. Il problema è che quando la conversione fallisce, il file non viene mai inviato (ritorno `null`).

## Root Cause (verificato sul codice)

- **File**: `laravel/Modules/Fixcity/resources/views/filament/forms/components/dc-file-upload.blade.php` (linee 80-117)
- `normalizeCameraImage()` prova `FixcityCameraUpload.toJpeg()` (WASM) poi canvas fallback
- Se entrambi falliscono (iOS non decodifica HEIC nel canvas) → `return null`
- `pick()` (linea 126) vede `!file` → `message = texts.upload` → error generico
- **Nessun controller creato** — regola architetturale rispettata (solo Blade/JS + Media module actions)

## Plan (serial — BMAD / Blueprint)

### Step 1 — Documentazione BMAD (prima dell'implementazione, come richiesto)
- [x] Creare `docs/bmad/plans/camera-upload-mobile-fix-plan.md` (questo file)
- [x] Creare `docs/bmad/stories/camera-upload-mobile-fix.story.md` (story da implementare)
- [x] Aggiornare pagina iniziativa Hindsight (`kp-5d90af548cc74d0dbf0743d56219e040`)

### Step 2 — Traduzioni (multilingua — regola assoluta, mai hardcoded)
- [ ] Aggiungere `error_camera` a `taravel/Modules/Fixcity/lang/it/ticket_form.php`
- [ ] Propagare in tutte le lingue (en, de, es, fr, gl, fi, sv, el, kk, pt, pl, eu, ca, ro, uk, ru, nl, da, no, sk, sl, bg, cs, hr, sq, mk, hy, az, be, ga, gd, is, ka, lt, lv, et, fi, sv, nb, nn)
- [ ] Verificare: nessuna frase in italiano nel codice JS/Blade (usa solo `texts.*` tramite `@js()`)

### Step 3 — Fix client-side (Ponytail — minimale, sicuro)
- [ ] Modificare `normalizeCameraImage()` (line 102, 113): `return null` → `return file` (fallback a file originale; server valida / rifiuta con messaggio corretto)
- [ ] Rimuovere controllo ridondante `if (!file)` in `pick()` (opzionale ma pulito)
- [ ] Aggiungere `init()` per preload converter (opzionale, non bloccante)

### Step 4 — Server-side conversion (Media module — come richiesto dall'utente)
- [ ] Verificare `Modules/Media/app/Actions/ConvertData.php` — esiste conversione immagine?
- [ ] Se non presente conversione HEIC → JPEG, aggiungere azione o configurare `ConvertAction` per usare `Intervention\Image` o `Spatie\Image`
- [ ] Verificare `TemporaryUpload` — il file caricato temporaneamente può essere convertito prima dell'attach

### Step 5 — Test, verifica, coordinamento agenti AI
- [ ] Discutere con gli agenti AI e registrare il risultato nella story BMAD collegata (coordinamento multi-agente per task condiviso su Media + Fixcity)
- [ ] Eseguire `php -l` sui file modificati
- [ ] Eseguire `vendor/bin/pest Themes/Sixteen/tests/Unit/` o test del componente
- [ ] Verifica manuale su mobile con HEIC (simulato con file `.heic`); confermare che il server restituisce `error_type` (formato non consentito) invece di `error_upload` generico

### Exit criteria
- [ ] Nessun errore generico "Caricamento non riuscito" per foto HEIC (il server mostra il messaggio corretto `error_type` o `error_camera`)
- [ ] Il file viene inviato anche se conversione fallisce (il server valida)
- [ ] Nessuna stringa hardcoded in italiano (solo chiavi traduzione)
- [ ] Nessun controller creato; zero Bootstrap CS; solo Blade/JS + Media actions

## Technical Decisions (registrati per Second Brain)

1. **Non sostituire il componente con Uppy** — troppo invasivo; il componente `dc-file-upload` è già integrato con `SpatieMediaLibraryFileUpload` e Livewire; sostituire significherebbe rifare il wizard
2. **Non aggiungere plugin `filament-take-picture-field`** — richiederebbe dipendenza esterna e nuovo componente Filament; il fix è solo nel componente esistente
3. **Server-side conversion come backup, non sostituto** — il client deve provare a convertire (per UX); se fallisce, il server deve rifiutare con messaggio chiaro, non con errore generico
4. **Ponytail: solo 2 righe di JS + 1 chiave traduzione** — il cambiamento più piccolo che risolve il problema: `return file` al posto di `return null`
5. **Multilingua: chiave `error_camera`** — dà all'utente un messaggio specifico ("Formato foto non supportato") invece di generico

## Related (per coordinamento multi-agente)
- `Modules/Fixcity` — componente `dc-file-upload.blade.php` (owner del fix client-side)
- `Modules/Media` — conversione server-side (owner del backup conversione)
- `Themes/Sixteen` — bundle JS (`theme-components`) che include `FixcityCameraUpload`
- `../stories/camera-upload-mobile-fix.story.md` — claim, coordinamento, decisioni, handoff e verifiche per gli agenti che lavorano sullo stesso wizard (`segnalazione-02-dati`)
