# Filament 5 Schema Form Access Rule

## Regola tema

Le view Sixteen che renderizzano widget Filament v5 devono usare lo schema esposto dal widget:

```blade
{{ $this->form }}
```

Non devono introdurre workaround o render path alternativi per compensare chiamate PHP errate come `getForm('form')`.

## Owner

- Widget/modulo: configura e legge lo schema con `$this->form`.
- Tema: renderizza lo schema e gestisce la parity visuale con CSS site/component-level.

## CTA Design Comuni

Le CTA del tema (`Avanti`, `Indietro`, `Conferma e invia`) sono bridge visuali sopra il widget Livewire. Non devono introdurre un contratto dati diverso.

Per il submit:

- la Blade puo' usare `wire:click="submit"`;
- il metodo del widget deve usare `$this->form->getState()`;
- la view non deve assumere `getForm('form')` o multiple forms legacy.

La parity visuale resta responsabilita' del tema; validation e normalizzazione restano responsabilita' del widget.
