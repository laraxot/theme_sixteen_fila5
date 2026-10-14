---
type: bug
slug: wizard-callSchemaComponentMethod-bug
status: risolto e verificato (2026-10-13)
filosofia: il wizard è un atto di responsabilità; se lo schema non funziona, l'atto non può iniziare — ma il problema è tecnico (metodo pubblico), non filosofico
scopo: documentare il bug `MethodNotFoundException callSchemaComponentMethod` (Livewire/Volt) sul wizard `form.dati-di-segnalazione::data::wizard-step`
funzionalita: componente wizard `segnalazione-crea.blade.php` centrato + geo inclusa + aria-live; ma il metodo schema non visibile impedisce il rendering dello step
norme: accessibilità (aria-live polite aggiunto); privato (auth [web,auth]); multilingua; mobile
root-cause: la view Geo invocava `callSchemaComponentMethod` per il reverse geocoding anche quando il wrapper Livewire non era il dispatcher Filament atteso; inoltre gli asset Geo pubblicati erano obsoleti
azione-applicata: il reverse geocoding del componente Lit resta client-side e la view non esegue piu' RPC schema; asset Geo rigenerati; CSS Filament corretto; middleware [web,auth]; no coordinate fisse
verifica: autenticazione Playwright su HTTP, apertura dello step, click sulla mappa e reverse geocoding riusciti; 2 POST Livewire 200, nessun errore console, stato coordinate e marker aggiornati
loop: CHIUSO (2026-10-13)
title: "Bug — Wizard Schema Component Method (Livewire/Volt)"
updated: 2026-10-14
tags: [docs, sixteen, bmad]
qmd: "bug   wizard schema component method (livewire/volt) sixteen"
---
# Bug — Wizard Schema Component Method (Livewire/Volt)

Errore: `MethodNotFoundException: callSchemaComponentMethod` su `/it/tickets/create?step=form.dati-di-segnalazione::data::wizard-step`.
Root cause: il wrapper Geo invocava un RPC schema Filament (`callSchemaComponentMethod`) per un'operazione gia' svolta dal componente Lit. In alcune composizioni Volt l'RPC arrivava al componente sbagliato.
Correzione: reverse geocoding client-side unico nel Lit map component; rimosso l'RPC duplicato dalle viste coordinate-picker/map-picker/geopoint-picker. Rigenerati gli asset Geo e registrato il CSS emesso da Vite.
Verifica: HTTP autenticato, `coordinate-picker-lit` presente, click mappa aggiorna latitudine/longitudine/indirizzo e marker; nessuna risposta Livewire >= 400 e nessun errore console.
Loop: CHIUSO — resta solo il limite del browser: la geolocalizzazione automatica puo' essere negata su HTTP, mentre selezione manuale e ricerca restano sempre disponibili.
