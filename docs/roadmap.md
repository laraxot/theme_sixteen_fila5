# Roadmap - Tema Sixteen

**Status complessivo**: In sviluppo attivo - 45% completato
**Ultima revisione**: 2026-03-02

---

## Panoramica

Tema frontend per la Pubblica Amministrazione italiana. Implementa il Design System AGID
con Bootstrap Italia v2.16, Tailwind CSS v4 e Filament 5.x.

---

## Status per fase

| Fase | Descrizione | Status | Completamento |
|------|-------------|--------|---------------|
| 1 | Fondamenta e setup | Completata | 100% |
| 2 | Componenti AGID core | Completata | 100% |
| 3 | Ottimizzazione bundle | In corso | 40% |
| 4 | PWA e performance | Pianificata | 0% |
| 5 | Test e qualita | Pianificata | 5% |
| 6 | Accessibilita WCAG 2.1 AA | In corso | 60% |
| 7 | Produzione e deploy | Pianificata | 0% |

---

## Problemi critici aperti

| Problema | Severita | Status |
|----------|----------|--------|
| node_modules in git (347MB) | Critico | Da risolvere |
| Bundle app.js 850kb non ottimizzato | Alto | In corso |
| vendor.js 1.2MB non splittato | Alto | In corso |
| CSS purge incompleto (450kb) | Medio | In corso |

---

## File di dettaglio

- [Visione e obiettivi](roadmap/README.md)
- [Fasi di sviluppo](roadmap/01-phases.md)
- [Feature backlog](roadmap/02-features.md)
- [Debito tecnico](roadmap/03-technical-debt.md)
- [Standard di qualita](roadmap/04-quality.md)
- [Performance](roadmap/05-performance.md)

---

## Target metriche finali

| Metrica | Attuale | Target |
|---------|---------|--------|
| Lighthouse Performance | 78 | 95+ |
| Lighthouse Accessibility | 82 | 100 |
| Dimensione repo | 347MB | 45MB |
| Bundle gzipped | ~400kb | <200kb |
| FCP | 2.1s | <1.5s |
| LCP | 3.2s | <2.5s |
