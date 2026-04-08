# ⚠️ Filament Version Warning

**Data**: 2026-03-30  
**Stato**: ⚠️ **ATTENZIONE**

## 🚨 ERRORE GRAVE

**Citare documentazione Filament 3.x quando usiamo Filament 5!**

### Esempio di Errore ❌

```markdown
[Filament Icons Documentation](https://filamentphp.com/docs/5.x/forms/fields/icon-picker)
```

**Problema**: Link a Filament 3.x mentre il progetto usa **Filament 5.x**

## ✅ Correzione

### Documentazione Filament 5 ✅

```markdown
[Filament 5 Icon Component](https://filamentphp.com/docs/5.x/components/icon-button)
[Filament 5 Icons](https://filamentphp.com/docs/5.x/support/icons)
```

## 📚 Filament Version nel Progetto

**Versione Installata**: Filament 5.x

**Comandi per verificare**:
```bash
composer show filament/filament | grep versions
```

## 🔧 Come Citare Correttamente

### ✅ CORRETTO - Filament 5

```markdown
### Filament 5 Documentation
- [Icon Component](https://filamentphp.com/docs/5.x/components/icon-button)
- [Icons](https://filamentphp.com/docs/5.x/support/icons)
- [Forms](https://filamentphp.com/docs/5.x/forms/fields/icon-picker)
- [Tables](https://filamentphp.com/docs/5.x/tables/columns/icon-column)
```

### ❌ SBAGLIATO - Filament 3.x

```markdown
### Filament 3 Documentation (WRONG!)
- [Icon Picker](https://filamentphp.com/docs/5.x/forms/fields/icon-picker)
```

## 📋 Checklist Documentazione

Prima di pubblicare documentazione:

- [ ] Verificare versione Filament installata
- [ ] Usare solo link `/docs/5.x/`
- [ ] NON usare link `/docs/3.x/` o `/docs/4.x/`
- [ ] Controllare tutti i riferimenti

## 🎯 Impatto Errore

### Perché è Grave

1. **Confusione**: Sviluppatori seguono documentazione sbagliata
2. **API Diverse**: Filament 3, 4, 5 hanno API differenti
3. **Perdita Tempo**: Cercare soluzioni incompatibili
4. **Frustrazione**: Codice non funziona come atteso

### Esempio Pratico

**Filament 3.x**:
```blade
<x-icon name="heroicon-o-home" />
```

**Filament 5.x**:
```blade
<x-filament::icon icon="heroicon-o-home" />
```

**Risultato**: Codice Filament 3.x NON funziona su Filament 5!

## ✅ Best Practices

### 1. Sempre Specificare Versione

```markdown
### Filament 5.x Documentation
```

### 2. Usare URL Corretti

```
✅ https://filamentphp.com/docs/5.x/...
❌ https://filamentphp.com/docs/5.x/...
❌ https://filamentphp.com/docs/...  (senza versione)
```

### 3. Verificare Prima di Citare

```bash
# Check installed version
composer show filament/filament

# Should show: v5.x.x
```

## 📝 Filament 5 Features

### Icon Component

```blade
<x-filament::icon
    icon="brands.facebook"
    class="w-6 h-6"
/>
```

### Dynamic Icon

```blade
<x-filament::icon
    :icon="'brands.' . $platform"
    class="icon icon-sm"
/>
```

## 🔗 Correct Links

### Filament 5 Official Docs

- **Main**: https://filamentphp.com/docs/5.x/
- **Components**: https://filamentphp.com/docs/5.x/components
- **Icons**: https://filamentphp.com/docs/5.x/support/icons
- **Forms**: https://filamentphp.com/docs/5.x/forms
- **Tables**: https://filamentphp.com/docs/5.x/tables
- **Notifications**: https://filamentphp.com/docs/5.x/notifications
- **Actions**: https://filamentphp.com/docs/5.x/actions

## ⚠️ Warning Signs

Se vedi questi errori, probabilmente stai usando documentazione sbagliata:

- `Class 'Filament\Facades\Icon' not found`
- `View [icon] not found`
- `Method 'icon' does not exist`

**Soluzione**: Controlla di usare documentazione Filament 5!

## ✅ Verification

```bash
# 1. Check version
composer show filament/filament | grep versions
# Should be: v5.x.x

# 2. Check documentation links
grep -r "filamentphp.com/docs" docs/ | grep -v "5.x"
# Should return nothing

# 3. Fix any wrong links
# Replace /docs/3.x/ with /docs/5.x/
```

---

**Stato**: ⚠️ **ATTENZIONE - Usare SOLO Filament 5 docs**  
**Versione**: **Filament 5.x**  
**Documentazione**: **https://filamentphp.com/docs/5.x/**
