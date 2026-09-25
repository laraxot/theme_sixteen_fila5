<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

<<<<<<< HEAD
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use Illuminate\Database\Eloquent\Builder;
use Themes\Sixteen\Actions\Url\BuildLocalizedFrontofficePathAction;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
>>>>>>> edd328a (.)
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Modello per gli eventi municipali (Municipal Event)
 *
 * Rappresenta eventi, manifestazioni, incontri pubblici
 * e altre attività organizzate dall'ente secondo l'ontologia AGID
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $short_description
 * @property string $event_type
 * @property string|null $category
 * @property string|null $subcategory
 * @property int|null $organizational_unit_id
 * @property string|null $organizer
<<<<<<< HEAD
 * @property array|null $co_organizers
 * @property string $event_status
 * @property string $visibility
 * @property array|null $target_audience
=======
 * @property array<string, mixed>|null $co_organizers
 * @property string $event_status
 * @property string $visibility
 * @property array<string, mixed>|null $target_audience
>>>>>>> edd328a (.)
 * @property \Carbon\Carbon|null $start_date
 * @property \Carbon\Carbon|null $end_date
 * @property \Carbon\Carbon|null $start_time
 * @property \Carbon\Carbon|null $end_time
 * @property string|null $timezone
 * @property bool $is_all_day
 * @property bool $is_recurring
<<<<<<< HEAD
 * @property array|null $recurrence_pattern
=======
 * @property array<string, mixed>|null $recurrence_pattern
>>>>>>> edd328a (.)
 * @property string $location_type
 * @property string|null $venue_name
 * @property string|null $address
 * @property string|null $room
<<<<<<< HEAD
 * @property array|null $coordinates
=======
 * @property array<string, mixed>|null $coordinates
>>>>>>> edd328a (.)
 * @property string|null $online_url
 * @property string|null $streaming_url
 * @property bool $hybrid_mode
 * @property int|null $capacity
 * @property int $current_attendees
 * @property bool $registration_required
 * @property string|null $registration_url
 * @property \Carbon\Carbon|null $registration_deadline
 * @property float|null $registration_cost
<<<<<<< HEAD
 * @property array|null $contact_info
 * @property array|null $speaker_info
 * @property array|null $agenda
 * @property array|null $materials
 * @property array|null $requirements
 * @property array|null $accessibility_info
 * @property array|null $transport_info
 * @property array|null $parking_info
 * @property array|null $catering_info
 * @property string|null $image
 * @property array|null $gallery
 * @property array|null $documents
 * @property array|null $related_events
 * @property array|null $tags
 * @property array|null $social_links
=======
 * @property array<string, mixed>|null $contact_info
 * @property array<string, mixed>|null $speaker_info
 * @property array<string, mixed>|null $agenda
 * @property array<string, mixed>|null $materials
 * @property array<string, mixed>|null $requirements
 * @property array<string, mixed>|null $accessibility_info
 * @property array<string, mixed>|null $transport_info
 * @property array<string, mixed>|null $parking_info
 * @property array<string, mixed>|null $catering_info
 * @property string|null $image
 * @property array<string, mixed>|null $gallery
 * @property array<string, mixed>|null $documents
 * @property array<string, mixed>|null $related_events
 * @property array<string, mixed>|null $tags
 * @property array<string, mixed>|null $social_links
>>>>>>> edd328a (.)
 * @property string|null $feedback_url
 * @property string|null $recording_url
 * @property bool $is_published
 * @property \Carbon\Carbon|null $published_at
 * @property bool $featured
 * @property int $priority_level
<<<<<<< HEAD
 * @property array|null $metadata
=======
 * @property array<string, mixed>|null $metadata
>>>>>>> edd328a (.)
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
 * @property-read string $event_type_name
 * @property-read string $event_status_name
 * @property-read string $location_type_name
 * @property-read bool $is_upcoming
 * @property-read bool $is_ongoing
 * @property-read bool $is_past
 * @property-read bool $is_cancelled
 * @property-read bool $has_available_spots
 * @property-read int|null $available_spots
 * @property-read string|null $duration
 * @property-read string $url
 *
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, PublicPerson> $participants
 * @property-read \Illuminate\Database\Eloquent\Collection<int, PublicPerson> $speakers
 */
<<<<<<< HEAD
class MunicipalEvent extends Model
{
    use HasFactory, SoftDeletes;

    /**
=======
class MunicipalEvent extends MunicipalBaseModel
{
    use SoftDeletes;

    /**
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
>>>>>>> edd328a (.)
     * Tipologie di evento secondo AGID
     */
    public const EVENT_TYPES = [
        'council_meeting' => 'Consiglio Comunale',
        'committee_meeting' => 'Commissione',
        'public_meeting' => 'Assemblea Pubblica',
        'public_hearing' => 'Udienza Pubblica',
        'conference' => 'Conferenza',
        'workshop' => 'Workshop',
        'seminar' => 'Seminario',
        'training' => 'Formazione',
        'cultural_event' => 'Evento Culturale',
        'sports_event' => 'Evento Sportivo',
        'celebration' => 'Celebrazione',
        'ceremony' => 'Cerimonia',
        'exhibition' => 'Mostra/Esposizione',
        'fair' => 'Fiera',
        'festival' => 'Festival',
        'competition' => 'Concorso',
        'tender_opening' => 'Apertura Gara',
        'public_consultation' => 'Consultazione Pubblica',
        'other' => 'Altro',
    ];

    /**
     * Stati dell'evento
     */
    public const EVENT_STATUSES = [
        'scheduled' => 'Programmato',
        'confirmed' => 'Confermato',
        'cancelled' => 'Annullato',
        'postponed' => 'Rinviato',
        'in_progress' => 'In Corso',
        'completed' => 'Completato',
        'draft' => 'Bozza',
    ];

    /**
     * Tipologie di location
     */
    public const LOCATION_TYPES = [
        'physical' => 'Fisica',
        'online' => 'Online',
        'hybrid' => 'Ibrida',
        'tbd' => 'Da Definire',
    ];

    /**
     * Livelli di visibilità
     */
    public const VISIBILITY_LEVELS = [
        'public' => 'Pubblico',
        'restricted' => 'Riservato',
        'internal' => 'Interno',
        'invite_only' => 'Solo su Invito',
    ];

    protected $table = 'sixteen_municipal_events';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'event_type',
        'category',
        'subcategory',
        'organizational_unit_id',
        'organizer',
        'co_organizers',
        'event_status',
        'visibility',
        'target_audience',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'timezone',
        'is_all_day',
        'is_recurring',
        'recurrence_pattern',
        'location_type',
        'venue_name',
        'address',
        'room',
        'coordinates',
        'online_url',
        'streaming_url',
        'hybrid_mode',
        'capacity',
        'current_attendees',
        'registration_required',
        'registration_url',
        'registration_deadline',
        'registration_cost',
        'contact_info',
        'speaker_info',
        'agenda',
        'materials',
        'requirements',
        'accessibility_info',
        'transport_info',
        'parking_info',
        'catering_info',
        'image',
        'gallery',
        'documents',
        'related_events',
        'tags',
        'social_links',
        'feedback_url',
        'recording_url',
        'is_published',
        'published_at',
        'featured',
        'priority_level',
        'metadata',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'registration_deadline' => 'datetime',
        'published_at' => 'datetime',
        'is_all_day' => 'boolean',
        'is_recurring' => 'boolean',
        'hybrid_mode' => 'boolean',
        'registration_required' => 'boolean',
        'is_published' => 'boolean',
        'featured' => 'boolean',
        'capacity' => 'integer',
        'current_attendees' => 'integer',
        'registration_cost' => 'decimal:2',
        'priority_level' => 'integer',
        'co_organizers' => 'json',
        'target_audience' => 'json',
        'recurrence_pattern' => 'json',
        'coordinates' => 'json',
        'contact_info' => 'json',
        'speaker_info' => 'json',
        'agenda' => 'json',
        'materials' => 'json',
        'requirements' => 'json',
        'accessibility_info' => 'json',
        'transport_info' => 'json',
        'parking_info' => 'json',
        'catering_info' => 'json',
        'gallery' => 'json',
        'documents' => 'json',
        'related_events' => 'json',
        'tags' => 'json',
        'social_links' => 'json',
        'metadata' => 'json',
    ];

    /**
<<<<<<< HEAD
     * Relazione con l'unità organizzativa
=======
     * @return BelongsTo<OrganizationalUnit, $this>
>>>>>>> edd328a (.)
     */
    public function organizationalUnit(): BelongsTo
    {
        return $this->belongsTo(OrganizationalUnit::class);
    }

    /**
<<<<<<< HEAD
     * Relazione con i punti di contatto
=======
     * @return MorphMany<ContactPoint, $this>
>>>>>>> edd328a (.)
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
<<<<<<< HEAD
     * Relazione con le persone pubbliche (relatori, partecipanti)
=======
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> edd328a (.)
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_event_participants')
            ->withPivot(['role', 'is_speaker', 'bio', 'order'])
            ->withTimestamps()
            ->orderBy('pivot_order');
    }

    /**
     * Relazione con i relatori
<<<<<<< HEAD
=======
     *
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> edd328a (.)
     */
    public function speakers(): BelongsToMany
    {
        return $this->participants()->wherePivot('is_speaker', true);
    }

    /**
<<<<<<< HEAD
     * Scope per eventi pubblicati
     */
    public function scopePublished($query)
=======
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
     * Scope per eventi pubblicati
     */
    public function scopePublished(Builder $query): Builder
>>>>>>> edd328a (.)
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now());
    }

    /**
<<<<<<< HEAD
     * Scope per eventi pubblici
     */
    public function scopePublic($query)
=======
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
     * Scope per eventi pubblici
     */
    public function scopePublic(Builder $query): Builder
>>>>>>> edd328a (.)
    {
        return $query->where('visibility', 'public');
    }

    /**
<<<<<<< HEAD
     * Scope per eventi futuri
     */
    public function scopeUpcoming($query)
=======
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
     * Scope per eventi futuri
     */
    public function scopeUpcoming(Builder $query): Builder
>>>>>>> edd328a (.)
    {
        return $query->where('start_date', '>=', now()->toDateString())
            ->where('event_status', '!=', 'cancelled');
    }

    /**
<<<<<<< HEAD
     * Scope per eventi passati
     */
    public function scopePast($query)
=======
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
     * Scope per eventi passati
     */
    public function scopePast(Builder $query): Builder
>>>>>>> edd328a (.)
    {
        return $query->where('end_date', '<', now()->toDateString())
            ->orWhere(function ($q): void {
                $q->where('start_date', '<', now()->toDateString())
                    ->whereNull('end_date');
            });
    }

    /**
<<<<<<< HEAD
     * Scope per eventi in corso
     */
    public function scopeOngoing($query)
=======
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
     * Scope per eventi in corso
     */
    public function scopeOngoing(Builder $query): Builder
>>>>>>> edd328a (.)
    {
        $today = now()->toDateString();

        return $query->where('start_date', '<=', $today)
            ->where(function ($q) use ($today): void {
                $q->where('end_date', '>=', $today)
                    ->orWhereNull('end_date');
            })
            ->where('event_status', 'in_progress');
    }

    /**
<<<<<<< HEAD
     * Scope per tipologia di evento
     */
    public function scopeOfType($query, string $type)
=======
     *
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
     * Scope per tipologia di evento
     */
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> edd328a (.)
    {
        return $query->where('event_type', $type);
    }

    /**
<<<<<<< HEAD
     * Scope per eventi in evidenza
     */
    public function scopeFeatured($query)
=======
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
     * Scope per eventi in evidenza
     */
    public function scopeFeatured(Builder $query): Builder
>>>>>>> edd328a (.)
    {
        return $query->where('featured', true);
    }

    /**
<<<<<<< HEAD
     * Scope ordinati per data di inizio
     */
    public function scopeOrdered($query, string $direction = 'asc')
    {
        return $query->orderBy('start_date', $direction)
            ->orderBy('start_time', $direction);
=======
     *
     * @param  Builder<MunicipalEvent>  $query
     * @return Builder<MunicipalEvent>
     * Scope ordinati per data di inizio
     */
    public function scopeOrdered(Builder $query, string $direction = 'asc'): Builder
    {
        $dir = in_array($direction, ['asc', 'desc'], true) ? $direction : 'asc';

        return $query->orderBy('start_date', $dir)
            ->orderBy('start_time', $dir);
>>>>>>> edd328a (.)
    }

    /**
     * Ottiene la data/ora di inizio come Carbon
     */
    public function getStartDateTime(): Carbon
    {
<<<<<<< HEAD
        if ($this->is_all_day) {
            return $this->start_date->startOfDay();
        }

        return $this->start_time ?: $this->start_date->startOfDay();
=======
        $startDate = $this->start_date ?? now();

        if ($this->is_all_day) {
            return $startDate->copy()->startOfDay();
        }

        return $this->start_time?->copy() ?? $startDate->copy()->startOfDay();
>>>>>>> edd328a (.)
    }

    /**
     * Ottiene la data/ora di fine come Carbon
     */
    public function getEndDateTime(): ?Carbon
    {
        if ($this->is_all_day) {
<<<<<<< HEAD
            return $this->end_date ? $this->end_date->endOfDay() : $this->start_date->endOfDay();
=======
            return ($this->end_date ?? $this->start_date ?? now())->copy()->endOfDay();
>>>>>>> edd328a (.)
        }

        return $this->end_time;
    }

    /**
     * Ottiene la data/ora formattata per il display
     */
    public function getFormattedDateTime(): string
    {
<<<<<<< HEAD
=======
        if ($this->start_date === null) {
            return '';
        }

>>>>>>> edd328a (.)
        if ($this->is_all_day) {
            if ($this->end_date && ! $this->start_date->isSameDay($this->end_date)) {
                return $this->start_date->format('d/m/Y').' - '.$this->end_date->format('d/m/Y');
            }

            return $this->start_date->format('d/m/Y').' (tutto il giorno)';
        }

        $formatted = $this->start_date->format('d/m/Y');

        if ($this->start_time) {
            $formatted .= ' alle '.$this->start_time->format('H:i');

            if ($this->end_time) {
                if ($this->start_time->isSameDay($this->end_time)) {
                    $formatted .= ' - '.$this->end_time->format('H:i');
                } else {
                    $formatted .= ' - '.$this->end_time->format('d/m/Y H:i');
                }
            }
        }

        return $formatted;
    }

    /**
     * Ottiene l'agenda formattata
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
     */
    public function getFormattedAgenda(): array
    {
        if (! $this->agenda || ! is_array($this->agenda)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->agenda)
            ->map(function ($item, $index) {
=======
        $formatted = collect($this->agenda)
            ->map(function (mixed $item, int|string $index): array {
>>>>>>> edd328a (.)
                if (is_string($item)) {
                    return [
                        'time' => null,
                        'title' => $item,
                        'description' => null,
                        'speaker' => null,
<<<<<<< HEAD
                        'order' => $index,
                    ];
                }

                return array_merge(['order' => $index], $item);
            })
            ->sortBy('order')
            ->values()
            ->toArray();
=======
                        'order' => (int) $index,
                    ];
                }

                return is_array($item)
                    ? array_merge(['order' => (int) $index], $item)
                    : ['order' => (int) $index];
            })
            ->sortBy('order')
            ->values()
            ->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
    }

    /**
     * Ottiene i relatori formattati
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
     */
    public function getFormattedSpeakers(): array
    {
        if (! $this->speaker_info || ! is_array($this->speaker_info)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->speaker_info)
=======
        $formatted = collect($this->speaker_info)
>>>>>>> edd328a (.)
            ->map(function ($speaker) {
                if (is_string($speaker)) {
                    return ['name' => $speaker];
                }

                return $speaker;
            })
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
    }

    /**
     * Ottiene i requisiti di partecipazione
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
     */
    public function getFormattedRequirements(): array
    {
        if (! $this->requirements || ! is_array($this->requirements)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->requirements)
=======
        $formatted = collect($this->requirements)
>>>>>>> edd328a (.)
            ->map(function ($requirement) {
                if (is_string($requirement)) {
                    return ['description' => $requirement, 'mandatory' => true];
                }

                return $requirement;
            })
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
    }

    /**
     * Verifica se è possibile registrarsi
     */
    public function canRegister(): bool
    {
        if (! $this->registration_required) {
            return false;
        }

        if ($this->registration_deadline && $this->registration_deadline->isPast()) {
            return false;
        }

        if (! $this->hasAvailableSpots) {
            return false;
        }

        return in_array($this->event_status, ['scheduled', 'confirmed']);
    }

    /**
     * Verifica se l'evento è gratuito
     */
    public function isFree(): bool
    {
<<<<<<< HEAD
        return ! $this->registration_cost || $this->registration_cost === 0;
=======
        return $this->registration_cost === null || (float) $this->registration_cost === 0.0;
>>>>>>> edd328a (.)
    }

    /**
     * Ottiene informazioni complete sull'evento
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> edd328a (.)
     */
    public function getEventDetails(): array
    {
        return [
            'basic_info' => [
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->event_type_name,
                'category' => $this->category,
                'status' => $this->event_status_name,
                'organizer' => $this->organizer,
            ],
            'schedule' => [
                'formatted_datetime' => $this->getFormattedDateTime(),
                'start_datetime' => $this->getStartDateTime(),
                'end_datetime' => $this->getEndDateTime(),
                'duration' => $this->duration,
                'is_all_day' => $this->is_all_day,
                'timezone' => $this->timezone,
            ],
            'location' => [
                'type' => $this->location_type_name,
                'venue' => $this->venue_name,
                'address' => $this->address,
                'room' => $this->room,
                'online_url' => $this->online_url,
                'streaming_url' => $this->streaming_url,
                'hybrid_mode' => $this->hybrid_mode,
            ],
            'participation' => [
                'registration_required' => $this->registration_required,
                'registration_url' => $this->registration_url,
                'can_register' => $this->canRegister(),
                'capacity' => $this->capacity,
                'available_spots' => $this->available_spots,
                'cost' => $this->registration_cost,
                'is_free' => $this->isFree(),
            ],
            'content' => [
                'agenda' => $this->getFormattedAgenda(),
                'speakers' => $this->getFormattedSpeakers(),
                'materials' => $this->materials,
                'requirements' => $this->getFormattedRequirements(),
            ],
        ];
    }

    /**
     * Accessor per il nome del tipo di evento
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
     */
    protected function eventTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::EVENT_TYPES[$this->event_type] ?? $this->event_type
        );
    }

    /**
     * Accessor per il nome dello stato
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
     */
    protected function eventStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::EVENT_STATUSES[$this->event_status] ?? $this->event_status
        );
    }

    /**
     * Accessor per il nome del tipo di location
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
     */
    protected function locationTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::LOCATION_TYPES[$this->location_type] ?? $this->location_type
        );
    }

    /**
     * Accessor per verificare se l'evento è futuro
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> edd328a (.)
     */
    protected function isUpcoming(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => $this->start_date->isFuture() ||
                ($this->start_date->isToday() && $this->start_time?->isFuture())
=======
            get: fn () => $this->start_date?->isFuture() ||
                ($this->start_date?->isToday() && $this->start_time?->isFuture())
>>>>>>> edd328a (.)
        );
    }

    /**
     * Accessor per verificare se l'evento è in corso
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> edd328a (.)
     */
    protected function isOngoing(): Attribute
    {
        return Attribute::make(
            get: function () {
                $now = now();
                $startDateTime = $this->getStartDateTime();
                $endDateTime = $this->getEndDateTime();

                return $startDateTime <= $now &&
                       ($endDateTime >= $now || ! $endDateTime) &&
                       $this->event_status === 'in_progress';
            }
        );
    }

    /**
     * Accessor per verificare se l'evento è passato
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> edd328a (.)
     */
    protected function isPast(): Attribute
    {
        return Attribute::make(
            get: function () {
                $endDateTime = $this->getEndDateTime();

<<<<<<< HEAD
                return $endDateTime ? $endDateTime->isPast() : $this->start_date->isPast();
=======
                return $endDateTime ? $endDateTime->isPast() : (bool) $this->start_date?->isPast();
>>>>>>> edd328a (.)
            }
        );
    }

    /**
     * Accessor per verificare se l'evento è cancellato
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> edd328a (.)
     */
    protected function isCancelled(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->event_status === 'cancelled'
        );
    }

    /**
     * Accessor per verificare se ha posti disponibili
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> edd328a (.)
     */
    protected function hasAvailableSpots(): Attribute
    {
        return Attribute::make(
            get: fn () => ! $this->capacity || $this->current_attendees < $this->capacity
        );
    }

    /**
     * Accessor per i posti rimanenti
<<<<<<< HEAD
=======
     *
     * @return Attribute<int, never>
>>>>>>> edd328a (.)
     */
    protected function availableSpots(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->capacity ? $this->capacity - $this->current_attendees : null
        );
    }

    /**
     * Accessor per la durata dell'evento
<<<<<<< HEAD
=======
     *
     * @return Attribute<string|null, never>
>>>>>>> edd328a (.)
     */
    protected function duration(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->is_all_day) {
                    return $this->end_date
<<<<<<< HEAD
                        ? $this->start_date->diffInDays($this->end_date) + 1 .' giorni'
=======
                        ? (($this->start_date?->diffInDays($this->end_date) ?? 0) + 1).' giorni'
>>>>>>> edd328a (.)
                        : '1 giorno';
                }

                if ($this->start_time && $this->end_time) {
                    $diff = $this->start_time->diffInMinutes($this->end_time);

                    if ($diff >= 60) {
                        $hours = intval($diff / 60);
                        $minutes = $diff % 60;

                        return $minutes > 0 ? "{$hours}h {$minutes}m" : "{$hours}h";
                    }

                    return "{$diff}m";
                }
<<<<<<< HEAD
=======
            

                return '';
>>>>>>> edd328a (.)
            }
        );
    }

    /**
     * Accessor per l'URL dell'evento
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
     */
    protected function url(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => route('municipal.events.show', $this->slug)
=======
            get: fn () => app(BuildLocalizedFrontofficePathAction::class)->execute('/vivere-il-comune/eventi/'.$this->slug)
>>>>>>> edd328a (.)
        );
    }

    /**
     * Mutator per il titolo (genera automaticamente lo slug)
<<<<<<< HEAD
=======
     *
     * @return Attribute<mixed, mixed>
>>>>>>> edd328a (.)
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
<<<<<<< HEAD
=======
                $value = (string) $value;
>>>>>>> edd328a (.)
                $this->attributes['title'] = $value;
                if (empty($this->attributes['slug'])) {
                    $this->attributes['slug'] = Str::slug($value);
                }

                return $value;
            }
        );
    }

    /**
     * Boot del modello
     */
    protected static function boot(): void
    {
        parent::boot();

        // Genera slug se mancante
<<<<<<< HEAD
        static::creating(function ($model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
=======
        static::creating(function (MunicipalEvent $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug((string) $model->title);
>>>>>>> edd328a (.)
            }
        });

        // Assicura unicità dello slug
<<<<<<< HEAD
        static::creating(function ($model): void {
=======
        static::creating(function (MunicipalEvent $model): void {
>>>>>>> edd328a (.)
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });

        // Set default values
<<<<<<< HEAD
        static::creating(function ($model): void {
=======
        static::creating(function (MunicipalEvent $model): void {
>>>>>>> edd328a (.)
            if (is_null($model->event_status)) {
                $model->event_status = 'scheduled';
            }

            if (is_null($model->visibility)) {
                $model->visibility = 'public';
            }

            if (is_null($model->priority_level)) {
                $model->priority_level = 1;
            }
        });
    }
}
