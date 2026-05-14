# Architettura Tema Sixteen - Wizard Parity

## Obiettivo

Garantire che tutti i componenti Wizard di Filament seguano fedelmente il design system "Design Comuni" (Bootstrap Italia) quando visualizzati nel frontoffice.

## Strategia di Implementazione

La parità visiva è ottenuta attraverso una combinazione di view Blade personalizzate e CSS scoped:

### 1. View Blade (`resources/views/components/wizard.blade.php`)

Questa view sostituisce il template di default di Filament per il componente Wizard. Le sue responsabilità sono:
*   Includere lo stepper personalizzato di Bootstrap Italia (`x-pub_theme::wizard.stepper`).
*   Configurare il componente Alpine.js `wizardSchemaComponent` di Filament.
*   Rendere le azioni (bottoni) secondo lo stile del tema.

**Requisiti per il Widget**:
La view richiede che il widget Livewire implementi il metodo `getWizardDisplayStep()` per ottenere l'indice dello step corrente.

### 2. CSS Parity (`resources/css/components/filament-wizard-parity.css`)

Questo file contiene i selettori CSS necessari per mappare il markup generato da Filament sulle classi di Bootstrap Italia.

**Regole di Scoping**:
*   Utilizzare il selettore `.fi-sc-wizard` per applicare gli stili a TUTTI i wizard del tema.
*   Evitare selettori specifici per singole pagine o feature (es. `.ticket-wizard-root`).
*   Utilizzare variabili CSS (es. `--dc-green`) per garantire coerenza con il resto del tema.

### 3. Steppers e Navigazione

Lo stepper segue la struttura di Design Comuni:
*   `.steppers`: Contenitore principale.
*   `.step-list`: Lista degli step con icone (numeri o checkmark per completati).
*   `.step-title`: Label dello step.
*   `.step-divider`: Linea di collegamento tra gli step.

## Manutenzione

Tutte le modifiche globali allo stile dei wizard devono essere effettuate in `filament-wizard-parity.css`. Non aggiungere stili specifici per i wizard in `app.css` o in file CSS dedicati a singole pagine.
