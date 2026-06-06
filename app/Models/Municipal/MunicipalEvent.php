<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @property array|null $co_organizers
 * @property string $event_status
 * @property string $visibility
 * @property array|null $target_audience
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property Carbon|null $start_time
 * @property Carbon|null $end_time
 * @property string|null $timezone
 * @property bool $is_all_day
 * @property bool $is_recurring
 * @property array|null $recurrence_pattern
 * @property string $location_type
 * @property string|null $venue_name
 * @property string|null $address
 * @property string|null $room
 * @property array|null $coordinates
 * @property string|null $online_url
 * @property string|null $streaming_url
 * @property bool $hybrid_mode
 * @property int|null $capacity
 * @property int $current_attendees
 * @property bool $registration_required
 * @property string|null $registration_url
 * @property Carbon|null $registration_deadline
 * @property float|null $registration_cost
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
 * @property string|null $feedback_url
 * @property string|null $recording_url
 * @property bool $is_published
 * @property Carbon|null $published_at
 * @property bool $featured
 * @property int $priority_level
 * @property array|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
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
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read Collection<int, ContactPoint> $contacts
 * @property-read Collection<int, PublicPerson> $participants
 * @property-read Collection<int, PublicPerson> $speakers
 */
class MunicipalEvent extends Model
{
    use HasFactory, SoftDeletes;

/**
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

            ->orWhere(function ($q): void {
                $q->where('start_date', '<', now()->toDateString())
                    ->whereNull('end_date');
            });
    }

    /**
     * Scope per eventi in corso
     */
    public function scopeOngoing($query)
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
     * Scope per tipologia di evento
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('event_type', $type);
    }

    /**
     * Scope per eventi in evidenza
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope ordinati per data di inizio
     */
    public function scopeOrdered($query, string $direction = 'asc')
    {
        return $query->orderBy('start_date', $direction)
            ->orderBy('start_time', $direction);
    }

    /**
return ! $this->registration_cost || $this->registration_cost === 0;
    }

    /**
     * Ottiene informazioni complete sull'evento
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
     */
    protected function eventTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::EVENT_TYPES[$this->event_type] ?? $this->event_type
        );
    }

    /**
     * Accessor per il nome dello stato
     */
    protected function eventStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::EVENT_STATUSES[$this->event_status] ?? $this->event_status
        );
    }

    /**
     * Accessor per il nome del tipo di location
     */
    protected function locationTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::LOCATION_TYPES[$this->location_type] ?? $this->location_type
        );
    }

    /**
     * Accessor per verificare se l'evento è futuro
     */
    protected function isUpcoming(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->start_date->isFuture() ||
                ($this->start_date->isToday() && $this->start_time?->isFuture())
        );
    }

    /**
     * Accessor per verificare se l'evento è in corso
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
     */
    protected function isPast(): Attribute
    {
        return Attribute::make(
            get: function () {
                $endDateTime = $this->getEndDateTime();

                return $endDateTime ? $endDateTime->isPast() : $this->start_date->isPast();
            }
        );
    }

    /**
     * Accessor per verificare se l'evento è cancellato
     */
    protected function isCancelled(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->event_status === 'cancelled'
        );
    }

    /**
     * Accessor per verificare se ha posti disponibili
     */
    protected function hasAvailableSpots(): Attribute
    {
        return Attribute::make(
            get: fn () => ! $this->capacity || $this->current_attendees < $this->capacity
        );
    }

    /**
     * Accessor per i posti rimanenti
     */
    protected function availableSpots(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->capacity ? $this->capacity - $this->current_attendees : null
        );
    }

    /**
     * Accessor per la durata dell'evento
     */
    protected function duration(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->is_all_day) {
                    return $this->end_date
                        ? $this->start_date->diffInDays($this->end_date) + 1 .' giorni'
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
            }
        );
    }

    /**
     * Accessor per l'URL dell'evento
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('municipal.events.show', $this->slug)
        );
    }

    /**
     * Mutator per il titolo (genera automaticamente lo slug)
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
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
static::creating(function ($model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });

        // Assicura unicità dello slug
static::creating(function ($model): void {
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });

        // Set default values
static::creating(function ($model): void {
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
