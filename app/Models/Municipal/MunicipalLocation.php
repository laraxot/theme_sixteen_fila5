<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

<<<<<<< HEAD
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use Illuminate\Database\Eloquent\Builder;
use Themes\Sixteen\Actions\Url\BuildLocalizedFrontofficePathAction;

use Illuminate\Database\Eloquent\Casts\Attribute;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Modello per le sedi comunali (Municipal Location)
 *
 * Rappresenta sedi, uffici, punti di erogazione servizi
 * e altre location dell'ente secondo l'ontologia AGID
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $short_description
 * @property string $location_type
 * @property string|null $category
 * @property string|null $subcategory
 * @property string|null $address
 * @property string|null $civic_number
 * @property string|null $postal_code
 * @property string|null $city
 * @property string|null $province
 * @property string|null $region
 * @property string|null $country
<<<<<<< HEAD
 * @property array{lat?: float, lng?: float}|null $coordinates
 * @property string|null $floor
 * @property string|null $room
 * @property array<array-key, mixed>|null $building_info
 * @property array<string, list<array{open?: string, close?: string}>>|null $opening_hours
=======
<<<<<<< HEAD
 * @property array|null $coordinates
 * @property string|null $floor
 * @property string|null $room
 * @property array|null $building_info
 * @property array|null $opening_hours
=======
 * @property array<string, mixed>|null $coordinates
 * @property string|null $floor
 * @property string|null $room
 * @property array<string, mixed>|null $building_info
 * @property array<string, mixed>|null $opening_hours
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
 * @property bool $public_access
 * @property bool $appointment_required
 * @property string|null $appointment_url
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $pec
 * @property string|null $fax
 * @property string|null $website
<<<<<<< HEAD
 * @property array<array-key, mixed>|null $directions
 * @property array<string, mixed>|null $parking_info
 * @property array<int, mixed>|null $public_transport
 * @property array<string, mixed>|null $accessibility_info
 * @property array<int, mixed>|null $facilities
 * @property array<array-key, mixed>|null $equipment
 * @property int|null $capacity
 * @property array<array-key, mixed>|null $services_available
 * @property array<array-key, mixed>|null $staff_info
 * @property array<array-key, mixed>|null $manager_info
 * @property array<array-key, mixed>|null $emergency_contacts
 * @property array<array-key, mixed>|null $safety_info
 * @property string|null $image
 * @property array<int, mixed>|null $gallery
=======
<<<<<<< HEAD
 * @property array|null $directions
 * @property array|null $parking_info
 * @property array|null $public_transport
 * @property array|null $accessibility_info
 * @property array|null $facilities
 * @property array|null $equipment
 * @property int|null $capacity
 * @property array|null $services_available
 * @property array|null $staff_info
 * @property array|null $manager_info
 * @property array|null $emergency_contacts
 * @property array|null $safety_info
 * @property string|null $image
 * @property array|null $gallery
=======
 * @property array<string, mixed>|null $directions
 * @property array<string, mixed>|null $parking_info
 * @property array<string, mixed>|null $public_transport
 * @property array<string, mixed>|null $accessibility_info
 * @property array<string, mixed>|null $facilities
 * @property array<string, mixed>|null $equipment
 * @property int|null $capacity
 * @property array<string, mixed>|null $services_available
 * @property array<string, mixed>|null $staff_info
 * @property array<string, mixed>|null $manager_info
 * @property array<string, mixed>|null $emergency_contacts
 * @property array<string, mixed>|null $safety_info
 * @property string|null $image
 * @property array<string, mixed>|null $gallery
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
 * @property string|null $virtual_tour_url
 * @property string|null $map_embed
 * @property string|null $place_id
 * @property bool $is_active
 * @property bool $is_public
 * @property bool $is_headquarters
 * @property bool $is_accessible
 * @property int $priority_level
<<<<<<< HEAD
 * @property array<array-key, mixed>|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read string $location_type_name
 * @property-read string|null $category_name
 * @property-read string $full_address
 * @property-read bool $has_coordinates
 * @property-read float|null $latitude
 * @property-read float|null $longitude
 * @property-read string $url
 * @property-read string $google_maps_url
 * @property-read Collection<int, ContactPoint> $contacts
 * @property-read Collection<int, OrganizationalUnit> $organizationalUnits
 * @property-read Collection<int, MunicipalService> $services
 * @property-read Collection<int, MunicipalEvent> $events
 */
class MunicipalLocation extends Model
{
    /** @use HasFactory<Factory<self>> */
    use HasFactory, SoftDeletes;

    /**
=======
<<<<<<< HEAD
 * @property array|null $metadata
=======
 * @property array<string, mixed>|null $metadata
>>>>>>> edd328a (.)
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, OrganizationalUnit> $organizationalUnits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MunicipalService> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MunicipalEvent> $events
 */
<<<<<<< HEAD
class MunicipalLocation extends Model
{
    use HasFactory, SoftDeletes;

    /**
=======
class MunicipalLocation extends MunicipalBaseModel
{
    use SoftDeletes;

    /**
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     * Tipologie di location secondo AGID
     */
    public const LOCATION_TYPES = [
        'headquarters' => 'Sede Principale',
        'office' => 'Ufficio',
        'service_center' => 'Centro Servizi',
        'library' => 'Biblioteca',
        'school' => 'Scuola',
        'sports_facility' => 'Impianto Sportivo',
        'cultural_center' => 'Centro Culturale',
        'healthcare' => 'Struttura Sanitaria',
        'social_center' => 'Centro Sociale',
        'cemetery' => 'Cimitero',
        'market' => 'Mercato',
        'parking' => 'Parcheggio',
        'park' => 'Parco',
        'square' => 'Piazza',
        'monument' => 'Monumento',
        'tourist_office' => 'Ufficio Turistico',
        'waste_center' => 'Centro Raccolta Rifiuti',
        'emergency' => 'Struttura di Emergenza',
        'other' => 'Altro',
    ];

    /**
     * Categorie principali
     */
    public const CATEGORIES = [
        'administrative' => 'Amministrativo',
        'cultural' => 'Culturale',
        'educational' => 'Educativo',
        'sports' => 'Sportivo',
        'social' => 'Sociale',
        'healthcare' => 'Sanitario',
        'tourist' => 'Turistico',
        'commercial' => 'Commerciale',
        'environmental' => 'Ambientale',
        'emergency' => 'Emergenza',
    ];

    /**
     * Servizi disponibili
     */
    public const AVAILABLE_SERVICES = [
        'citizen_services' => 'Servizi al Cittadino',
        'document_collection' => 'Ritiro Documenti',
        'payments' => 'Pagamenti',
        'appointments' => 'Appuntamenti',
        'information' => 'Informazioni',
        'complaints' => 'Reclami/Segnalazioni',
        'wifi' => 'WiFi Gratuito',
        'photocopies' => 'Fotocopie',
        'parking' => 'Parcheggio',
        'accessibility' => 'Accessibilità',
        'translation' => 'Servizi di Traduzione',
        'assistance' => 'Assistenza',
    ];

    protected $table = 'sixteen_municipal_locations';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'location_type',
        'category',
        'subcategory',
        'address',
        'civic_number',
        'postal_code',
        'city',
        'province',
        'region',
        'country',
        'coordinates',
        'floor',
        'room',
        'building_info',
        'opening_hours',
        'public_access',
        'appointment_required',
        'appointment_url',
        'phone',
        'email',
        'pec',
        'fax',
        'website',
        'directions',
        'parking_info',
        'public_transport',
        'accessibility_info',
        'facilities',
        'equipment',
        'capacity',
        'services_available',
        'staff_info',
        'manager_info',
        'emergency_contacts',
        'safety_info',
        'image',
        'gallery',
        'virtual_tour_url',
        'map_embed',
        'place_id',
        'is_active',
        'is_public',
        'is_headquarters',
        'is_accessible',
        'priority_level',
        'metadata',
    ];

<<<<<<< HEAD
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'coordinates' => 'json',
            'building_info' => 'json',
            'opening_hours' => 'json',
            'directions' => 'json',
            'parking_info' => 'json',
            'public_transport' => 'json',
            'accessibility_info' => 'json',
            'facilities' => 'json',
            'equipment' => 'json',
            'services_available' => 'json',
            'staff_info' => 'json',
            'manager_info' => 'json',
            'emergency_contacts' => 'json',
            'safety_info' => 'json',
            'gallery' => 'json',
            'is_active' => 'boolean',
            'is_public' => 'boolean',
            'is_headquarters' => 'boolean',
            'is_accessible' => 'boolean',
            'appointment_required' => 'boolean',
            'public_access' => 'boolean',
            'capacity' => 'integer',
            'priority_level' => 'integer',
            'metadata' => 'json',
        ];
    }

    /**
     * Relazione con i punti di contatto
     *
     * @return MorphMany<ContactPoint, $this>
=======
    protected $casts = [
        'coordinates' => 'json',
        'building_info' => 'json',
        'opening_hours' => 'json',
        'directions' => 'json',
        'parking_info' => 'json',
        'public_transport' => 'json',
        'accessibility_info' => 'json',
        'facilities' => 'json',
        'equipment' => 'json',
        'services_available' => 'json',
        'staff_info' => 'json',
        'manager_info' => 'json',
        'emergency_contacts' => 'json',
        'safety_info' => 'json',
        'gallery' => 'json',
        'is_active' => 'boolean',
        'is_public' => 'boolean',
        'is_headquarters' => 'boolean',
        'is_accessible' => 'boolean',
        'appointment_required' => 'boolean',
        'public_access' => 'boolean',
        'capacity' => 'integer',
        'priority_level' => 'integer',
        'metadata' => 'json',
    ];

    /**
<<<<<<< HEAD
     * Relazione con i punti di contatto
=======
     * @return MorphMany<ContactPoint, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
<<<<<<< HEAD
     * Relazione con le unità organizzative
     *
     * @return BelongsToMany<OrganizationalUnit, $this>
=======
<<<<<<< HEAD
     * Relazione con le unità organizzative
=======
     * @return BelongsToMany<OrganizationalUnit, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function organizationalUnits(): BelongsToMany
    {
        return $this->belongsToMany(OrganizationalUnit::class, 'sixteen_unit_locations');
    }

    /**
<<<<<<< HEAD
     * Relazione con i servizi erogati
     *
     * @return BelongsToMany<MunicipalService, $this>
=======
<<<<<<< HEAD
     * Relazione con i servizi erogati
=======
     * @return BelongsToMany<MunicipalService, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalService::class, 'sixteen_service_locations');
    }

    /**
<<<<<<< HEAD
     * Relazione con gli eventi che si svolgono nella sede
     *
     * @return HasMany<MunicipalEvent, $this>
=======
<<<<<<< HEAD
     * Relazione con gli eventi che si svolgono nella sede
=======
     * @return HasMany<MunicipalEvent, $this>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function events(): HasMany
    {
        return $this->hasMany(MunicipalEvent::class, 'venue_name', 'name');
    }

    /**
<<<<<<< HEAD
     * Scope per sedi attive
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeActive(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope per sedi attive
     */
    public function scopeActive($query)
=======
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
     * Scope per sedi attive
     */
    public function scopeActive(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('is_active', true);
    }

    /**
<<<<<<< HEAD
     * Scope per sedi pubbliche
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopePublic(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope per sedi pubbliche
     */
    public function scopePublic($query)
=======
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
     * Scope per sedi pubbliche
     */
    public function scopePublic(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('is_public', true);
    }

    /**
<<<<<<< HEAD
     * Scope per sedi accessibili
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeAccessible(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope per sedi accessibili
     */
    public function scopeAccessible($query)
=======
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
     * Scope per sedi accessibili
     */
    public function scopeAccessible(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('is_accessible', true);
    }

    /**
<<<<<<< HEAD
     * Scope per tipologia di sede
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeOfType(Builder $query, string $type): Builder
=======
<<<<<<< HEAD
     * Scope per tipologia di sede
     */
    public function scopeOfType($query, string $type)
=======
     *
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
     * Scope per tipologia di sede
     */
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('location_type', $type);
    }

    /**
<<<<<<< HEAD
     * Scope per categoria
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeInCategory(Builder $query, string $category): Builder
=======
<<<<<<< HEAD
     * Scope per categoria
     */
    public function scopeInCategory($query, string $category)
=======
     *
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
     * Scope per categoria
     */
    public function scopeInCategory(Builder $query, string $category): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('category', $category);
    }

    /**
<<<<<<< HEAD
     * Scope per sedi principali
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeHeadquarters(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope per sedi principali
     */
    public function scopeHeadquarters($query)
=======
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
     * Scope per sedi principali
     */
    public function scopeHeadquarters(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->where('is_headquarters', true);
    }

    /**
<<<<<<< HEAD
     * Scope ordinati per priorità
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeOrdered(Builder $query): Builder
=======
<<<<<<< HEAD
     * Scope ordinati per priorità
     */
    public function scopeOrdered($query)
=======
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
     * Scope ordinati per priorità
     */
    public function scopeOrdered(Builder $query): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->orderByDesc('is_headquarters')
            ->orderByDesc('priority_level')
            ->orderBy('name');
    }

    /**
<<<<<<< HEAD
     * Scope per ricerca geografica
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeNearby(Builder $query, float $lat, float $lng, float $radiusKm = 10): Builder
=======
<<<<<<< HEAD
     * Scope per ricerca geografica
     */
    public function scopeNearby($query, float $lat, float $lng, float $radiusKm = 10)
=======
     *
     * @param  Builder<MunicipalLocation>  $query
     * @return Builder<MunicipalLocation>
     * Scope per ricerca geografica
     */
    public function scopeNearby(Builder $query, float $lat, float $lng, float $radiusKm = 10): Builder
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    {
        return $query->whereRaw(
            '(6371 * acos(cos(radians(?)) * cos(radians(JSON_EXTRACT(coordinates, "$.lat"))) * cos(radians(JSON_EXTRACT(coordinates, "$.lng")) - radians(?)) + sin(radians(?)) * sin(radians(JSON_EXTRACT(coordinates, "$.lat"))))) <= ?',
            [$lat, $lng, $lat, $radiusKm]
        );
    }

    /**
     * Ottiene gli orari di apertura formattati
<<<<<<< HEAD
     *
     * @return array<int|string, mixed>
     */
    public function getFormattedOpeningHours(): array
    {
        $openingHours = $this->opening_hours;

        if (! is_array($openingHours)) {
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
     */
    public function getFormattedOpeningHours(): array
    {
        if (! $this->opening_hours || ! is_array($this->opening_hours)) {
>>>>>>> laraxot/dev
            return [];
        }

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $dayNames = [
            'monday' => 'Lunedì',
            'tuesday' => 'Martedì',
            'wednesday' => 'Mercoledì',
            'thursday' => 'Giovedì',
            'friday' => 'Venerdì',
            'saturday' => 'Sabato',
            'sunday' => 'Domenica',
        ];

<<<<<<< HEAD
        return collect($days)
            ->mapWithKeys(function (string $day) use ($dayNames, $openingHours): array {
                $hours = $openingHours[$day] ?? [];
=======
<<<<<<< HEAD
        return collect($days)
=======
        $formatted = collect($days)
>>>>>>> edd328a (.)
            ->mapWithKeys(function ($day) use ($dayNames) {
                $hours = $this->opening_hours[$day] ?? null;
>>>>>>> laraxot/dev

                return [$dayNames[$day] => $hours];
            })
            ->filter()
<<<<<<< HEAD
            ->toArray();
=======
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene le informazioni sui mezzi pubblici
<<<<<<< HEAD
     *
     * @return array<int|string, mixed>
     */
    public function getFormattedPublicTransport(): array
    {
        $publicTransport = $this->public_transport;

        if (! is_array($publicTransport)) {
            return [];
        }

        return collect($publicTransport)
            ->map(function (mixed $transport): mixed {
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
     */
    public function getFormattedPublicTransport(): array
    {
        if (! $this->public_transport || ! is_array($this->public_transport)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->public_transport)
=======
        $formatted = collect($this->public_transport)
>>>>>>> edd328a (.)
            ->map(function ($transport) {
>>>>>>> laraxot/dev
                if (is_string($transport)) {
                    return ['type' => 'bus', 'line' => $transport];
                }

                return $transport;
            })
            ->groupBy('type')
<<<<<<< HEAD
            ->toArray();
=======
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene le informazioni sull'accessibilità
<<<<<<< HEAD
     *
     * @return array<string, mixed>
     */
    public function getFormattedAccessibilityInfo(): array
    {
        $accessibilityInfo = $this->accessibility_info;

        if (! is_array($accessibilityInfo)) {
=======
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> edd328a (.)
     */
    public function getFormattedAccessibilityInfo(): array
    {
        if (! $this->accessibility_info || ! is_array($this->accessibility_info)) {
>>>>>>> laraxot/dev
            return [];
        }

        $defaultFeatures = [
            'wheelchair_accessible' => false,
            'elevator' => false,
            'accessible_parking' => false,
            'accessible_toilets' => false,
            'audio_assistance' => false,
            'visual_assistance' => false,
            'ramp' => false,
            'wide_doors' => false,
        ];

<<<<<<< HEAD
        return array_merge($defaultFeatures, $accessibilityInfo);
=======
        return array_merge($defaultFeatures, $this->accessibility_info);
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene le facilities disponibili
<<<<<<< HEAD
     *
     * @return array<int|string, mixed>
     */
    public function getFormattedFacilities(): array
    {
        $facilities = $this->facilities;

        if (! is_array($facilities)) {
            return [];
        }

        return collect($facilities)
            ->map(function (mixed $facility): mixed {
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
     */
    public function getFormattedFacilities(): array
    {
        if (! $this->facilities || ! is_array($this->facilities)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->facilities)
=======
        $formatted = collect($this->facilities)
>>>>>>> edd328a (.)
            ->map(function ($facility) {
>>>>>>> laraxot/dev
                if (is_string($facility)) {
                    return ['name' => $facility, 'available' => true];
                }

                return $facility;
            })
<<<<<<< HEAD
            ->toArray();
=======
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene i servizi disponibili formattati
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
     */
    public function getFormattedServicesAvailable(): array
    {
        $servicesAvailable = $this->services_available;

        if (! is_array($servicesAvailable)) {
            return [];
        }

        return collect($servicesAvailable)
            ->mapWithKeys(function (mixed $available, int|string $service): array {
                if (is_numeric($service) && is_string($available)) {
                    // Array semplice: il valore è il nome del servizio
                    return [$available => true];
                }

                // Array associativo, o valore non stringa in un array semplice
                return [(string) $service => $available];
            })
            ->toArray();
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
     */
    public function getFormattedServicesAvailable(): array
    {
        if (! $this->services_available || ! is_array($this->services_available)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->services_available)
            ->mapWithKeys(function ($available, $service) {
                if (is_numeric($service)) {
                    // Array semplice
                    return [$available => true];
=======
        $formatted = collect($this->services_available)
            ->mapWithKeys(function ($available, $service) {
                if (is_numeric($service)) {
                    // Array semplice
                    return [(string) $available => true];
>>>>>>> edd328a (.)
                }

                // Array associativo
                return [$service => $available];
            })
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene le informazioni sui parcheggi
<<<<<<< HEAD
     *
     * @return array<string, mixed>
     */
    public function getFormattedParkingInfo(): array
    {
        $parkingInfo = $this->parking_info;

        if (! is_array($parkingInfo)) {
=======
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> edd328a (.)
     */
    public function getFormattedParkingInfo(): array
    {
        if (! $this->parking_info || ! is_array($this->parking_info)) {
>>>>>>> laraxot/dev
            return [];
        }

        $defaultInfo = [
            'available' => false,
            'free' => false,
            'paid' => false,
            'spaces' => null,
            'accessible_spaces' => null,
            'time_limit' => null,
            'cost' => null,
        ];

<<<<<<< HEAD
        return array_merge($defaultInfo, $parkingInfo);
=======
        return array_merge($defaultInfo, $this->parking_info);
>>>>>>> laraxot/dev
    }

    /**
     * Ottiene la galleria immagini formattata
<<<<<<< HEAD
     *
     * @return array<int|string, mixed>
     */
    public function getFormattedGallery(): array
    {
        $gallery = $this->gallery;

        if (! is_array($gallery)) {
            return [];
        }

        return collect($gallery)
            ->map(function (mixed $image): mixed {
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> edd328a (.)
     */
    public function getFormattedGallery(): array
    {
        if (! $this->gallery || ! is_array($this->gallery)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->gallery)
=======
        $formatted = collect($this->gallery)
>>>>>>> edd328a (.)
            ->map(function ($image) {
>>>>>>> laraxot/dev
                if (is_string($image)) {
                    return [
                        'path' => $image,
                        'url' => asset('storage/'.$image),
                        'caption' => null,
                        'alt' => $this->name,
                    ];
                }

<<<<<<< HEAD
                if (! is_array($image)) {
                    return $image;
                }

                return array_merge([
                    'url' => isset($image['path']) && is_string($image['path']) ? asset('storage/'.$image['path']) : null,
=======
<<<<<<< HEAD
                return array_merge([
                    'url' => isset($image['path']) ? asset('storage/'.$image['path']) : null,
>>>>>>> laraxot/dev
                    'alt' => $this->name,
                ], $image);
            })
            ->toArray();
<<<<<<< HEAD
=======
=======
                return is_array($image)
                    ? array_merge([
                        'url' => isset($image['path']) && is_string($image['path'])
                            ? asset('storage/'.$image['path'])
                            : null,
                        'alt' => $this->name,
                    ], $image)
                    : [];
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
    }

    /**
     * Verifica se la sede è aperta ora
     */
    public function isOpenNow(): bool
    {
<<<<<<< HEAD
        $openingHours = $this->opening_hours;

        if (! is_array($openingHours)) {
=======
        if (! $this->opening_hours || ! is_array($this->opening_hours)) {
>>>>>>> laraxot/dev
            return false;
        }

        $now = now();
        $currentDay = strtolower($now->format('l'));
        $currentTime = $now->format('H:i');

<<<<<<< HEAD
        $todayHours = $openingHours[$currentDay] ?? null;

        if (! $todayHours) {
=======
        $todayHours = $this->opening_hours[$currentDay] ?? null;

        if (! $todayHours || ! is_array($todayHours)) {
>>>>>>> laraxot/dev
            return false;
        }

        foreach ($todayHours as $period) {
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
            if (! is_array($period)) {
                continue;
            }
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            if (isset($period['open']) && isset($period['close'])) {
                if ($currentTime >= $period['open'] && $currentTime <= $period['close']) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Calcola la distanza da un punto
     */
    public function distanceFrom(float $lat, float $lng): ?float
    {
<<<<<<< HEAD
        $latitude = $this->latitude;
        $longitude = $this->longitude;

        if ($latitude === null || $longitude === null) {
=======
        if (! $this->has_coordinates) {
>>>>>>> laraxot/dev
            return null;
        }

        $earthRadius = 6371; // km

<<<<<<< HEAD
        $latDelta = deg2rad($latitude - $lat);
        $lngDelta = deg2rad($longitude - $lng);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat)) * cos(deg2rad($latitude)) *
=======
<<<<<<< HEAD
        $latDelta = deg2rad($this->latitude - $lat);
        $lngDelta = deg2rad($this->longitude - $lng);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat)) * cos(deg2rad($this->latitude)) *
=======
        $latDelta = deg2rad((float) ($this->latitude ?? 0.0) - $lat);
        $lngDelta = deg2rad($this->longitude - $lng);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat)) * cos(deg2rad((float) ($this->latitude ?? 0.0))) *
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
             sin($lngDelta / 2) * sin($lngDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }

    /**
     * Ottiene le informazioni complete della sede
<<<<<<< HEAD
     *
     * @return array<string, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    public function getLocationDetails(): array
    {
        return [
            'basic_info' => [
                'name' => $this->name,
                'type' => $this->location_type_name,
                'category' => $this->category_name,
                'description' => $this->description,
                'is_headquarters' => $this->is_headquarters,
                'is_accessible' => $this->is_accessible,
            ],
            'address' => [
                'full_address' => $this->full_address,
                'address' => $this->address,
                'civic_number' => $this->civic_number,
                'postal_code' => $this->postal_code,
                'city' => $this->city,
                'province' => $this->province,
                'floor' => $this->floor,
                'room' => $this->room,
                'coordinates' => $this->coordinates,
                'google_maps_url' => $this->google_maps_url,
            ],
            'access' => [
                'opening_hours' => $this->getFormattedOpeningHours(),
                'public_access' => $this->public_access,
                'appointment_required' => $this->appointment_required,
                'appointment_url' => $this->appointment_url,
                'is_open_now' => $this->isOpenNow(),
            ],
            'services' => [
                'services_available' => $this->getFormattedServicesAvailable(),
                'facilities' => $this->getFormattedFacilities(),
                'capacity' => $this->capacity,
            ],
            'accessibility' => $this->getFormattedAccessibilityInfo(),
            'transport' => [
                'public_transport' => $this->getFormattedPublicTransport(),
                'parking' => $this->getFormattedParkingInfo(),
                'directions' => $this->directions,
            ],
            'media' => [
                'image' => $this->image,
                'gallery' => $this->getFormattedGallery(),
                'virtual_tour_url' => $this->virtual_tour_url,
            ],
        ];
    }

    /**
     * Accessor per il nome del tipo di location
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function locationTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::LOCATION_TYPES[$this->location_type] ?? $this->location_type
        );
    }

    /**
     * Accessor per il nome della categoria
<<<<<<< HEAD
     *
     * @return Attribute<string|null, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function categoryName(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => $this->category === null ? null : (self::CATEGORIES[$this->category] ?? $this->category)
=======
            get: fn () => self::CATEGORIES[$this->category] ?? $this->category
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per l'indirizzo completo
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function fullAddress(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: function (): string {
                $address = (string) $this->address;
=======
            get: function () {
                $address = $this->address;
>>>>>>> laraxot/dev

                if ($this->civic_number) {
                    $address .= ', '.$this->civic_number;
                }

                if ($this->postal_code) {
                    $address .= ', '.$this->postal_code;
                }

                if ($this->city) {
                    $address .= ' '.$this->city;
                }

                if ($this->province) {
                    $address .= ' ('.$this->province.')';
                }

                return $address;
            }
        );
    }

    /**
     * Accessor per verificare se ha coordinate GPS
<<<<<<< HEAD
     *
     * @return Attribute<bool, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function hasCoordinates(): Attribute
    {
        return Attribute::make(
            get: fn () => isset($this->coordinates['lat']) && isset($this->coordinates['lng'])
        );
    }

    /**
     * Accessor per la latitudine
<<<<<<< HEAD
     *
     * @return Attribute<float|null, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<float|null, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function latitude(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->coordinates['lat'] ?? null
        );
    }

    /**
     * Accessor per la longitudine
<<<<<<< HEAD
     *
     * @return Attribute<float|null, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<float|null, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function longitude(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->coordinates['lng'] ?? null
        );
    }

    /**
     * Accessor per l'URL della sede
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function url(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => route('municipal.locations.show', $this->slug)
=======
<<<<<<< HEAD
            get: fn () => route('municipal.locations.show', $this->slug)
=======
            get: fn () => app(BuildLocalizedFrontofficePathAction::class)->execute('/vivere-il-comune/luoghi/'.$this->slug)
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per l'URL di Google Maps
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string|null, never>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function googleMapsUrl(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: function (): string {
                $latitude = $this->latitude;
                $longitude = $this->longitude;

                if ($latitude !== null && $longitude !== null) {
                    return "https://www.google.com/maps?q={$latitude},{$longitude}";
=======
            get: function () {
                if ($this->has_coordinates) {
                    return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
>>>>>>> laraxot/dev
                }

                return 'https://www.google.com/maps/search/'.urlencode($this->full_address);
            }
        );
    }

    /**
     * Mutator per il nome (genera automaticamente lo slug)
<<<<<<< HEAD
     *
     * @return Attribute<string, string>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<mixed, mixed>
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
     */
    protected function name(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            set: function (string $value): string {
=======
            set: function ($value) {
<<<<<<< HEAD
=======
                $value = (string) $value;
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
                $this->attributes['name'] = $value;
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
        static::creating(function (self $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
=======
        static::creating(function (MunicipalLocation $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug((string) $model->name);
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            }
        });

        // Assicura unicità dello slug
<<<<<<< HEAD
        static::creating(function (self $model): void {
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
=======
        static::creating(function (MunicipalLocation $model): void {
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });

        // Set default values
<<<<<<< HEAD
        static::creating(function (self $model): void {
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
=======
        static::creating(function (MunicipalLocation $model): void {
>>>>>>> edd328a (.)
>>>>>>> laraxot/dev
            if (is_null($model->priority_level)) {
                $model->priority_level = $model->is_headquarters ? 5 : 1;
            }

            if (is_null($model->country)) {
                $model->country = 'Italia';
            }

            if (is_null($model->public_access)) {
                $model->public_access = true;
            }
        });
    }
}
