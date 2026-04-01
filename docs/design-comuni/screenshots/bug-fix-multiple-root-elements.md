# 🐛 Bug Fix - Multiple Root Elements in Volt

**Data**: 2026-03-30  
**Errore**: `MultipleRootElementsDetectedException`  
**Stato**: ✅ **RISOLTO**

## 🐛 Errore

```
Livewire\Features\SupportMultipleRootElementDetection\MultipleRootElementsDetectedException

Livewire only supports one HTML element per component. 
Multiple root elements detected for component: [volt-anonymous-fragment-...]
```

## 🔍 Causa

Il componente Volt aveva **multiple root elements** invece di un singolo elemento contenitore.

### Codice Sbagliato (❌)

```blade
<x-layouts.app>
    @volt('tests.homepage')

    {{-- Skip Links --}}
    <a class="skiplinks" href="#main">Vai al contenuto principale</a>

    {{-- Header --}}
    <x-section slug="header" />

    {{-- Main --}}
    <main>...</main>

    {{-- Footer --}}
    <x-section slug="footer" />

    @endvolt
</x-layouts.app>
```

**Problema**: 4 elementi root separati:
1. `<a>` (skiplinks)
2. `<x-section>` (header)
3. `<main>` (content)
4. `<x-section>` (footer)

## ✅ Soluzione

Avvolgere tutto il contenuto in un **singolo `<div>`**:

### Codice Corretto (✅)

```blade
<x-layouts.app>
    @volt('tests.homepage')
    <div>
        {{-- Skip Links --}}
        <a class="skiplinks" href="#main">Vai al contenuto principale</a>

        {{-- Header --}}
        <x-section slug="header" />

        {{-- Main --}}
        <main>...</main>

        {{-- Footer --}}
        <x-section slug="footer" />
    </div>
    @endvolt
</x-layouts.app>
```

**Soluzione**: 1 solo elemento root (`<div>`) che contiene tutto.

## 📋 Regola Volt/Livewire

**IMPORTANTE**: Ogni componente Volt/Livewire deve avere **UN SOLO** elemento HTML root.

### ✅ CORRETTO - Single Root Element

```blade
@volt('component')
<div>
    <header>...</header>
    <main>...</main>
    <footer>...</footer>
</div>
@endvolt
```

### ❌ SBAGLIATO - Multiple Root Elements

```blade
@volt('component')
<header>...</header>
<main>...</main>
<footer>...</footer>
@endvolt
```

## 🔧 Fix Applicato

**File**: `resources/views/pages/tests/homepage.blade.php`

**Modifiche**:
1. ✅ Aggiunto `<div>` di apertura dopo `@volt`
2. ✅ Aggiunto `</div>` prima di `@endvolt`
3. ✅ Tutto il contenuto ora è dentro un singolo elemento root

## 📊 Before vs After

### Before (Broken) ❌
```blade
@volt('tests.homepage')

<a>...</a>           <!-- Root 1 -->
<x-section />        <!-- Root 2 -->
<main>...</main>     <!-- Root 3 -->
<x-section />        <!-- Root 4 -->

@endvolt
```

**Risultato**: ❌ Eccezione Livewire

### After (Fixed) ✅
```blade
@volt('tests.homepage')
<div>                <!-- Single Root -->
    <a>...</a>
    <x-section />
    <main>...</main>
    <x-section />
</div>
@endvolt
```

**Risultato**: ✅ Funziona!

## ✅ Verification

```bash
# Clear cache
php artisan view:clear
php artisan cache:clear

# Test in browser
# http://fixcity.local/it/tests/homepage
# Should load without errors
```

## 📚 References

### Livewire Documentation
- [Component Structure](https://livewire.laravel.com/docs/components)
- **Key Point**: "Each Livewire component must have a single root element"

### Volt Documentation
- [Anonymous Components](https://github.com/livewire/volt)
- **Key Point**: "Volt components follow Livewire rules"

## 🎯 Lessons Learned

### Rule: Single Root Element

**When using Volt/Livewire:**
- ✅ ALWAYS wrap content in single `<div>`
- ✅ NEVER have multiple root elements
- ✅ Check structure before testing

### Common Mistake

```blade
{{-- WRONG --}}
@volt('page')
<header>...</header>
<main>...</main>
@endvolt

{{-- CORRECT --}}
@volt('page')
<div>
    <header>...</header>
    <main>...</main>
</div>
@endvolt
```

## 📝 Checklist Fix

- [x] Identify error (Multiple root elements)
- [x] Add single `<div>` wrapper
- [x] Close `</div>` before `@endvolt`
- [x] Clear cache
- [x] Test page
- [x] Document fix

---

**Stato**: ✅ **RISOLTO**  
**Fix**: Single `<div>` wrapper  
**Pronto per**: 🧪 Testing
