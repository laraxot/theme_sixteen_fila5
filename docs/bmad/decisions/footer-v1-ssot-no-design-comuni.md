---
title: "Footer SSoT — v1.blade.php, non design-comuni"
date: "2026-10-26"
status: decision-adopted
owner: theme-sixteen
related: header-ssot.md, design-comuni-header-structure-delta.md
---

## Decisione (2026-10-26)

Il footer segue il contratto `v1.blade.php` (SSoT). `sections/footer/design-comuni.blade.php` NON esiste (e non deve esistere) — il nome `design-comuni` nel footer è errato perché il tema Sixteen È già Design Comuni; duplicare il nome nel componente footer creerebbe confusione con il chrome header (`tpl="design-comuni"`).

### Stato verificato
- `v1.blade.php` (8948 byte) = footer completo (logo, link, social, credits)
- `full.blade.php` = wrapper che include `footer.v1`
- `design-comuni.blade.php` = assente (corretto); `.lock` residuo rimosso
- `brand-mark.blade.php` = aggiornato (`footer/v1.blade.php`), nessun riferimento a `design-comuni` residuo

### Regola
Per il footer: **solo `v1.blade.php`**. Per l'header: `v1.blade.php` (SSoT) + `design-comuni.blade.php` (chrome Design-Comuni specifico, `tpl="design-comuni"`).
