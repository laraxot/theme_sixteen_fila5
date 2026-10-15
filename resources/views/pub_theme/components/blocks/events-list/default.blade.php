<div class="events-list-container">
    @if(isset($data['sections']))
        @foreach($data['sections'] as $sectionIndex => $section)
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-neutral-900 mb-6">{{ $section['title'] }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if(isset($data['events']))
                        @foreach($data['events'] as $eventIndex => $event)
                            <article class="card-wrapper border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden bg-white">
                                @if(isset($event['image']))
                                    <img src="{{ $event['image'] }}" alt="{{ $event['image_alt'] ?? $event['title'] }}" class="w-full h-48 object-cover" loading="lazy" />
                                @endif
                                <div class="card-body p-4">
                                    @if(isset($event['date']))
                                        <div class="card-calendar flex items-center gap-2 mb-2 text-sm text-primary-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="font-medium">{{ $event['date'] }}</span>
                                        </div>
                                    @endif
                                    <h3 class="card-title text-lg font-semibold text-neutral-900 mb-2">{{ $event['title'] }}</h3>
                                    @if(isset($event['description']))
                                        <p class="card-text text-secondary text-sm mb-3">{{ $event['description'] }}</p>
                                    @endif
                                    @if(isset($event['location']))
                                        <div class="flex items-center gap-1 text-sm text-neutral-500 mb-3">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span>{{ $event['location'] }}</span>
                                        </div>
                                    @endif
                                    @if(isset($event['url']))
                                        <a href="{{ $event['url'] }}" class="btn btn-primary btn-sm w-full text-center">Dettagli</a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
            </section>
        @endforeach
    @endif
</div>