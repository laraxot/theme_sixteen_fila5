# 🎯 Filament Wizard Patterns - Best Practices

## Pattern Ufficiali Filament v5

### 1. **Wizard Base Structure**
```php
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;

// Nel widget
public function getFormSchema(): array
{
    return [
        Wizard::make($this->getWizardSteps())
            ->startOnStep(fn () => $this->wizardStartStep)
            ->columnSpanFull(),
    ];
}
```

### 2. **Step con Description** (Pattern Ufficiale)
```php
public function getWizardSteps(): array
{
    return [
        Step::make('privacy')
            ->description('Leggi e accetta l\'informativa privacy')
            ->schema($this->getPrivacySchema()),
        
        Step::make('data')
            ->description('Compila i dati della segnalazione')
            ->schema($this->getDataSchema()),
        
        Step::make('summary')
            ->description('Riepilogo dei dati inseriti')
            ->schema($this->getSummarySchema()),
    ];
}
```

### 3. **Form State Normalization**
```php
protected function normalizeWizardFormState(array $state): array
{
    // Flatten nested wizard state
    $key = $this->getWizardSchemaWrapperKey();
    if (isset($state[$key]) && is_array($state[$key])) {
        return $this->stringKeyed($state[$key]);
    }

    return $this->stringKeyed($state);
}
```

### 4. **Action Configuration**
```php
protected function configureWizardNextAction(Action $action): Action
{
    return $action
        ->icon('heroicon-o-arrow-right')
        ->requiresConfirmation(); // opzionale
}

protected function configureWizardPreviousAction(Action $action): Action
{
    return $action
        ->icon('heroicon-o-arrow-left');
}
```

## Anti-Patterns da Evitare

### ❌ **Hardcoded Labels**
```php
// SBAGLIATO
Text::make('name')->label('Nome')

// CORRETTO (Auto-label system)
Text::make('name') // LangServiceProvider gestisce il label
```

### ❌ **Enum Cast Directto**
```php
// SBAGLIATO
$type = TicketTypeEnum::tryFrom((string) ($get('type') ?? ''));

// CORRETTO
$typeValue = $get('type');
$type = is_string($typeValue) ? TicketTypeEnum::tryFrom($typeValue) : null;
```

### ❌ **Log nei Widget**
```php
// SBAGLIATO
Log::error($e->getMessage());

// CORRETTO
Notification::make()->danger()->title('Errore')->send();
```

## Pattern Migliorati XotBaseWizardWidget

### 1. **Step Navigation Safety**
```php
protected function queryStepOverrideAllowed(): bool
{
    // Consentito SOLO in sviluppo
    if (app()->isLocal()) return true;
    if (config('app.debug')) return true;
    
    return $this->wizardAllowStepQueryExtra();
}
```

### 2. **State Management**
```php
protected function normalizeWizardFormState(array $state): array
{
    // Garantisce che tutte le chiavi siano stringhe
    return $this->stringKeyed(
        $state[$this->getWizardSchemaWrapperKey()] ?? $state
    );
}
```

### 3. **Auto-Label System**
```php
// Pattern: {namespace}::{widget_name}.{type}.{field_name}.{property}
// es: fixcity::create_ticket_wizard.fields.address.placeholder
// es: fixcity::create_ticket_wizard.actions.next.label
```

## Customization Points

### Override nei Widget di Dominio

```php
class CreateTicketWizardWidget extends XotBaseWizardWidget
{
    // Custom validation tra step
    protected function beforeNextStep(): bool
    {
        if ($this->wizardStartStep === 1) {
            return $this->validatePrivacyStep();
        }
        return true;
    }

    // Custom data preparation
    protected function prepareWizardFormData(array $data): array
    {
        $data['status'] = 'pending';
        return $data;
    }

    // Custom action configuration
    protected function configureWizardNextAction(Action $action): Action
    {
        return parent::configureWizardNextAction($action)
            ->after(fn () => $this->afterNextStep());
    }
}
```

## Testing Pattern

### Pest Feature Test
```php
test('wizard navigation works', function () {
    $component = mountComponent(CreateTicketWizardWidget::class);
    
    // Step 1
    $component->assertSee('Privacy');
    
    // Next step
    $component->call('nextStep');
    $component->assertSee('Dati di segnalazione');
});
```

## Migration da Versioni Precedenti

### Da Filament v4 a v5
```php
// V4
use Filament\Forms\Concerns\ManagesFormState;

// V5
use Filament\Schemas\Components\Wizard;
```

### Key Changes
- `steps()` → `getWizardSteps()`
- `formSchema()` → `getFormSchema()`
- Actions sono ora configurate via callbacks
- State normalization è automatica

## Performance Tips

1. **Lazy Load Steps**: Caricare gli schema solo quando necessari
2. **Minimal State**: Non salvare dati temporanei nello stato
3. **Cache Labels**: Le labels sono gestite da LangServiceProvider
4. **Database Transactions**: Gestire nel metodo submit

---

**Ricorda**: Segui sempre la [documentazione ufficiale Filament](https://filamentphp.com/docs/5.x/resources/creating-records#using-a-wizard) per gli aggiornamenti più recenti.