---
title: "Lista categorie: contratto di rendering Sixteen"
type: bmad-ux-contract
status: active
owner: Sixteen
tags: [bmad, ux, accessibility, categories]
---

# Contratto

Sixteen rende il catalogo passato dalla pagina Folio del modulo Fixcity. La
pagina deve rispondere alla domanda del cittadino: “che tipo di problema posso
segnalare e dove vedo le segnalazioni?”.

Il layout usa il contratto pubblico esistente (`x-layouts.app`, breadcrumb,
Tailwind, Alpine/Lit/DaisyUI/Flowbite già disponibili) e mantiene card leggibili
alle viewport 375, 768 e 1440 px. Le azioni primarie sono sempre visibili:
segnalare un problema e consultare le segnalazioni.

Le card sono informative: non mostrano conteggi o link filtrati finché il
workflow HTTP/Livewire non supporta realmente il filtro per categoria. Questo
evita di promettere un comportamento inesistente.
