---
title: "footer"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "footer"
issues: []
discussions: []
---

# Footer Component Documentation

## Overview
Il componente footer è un elemento di marketing che fornisce informazioni e link importanti nella parte inferiore del sito.

## Features
- Design responsive con Tailwind CSS
- Supporto per tema chiaro/scuro
- Logo e branding personalizzabile
- Sezioni per risorse, social media e informazioni legali
- Icone social media integrate (Facebook, Discord, Twitter, GitHub, Dribbble)

## Struttura
```blade
<footer class="bg-white dark:bg-black">
    <div class="mx-auto w-full max-w-screen-xl">
        <!-- Sezione principale -->
        <!-- Sezione social media -->
        <!-- Copyright -->
    </div>
</footer>
```

## Personalizzazione
- Colori: Modificabili attraverso le classi Tailwind
- Logo: Sostituibile nell'elemento img
- Link: Personalizzabili in ciascuna sezione
- Social Media: Aggiungibili/rimuovibili nella sezione social

## Recent Changes
- Rimossi conflitti di merge
- Migliorata la struttura del codice
- Aggiunto supporto per tema scuro 