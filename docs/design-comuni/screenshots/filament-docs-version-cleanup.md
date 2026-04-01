# Filament Documentation Version Cleanup

**Data**: 2026-03-30  
**Priority**: HIGH  
**Status**: 🟡 IN PROGRESS

---

## 🎯 Obiettivo

Sostituire tutti i riferimenti a Filament 3.x con Filament 5.x nella documentazione.

**Vecchio**: `https://filamentphp.com/docs/3.x/...`  
**Nuovo**: `https://filamentphp.com/docs/5.x/...`

---

## 📊 Analisi

**Totale occorrenze trovate**: 273 file

### Per Directory

| Directory | Occorrenze |
|-----------|-----------|
| `laravel/Modules/UI/docs/` | ~100+ |
| `laravel/Modules/Cms/docs/` | ~50+ |
| `laravel/Themes/Sixteen/docs/` | ~20+ |
| `laravel/Themes/TwentyOne/docs/` | ~10+ |
| `laravel/Modules/Geo/docs/` | ~10+ |
| `laravel/Modules/Tenant/docs/` | ~5+ |
| `docs/` | ~5+ |
| Altri moduli | ~70+ |

---

## 🔧 Comando per Cleanup

### Find & Replace (Tutti i file .md)

```bash
cd /var/www/_bases/base_fixcity_fila5

# Dry run - vedi cosa cambierebbe
find . -name "*.md" -type f \
  -exec grep -l "filamentphp.com/docs/3.x" {} \;

# Actual replacement
find . -name "*.md" -type f \
  -exec sed -i 's|filamentphp.com/docs/3.x|filamentphp.com/docs/5.x|g' {} \;

# Verify
find . -name "*.md" -type f \
  -exec grep -l "filamentphp.com/docs/3.x" {} \;
# (should return nothing)
```

### Git Commit

```bash
git add -A
git commit -m "docs: update Filament documentation links from 3.x to 5.x

- Replace all filamentphp.com/docs/3.x references with 5.x
- Affects 273 markdown files across modules and themes
- No code changes, documentation only"
```

---

## ✅ File Già Corretti (Prioritari)

### Creati da AI Agent (2026-03-30)

1. ✅ `laravel/Themes/Sixteen/docs/FILAMENT_ICON_GUIDE.md`
   - Updated to Filament 5.x
   
2. ✅ `laravel/Themes/Sixteen/docs/blocks/BLOCKS_STRUCTURE_CONVENTION.md`
   - Updated to Filament 5.x
   
3. ✅ `laravel/Themes/Sixteen/docs/blocks/confirmation/README.md`
   - Updated to Filament 5.x
   
4. ✅ `.openviking/filament-icon-convention.md`
   - Updated to Filament 5.x

---

## 📋 Prossimi Passi

1. **Esegui cleanup automatico** su tutti i 273 file
2. **Review git diff** per verificare cambiamenti
3. **Commit** con messaggio descrittivo
4. **Aggiorna questa documentazione** con stato completato

---

## 🔗 References

- [Filament 5 Documentation](https://filamentphp.com/docs/5.x)
- [Filament 5 Upgrade Guide](https://filamentphp.com/docs/5.x/upgrade-guide)
- [Filament Icons (5.x)](https://filamentphp.com/docs/5.x/forms/icon-picker)

---

**Status**: 🟡 Ready for automated cleanup  
**Impact**: 273 files, documentation only  
**Risk**: LOW (only URL changes)
