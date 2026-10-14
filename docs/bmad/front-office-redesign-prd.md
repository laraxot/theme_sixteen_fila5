---
title: "PRD — Front Office Redesign DesignComuni"
type: prd
tags: [design-comuni, front-office, requirements, wcag-21-AA]
links:
  story: "docs/stories/front-office-complete-redesign.story.md"
  investigation: "docs/investigation/front-office-redesign-planning.md"
  tech_spec: "docs/bmad/front-office-redesign-tech-spec.md"
  decision_log: "docs/decision-log.md"
  design_ref: "https://italia.github.io/design-comuni-pagine-statiche/index.html"
status: draft
updated: 2026-10-11
qmd: "product requirements document (prd)   front office redesign designcomuni v2.4.0 sixteen"
---

# Product Requirements Document (PRD) — Front Office Redesign DesignComuni v2.4.0

## 1. Obiettivo del progetto
Ridisegnare tutte le pagine front office del tema Sixteen secondo il modello `design-comuni-pagine-statiche` v2.4.0, garantendo:
- Conformità WCAG 2.1 AA
- Zero utilizzo di CDN Bootstrap Italia (solo Tailwind `@apply` e asset locali)
- Header e footer istituzionali DesignComuni
- Mappa interattiva con marker visibili e accessibili
- Flusso di creazione segnalazione in 4 step (privacy, dati, riepilogo, conferma)
- Symlink per il deployment degli asset: `public_html/themes/Sixteen → laravel/Themes/Sixteen/public`

## 2. Stakeholder
- **Product Owner**: Responsabile del progetto Fixcity
- **UX/UI Designer**: Responsabile della conformità a DesignComuni e WCAG
- **Frontend Developer**: Implementazione di Tailwind, AlpineJS, Lit, Blade
- **Backend Developer**: Validazione del flusso ticket e gestione owner_id
- **QA Engineer**: Test di accessibilità e regressione
- **DevOps**: Gestione symlink e deployment asset

## 3. Requisiti funzionali

### 3.1 Layout e struttura
- [ ] Header istituzionale (`it-header-wrapper`) con logo comune, ricerca, menu user
- [ ] Skip link obbligatori: "Vai ai contenuti", "Vai al footer"
- [ ] Footer istituzionale (`it-footer`) con 4 colonne, logo EU, social, note legali
- [ ] Layout base: container con margini e padding secondo spaziatura 8px grid
- [ ] Card component: `card card-bg` con stile uniforme (bianco, ombreggiatura leggera, bordi arrotondati)
- [ ] Button primario: `btn btn-primary` (sfondo `#007a52`, testo bianco)
- [ ] Button secondario: `btn btn-link` (testo `#007a52`, sottolineato)

### 3.2 Mappa e marker
- [ ] Mappa Leaflet 1.9.4 caricata localmente (no CDN)
- [ ] Marker personalizzato con `L.divIcon`:
    - SVG: cerchio esterno `#007a52` fill, bordo `#ffffff`, cerchio interno `#ffffff` fill
    - Dimensione: 24x24px, anchor inferiore centrale
    - Stato di focus: contorno 3px solid `#17334f` (WCAG 2.1 AA)
- [ ] Clustering marker per prestazioni (MarkerCluster)
- [ ] Popup marker con informazioni ticket (titolo, stato, link dettaglio)
- [ ] Controlli mappa: zoom, pieno schermo, scala

### 3.3 Flusso creazione segnalazione (wizard)
- [ ] 4 step obbligatori:
    1. **Privacy**: accettazione policy privacy (obbligatoria, richiamata da `GetPublishedPrivacyPolicyAction`)
    2. **Dati**: inserimento titolo, tipo, descrizione, posizione (mappa o indirizzo)
    3. **Riepilogo**: visualizzazione sola lettura dei dati inseriti
    4. **Conferma**: invio segnalazione, redirect a pagina di conferma
- [ ] Validazione lato server e client per ogni step
- [ ] Stato wizard salvato in URL tramite parametro `step`
- [ ] Messaggi di errore accessibili (aria-live, ruolo alert)
- [ ] Step indicator visibile con progress bar

### 3.4 Pagine specifiche
#### Homepage (`home.blade.php` / `index.blade.php`)
- [ ] Hero sezione con titolo comune, descrizione, CTA primario ("Segnala un problema")
- [ ] Mappa centrale con marker dei ticket recenti
- [ ] Sezione "Come funziona" con 3-4 card illustrative
- [ ] Sezione "Azioni rapide" con link a: crea segnalazione, visualizza mappa, categorie
- [ ] Newsletter o avvisi istituzionali (se presenti nel CMS)

#### Catalogo ticket (`tickets/index.blade.php`)
- [ ] Barra di ricerca per filtro per testo, categoria, stato
- [ ] Lista ticket in formato card o elenco semplice (responsive)
- [ ] Mappa laterale o sottostante con marker dei ticket filtrati
- [ ] Paginazione o scroll infinito
- [ ] Ordinamento per data, vicinanza, voto

#### Dettaglio ticket (`tickets/show.blade.php`)
- [ ] Intestazione con ID ticket, stato, data creazione
- [ ] Descrizione completa, posizione su mappa statica
- [ ] Sezione aggiornamenti/storico (se implementato)
- [ ] CTA: "Traccia questa segnalazione", "Condividi"

#### Traccia ticket (`tickets/track.blade.php`)
- [ ] Campo input per codice ticket (es. TCK-ABC123)
- [ ] Pulsante "Traccia" che reindirizza a `/tickets/show/{id}` se trovato
- [ ] Messaggio di errore accessibile se ticket non trovato

#### Categorie (`categories/*.blade.php`)
- [ ] Elenco gerarchico o a griglia delle categorie di segnalazione
- [ ] Ogni categoria mostra numero ticket associati e descrizione breve
- [ ] Click su categoria filtra il catalogo ticket

#### Pagine di errore (`errors/404.blade.php`, `errors/500.blade.php`)
- [ ] Layout istituzionale con header/footer DesignComuni
- [ ] Messaggio di errore chiaro e suggerimento di azione (es. torni alla homepage)
- [ ] Link di ritorno alla homepage o al catalogo ticket

#### Pagina accessibilità (`accessibility.blade.php`)
- [ ] Dichiarazione di accessibilità conforme al modello AGID
- [ ] Descrizione delle conformità WCAG 2.1 AA raggiunte
- [ ] Contatti per segnalazione problemi di accessibilità
- [ ] Data ultima revisione e versione dichiarazione

### 3.5 Interattività e stato
- [ ] AlpineJS per stati UI locali (menu mobile, accordion, toggle)
- [ ] Lit Web Components per componenti riutilizzabili (es. `<map-lit>`, `<step-indicator>`)
- [ ] Nessun utilizzo di jQuery o framework pesanti
- [ ] Transizioni animate rispettano `prefers-reduced-motion`

### 3.6 Accessibilità (WCAG 2.1 AA)
- [ ] Contrasto testo: rapporto minimo 4.5:1 (testo normale), 3:1 (testo grande)
- [ ] Contrasto componenti UI: rapporto minimo 3:1 (bordi, icone, stati di focus)
- [ ] Tutti gli elementi interattivi hanno stato `:focus-visible` definito
- [ ] Skip link presenti e funzionanti all'inizio della pagina
- [ ] Aria-label su elementi non testuali (marker mappa, icone)
- [ ] Ordine di tab logico e intuitivo
- [ ] Etichette di form associate correttamente ai controlli
- [ ] Messaggi di errore e validazione accessibili (role="alert" o aria-live)
- [ ] Dimensioni touch target minimo 44x44px
- [ ] Video e audio con sottotitoli/trascrizioni (se presenti)

### 3.7 Performance e SEO
- [ ] Caricamento differito di immagini fuori dallo viewport (loading="lazy")
- [ ] Minificazione e concatenazione di asset CSS e JS
- [ ] Uso di HTTP/2 e header di cache adeguati
- [ ] Meta tag Open Graph e Twitter Card per condivisione social
- [ ] Struttura dati strutturati (Schema.org) per entità Comune e segnalazione
- [ ] Tempo di prima verniciatura (FCP) < 1.5s su connessione 3G

### 3.8 Deploy e manutenzione
- [ ] Symlink automatizzato in fase di deploy: `public_html/themes/Sixteen → laravel/Themes/Sixteen/public`
- [ ] Asset locali (CSS, JS, immagini, font) serviti dallo stesso dominio
- [ ] Nessuna dipendenza da CDN esterni per asset critici
- [ ] Versionamento asset tramite hash in nome file (cache busting)
- [ ] Script di rollback per symlink e asset

## 4. Requisiti non funzionali

### 4.1 Sicurezza
- [ ] Tutte le azioni protette da middleware di autenticazione dove richiesto
- [ ] Validazione e sanificazione di tutti gli input (server-side)
- [ ] Protezione CSRF sui form
- [ ] Headers di sicurezza (X-Frame-Options, X-Content-Type-Options, Referrer-Policy)
- [ ] Logging degli errori senza esposizione di informazioni sensibili

### 4.2 Compatibilità
- [ ] Supporto per browser: Chrome ≥109, Firefox ≥109, Safari ≥15, Edge ≥109
- [ ] Fallback per browser senza JavaScript (contenuto essenziale accessibile)
- [ ] Layout responsive: breakpoint mobile (≥320px), tablet (≥768px), desktop (≥1024px)
- [ ] Stampa foglio di stile ottimizzata per versione cartacea

### 4.3 Manutenibilità
- [ ] Codice Blade conforme a PSR-1 e PSR-12
- [ ] Classi e metodi PHP con type hint strict
- [ ] Commenti JSDoc per componenti JavaScript complessi
- [ ] Documentazione inline per variabili di configurazione
- [ ] Test unitari per azioni e servizi critici
- [ ] Test di integrazione per flussi principali (creazione segnalazione, ricerca)

### 4.4 Scalabilità
- [ ] Pagina carteggio ticket ottimizzata per grandi dataset (lazy load, paginazione)
- [ ] Query mappa indicizzate su campi geografici (latitudine, longitudine)
- [ ] Cache di viste comuni (header, footer, elenco categorie)
- [ ] Code di azioni pesanti (es. invio notifiche) tramite Spatie Queueable Action

## 5. Criteri di accettazione
Ogni pagina deve superare i seguenti test prima del merge:
- [ ] Test di conformità WCAG 2.1 AA (tool: axe-core o equivalente)
- [ ] Test di responsabilità su almeno 3 dispositivi reali
- [ ] Test di performance: Lighthouse punteggio ≥90 per categoria
- [ ] Test di regressione su funzionalità esistenti (ticket, categorie, utenti)
- [ ] Revisione del design da parte del UX/UI Designer
- [ ] Approvazione del Product Owner

## 6. Dipendenze esterne
- [ ] Laravel 13.x + PHP 8.2+
- [ ] Tailwind CSS v4 (via npm)
- [ ] AlpineJS 3.x (via npm)
- [ ] Lit 3.x (via npm)
- [ ] Leaflet 1.9.4 + MarkerCluster (asset locali)
- [ ] Spatie Laravel-Queueable Action
- [ ] Laravel Localization (per multi-lingua)
- [ ] Livewire 3.x (per wizard e componenti interattivi)

## 7. Rilascio e piano di iterazione
### Fase 1: Fondamenta (Sprint 1)
- [ ] Symlink asset e configurazione Tailwind
- [ ] Layout base con header/footer DesignComuni
- [ ] Skip link e stile di base (tipografia, colori, spaziatura)
- [ ] Componente button e card

### Fase 2: Mappa e marker (Sprint 2)
- [ ] Integrazione mappa Leaflet locale
- [ ] Marker personalizzato WCAG 2.1 AA
- [ ] Popup e interazioni di base
- [ ] Pagina homepage con mappa e hero

### Fase 3: Wizard segnalazione (Sprint 3)
- [ ] Implementazione wizard 4-step con Livewire
- [ ] Validazione privacy e dati
- [ ] Step indicator e navigazione
- [ ] Pagine create/step-*.blade.php

### Fase 4: Pagine di supporto (Sprint 4)
- [ ] Catalogo ticket con ricerca e filtri
- [ ] Dettaglio ticket e traccia per codice
- [ ] Elenco categorie e pagine di errore
- [ ] Pagina accessibilità

### Fase 5: Rifinitura e QA (Sprint 5)
- [ ] Test di accessibilità su tutte le pagine
- [ ] Ottimizzazione performance e SEO
- [ ] Test di regressione e bug fixing
- [ ] Documentazione finale e deploy in produzione

## 8. Metriche di successo
- [ ] Aumento del 20% delle segnalazioni create per utente (post-redesign)
- [ ] Riduzione del 30% degli errori di validazione nel wizard
- [ ] Punteggio medio SUS (System Usability Scale) ≥80
- [ ] Conformità WCAG 2.1 AA su 100% delle pagine front office
- [ ] Tempo medio di creazione segnalazione < 2 minuti