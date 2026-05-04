<x-filament-widgets::widget>
{{-- Wrapper Design Comuni: titolo + wizard Filament con view custom --}}
<div class="ticket-wizard-root">
    {{-- Heading section --}}
    <div class="container wizard-dc-heading-shell">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="cmp-heading pb-3 pb-lg-4">
                    <h1 class="title-xxxlarge">{{ $pageTitle }}</h1>
                    @if($pageDescription !== '')
                        <p class="text-paragraph mb-0">{{ $pageDescription }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Wizard Form - stepper e azioni renderizzate dalla view custom pub_theme::components.wizard --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 pb-40 pb-lg-80">
                <form wire:submit="submit">
                    @if ($errors->has('data.submit') || $errors->has('submit'))
                        <div class="alert alert-danger mb-4" role="alert">
                            {{ $errors->first('data.submit') ?: $errors->first('submit') }}
                        </div>
                    @endif
                    {{ $this->form }}
                </form>
            </div>
        </div>
    </div>
</div>
<x-filament-actions::modals />
</x-filament-widgets::widget>