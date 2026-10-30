{{-- featured-events: card griglia eventi in evidenza — Tailwind, NO Bootstrap --}}
<section class="py-10" aria-label="{{ __('pub_theme::blocks_content.shared.featured_events.label') }}">
  <div class="max-w-7xl mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6" style="color:#007A52">{{ __('pub_theme::blocks_content.shared.featured_events.label') }}</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      {{ $slot }}
    </div>
  </div>
</section>
