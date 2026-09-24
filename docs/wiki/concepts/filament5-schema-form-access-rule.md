<<<<<<< HEAD
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
- Schema owner: quando uno schema resource come `TicketForm` è il riferimento canonico, le firme `get{Name}Schema()` restano senza parametri. Il tema non deve richiedere varianti runtime passando oggetti o HTML dentro quelle firme: eventuali differenze di runtime appartengono al widget/modulo.

## CTA Design Comuni

Le CTA del tema (`Avanti`, `Indietro`, `Conferma e invia`) sono bridge visuali sopra il widget Livewire. Non devono introdurre un contratto dati diverso.

Per il submit:

- la Blade puo' usare `wire:click="submit"`;
- il metodo del widget deve usare `$this->form->getState()`;
- la view non deve assumere `getForm('form')` o multiple forms legacy.

La parity visuale resta responsabilita' del tema; validation e normalizzazione restano responsabilita' del widget.

## Anti-pattern

- Non parametrizzare metodi convenzionali tipo `getPrivacySchema(?HtmlString $notice = null)`: sono hook scoperti per nome da Xot/Filament, quindi devono restare stabili e senza argomenti.
- Non creare helper micro-astratti per piccoli gruppi di componenti leggibili: se tre `TextEntry` sono il contratto visuale, mantenerli espliciti è più KISS di un metodo generico.
=======
---
title: "Filament 5 Schema — accesso form nelle view Sixteen"
type: concept
module: Sixteen
tags: [filament, schema, form, view-cache, theme]
created: 2026-06-01
updated: 2026-07-24
related:
  - ./filament-multiple-forms.md
  - ../../../../../../docs/wiki/concepts/filament-v5-form-in-blade.md
  - ../../../../../../docs/wiki/memories/view-cache-gate-mandatory.md
  - ../../../../Modules/Xot/docs/wiki/concepts/filament-page-form-wrapper.md
---

# Filament 5 — schema form nelle view Sixteen

Upstream:
- Schema generico: [components/schema](https://filamentphp.com/docs/5.x/components/schema) → `{{ $this->{method} }}`
- Form: [components/form](https://filamentphp.com/docs/5.x/components/form) → `<form>` + `{{ $this->form }}` + `getState()`

Canon root: [filament-v5-schema-in-blade](../../../../../../docs/wiki/concepts/filament-v5-schema-in-blade.md).

## Regola tema

```blade
<form wire:submit="submit">
    {{ $this->form }}
</form>
```

Per infolist/read-only dal widget: `{{ $this->infolist }}` (metodo schema nominato, non wrapper inventati).

- Render: `{{ $this->form }}` (non `getForm('form')`, non `x-filament-schemas::form`)
- Submit widget: `$this->form->getState()`
- Schema owner: metodi `get{Name}Schema()` **senza** parametri runtime dal tema

## Confini

| Owner | Responsabilità |
|-------|----------------|
| Modulo / widget | Schema, validazione, `getState()`, redirect |
| Tema Sixteen | Markup, CTA Design Comuni, CSS parity |

## Gate chiusura

```bash
cd laravel && php artisan view:cache
```

Exit 0 obbligatorio dopo edit Blade del tema.
>>>>>>> laraxot/dev
