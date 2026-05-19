# Wizard Step Visibility Mechanism

## Documentazione Tecnica - Perché il 1° Step Rimane Visibile

### Il Problema Osservato

Quando il wizard Filament viene renderizzato, tutti gli step (`<div class="fi-sc-wizard-step">`) sono visibili nel DOM e il primo step non viene mai nascosto correttamente.

### La Causa Root

Il CSS Filament nativo in `vendor/filament/schemas/resources/css/components/wizard.css` (linee 126-132) usa questa regola:

```css
.fi-sc-wizard .fi-sc-wizard-step {
    outline: none;
}

.fi-sc-wizard .fi-sc-wizard-step:not(.fi-active) {
    visibility: hidden;
    position: absolute;
    height: 0;
    overflow: hidden;
    padding: 0;
}
```

Questa regola funziona **solo se** lo step ha la classe `.fi-active`. Ma nel nostro Sixteen theme, lo step **NON** ottiene questa classe perché:

1. **Filament Wizard component** renderizza gli step in un loop `{{ $step }}` nel blade
2. **Alpine.js** gestisce la visibilità via `x-show` ma solo sullo step attivo
3. **Il CSS parity** del Sixteen theme **NASconde** il CSS Filament nativo (linee 11-16 di `filament-wizard-parity.css`):

```css
.fi-sc-wizard .fi-wiz-steps,
.fi-sc-wizard .fi-fo-wizard-header,
.fi-sc-wizard .fi-fo-wizard-step-header {
    display: none !important;
}
```

Questo nasconde `.fi-wiz-steps` (contenitore nativo Filament) e mostra solo lo stepper custom e i contenuti.

### L'Architettura Corretta

#### 1. Wizard Blade Template (`components/wizard.blade.php`)

```php
// Lo stepper custom (Design Comuni)
<x-pub_theme::wizard.stepper :steps="$steps" :total-steps="count($steps)" />

// Il contenuto di OGNI step viene renderizzato
@foreach ($steps as $step)
    {{ $step }}  // Renderizza lo schema dello step
@endforeach
```

#### 2. Alpine.js Wizard Component

L'Alpine component `wizardSchemaComponent` gestisce lo stato:

```javascript
wizardSchemaComponent({
    isSkippable: @js($isSkippable()),
    isStepPersistedInQueryString: @js($isStepPersistedInQueryString()),
    key: @js($key),
    startStep: @js($getStartStep()),
    stepQueryStringKey: @js($getStepQueryStringKey()),
})
```

- `step` = stato interno che tiene traccia dello step corrente
- `getStepIndex(step)` = funzione che restituisce l'indice numerico
- Lo step viene aggiornato da `goToStep()`, `goToNextStep()`, ecc.

#### 3. Lo Stepper Custom (`components/wizard/stepper.blade.php`)

```php
<li
    class="step-item"
    x-bind:class="{
        'active': getStepIndex(step) === {{ $index }},
        'confirmed': getStepIndex(step) > {{ $index }},
    }"
>
    <button x-on:click="step = @js($stepKey)">
        <span class="step-icon">{{ $stepNum }}</span>
        <span class="step-title">{{ $stepLabel }}</span>
    </button>
</li>
```

### La Regola CSS Critica

Per far funzionare il tutto, abbiamo bisogno di questa regola in `filament-wizard-parity.css`:

```css
/* CRITICO: Nascondi TUTTI gli step che non sono attivi */
.fi-sc-wizard .fi-sc-wizard-step {
    display: none !important;
}

/* Solo lo step attivo viene mostrato */
.fi-sc-wizard .fi-sc-wizard-step.fi-active {
    display: block !important;
}
```

**Senza questa regola**: Tutti gli step sono visibili e si accumulano verticalmente.

### Flusso di Render Completo

```
1. Widget::form() → Wizard::make()
                    ↓
2. Wizard::render() → wizard.blade.php
                    ↓
3. blade:$steps = $getChildSchema()->getComponents()
                    ↓
4. @foreach($steps as $step) → {{ $step }}
                    ↓
5. Ogni $step.render() → HTML del contenuto form
                    ↓
6. Alpine:x-data="wizardSchemaComponent(...)"
                    ↓
7. JavaScript gestisce visibilità via step state
                    ↓
8. CSS .fi-sc-wizard-step.fi-active { display: block }
                    ↓
9. Solo lo step corrente è visibile
```

### La Bellezza del Codice

#### 1. **Separazione View/Logic**

Il blade non contiene logica - solo rendering. La logica è nel widget PHP:
- `getStartStep()` → determina lo step iniziale
- `getSteps()` → definisce gli step astratti
- Actions → gestiscono la navigazione

#### 2. **Composition over Inheritance**

`XotBaseWizardWidget` usa il trait `HasWizard` ma **non lo eredita direttamente**:

```php
use HasWizard {
    getWizardComponent as getParentWizardComponent;
}
```

Questo permette di:
- Usare i metodi del trait quando servono
- Override quando necessario
- Mantenere flessibilità

#### 3. **State Management via Alpine**

Lo stato del wizard (`step`) è interamente gestito da Alpine.js:
- Nessuna comunicazione server per cambiare step
- Transizioni fluide
- URL persistence opzionale

#### 4. **CSS Visibility vs Display**

Filament usa `visibility: hidden; position: absolute; height: 0` che:
- Mantiene il DOM per accessibilità
- Nasconde visivamente ma preserva la struttura
- Permette transizioni animate

Noi usiamo `display: none` che:
- Rimuove completamente dal layout
- Più performante per form complessi
- Ma perde accessibilità (screen reader)

### Best Practice per il Future

Se vuoi che lo step sia accessibile da screen reader anche quando non attivo:

```css
/* Alternativa migliore per accessibilità */
.fi-sc-wizard .fi-sc-wizard-step {
    visibility: hidden;
    position: absolute;
    height: 0;
    overflow: hidden;
}

.fi-sc-wizard .fi-sc-wizard-step.fi-active {
    visibility: visible;
    position: static;
    height: auto;
}
```

Ma per ora `display: none` funziona perché i campi form sono comunque in accordion/raggruppati.

### Riferimenti

- `vendor/filament/schemas/resources/css/components/wizard.css:126-132`
- `laravel/Themes/Sixteen/resources/views/components/wizard.blade.php:56-58`
- `laravel/Themes/Sixteen/resources/css/components/filament-wizard-parity.css:113-120`