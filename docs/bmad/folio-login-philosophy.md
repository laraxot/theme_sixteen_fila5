---
title: "FOLIO + VOLT LOGIN PHILOSOPY (BMAD / Second Brain / Blueprint)"
type: note
status: draft
updated: 2026-10-18
tags: [docs, sixteen, bmad]
qmd: "folio + volt login philosopy (bmad / second brain / blueprint) sixteen"
---
# FOLIO + VOLT LOGIN PHILOSOPY (BMAD / Second Brain / Blueprint)

## Filosofia index.blade.php
- Volt component (`new class extends Component`)
- `name('home')` + middleware
- `mount()` carica `$data` da `.json` / CMS
- Layout `<x-layouts.app>` (non `@extends` standalone)
- `@volt('home')` per componente Livewire
- `<x-page :slug="$pageSlug" :data="$data" />` legge dati

## Filosofia login.blade.php (stesso approccio)
- DEVE essere Volt, non HTML statico
- DEVE usare `<x-layouts.app>` come layout
- DEVE leggere `.json` (es. `pages/auth/login.json`) per label/URL
- `name('auth.login')` + middleware
- `@volt('auth.login')`
