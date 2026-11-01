<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

<<<<<<< .merge_file_IcjqFp
=======
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
>>>>>>> .merge_file_LT4PZv
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Themes\Sixteen\Enums\MunicipalLocationCategoryEnum;
use Themes\Sixteen\Enums\MunicipalLocationTypeEnum;

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
<<<<<<< .merge_file_IcjqFp
 * @property array|null $coordinates
 * @property string|null $floor
 * @property string|null $room
 * @property array|null $building_info
 * @property array|null $opening_hours
=======
 * @property array{lat?: float, lng?: float}|null $coordinates
 * @property string|null $floor
 * @property string|null $room
 * @property array<array-key, mixed>|null $building_info
 * @property array<string, list<array{open?: string, close?: string}>>|null $opening_hours
>>>>>>> .merge_file_LT4PZv
 * @property bool $public_access
 * @property bool $appointment_required
 * @property string|null $appointment_url
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $pec
 * @property string|null $fax
 * @property string|null $website
<<<<<<< .merge_file_IcjqFp
 * @property array|null $directions
 * @property array|null $parking_info
 * @property array|null $public_transport
 * @property array|null $accessibility_info
 * @property array|null $facilities
 * @property array|null $equipment
=======
 * @property array<array-key, mixed>|null $directions
 * @property array<string, mixed>|null $parking_info
 * @property array<int, mixed>|null $public_transport
 * @property array<string, mixed>|null $accessibility_info
 * @property array<int, mixed>|null $facilities
 * @property array<array-key, mixed>|null $equipment
>>>>>>> .merge_file_LT4PZv
 * @property int|null $capacity
 * @property array|null $services_available
 * @property array|null $staff_info
 * @property array|null $manager_info
 * @property array|null $emergency_contacts
 * @property array|null $safety_info
 * @property string|null $image
<<<<<<< .merge_file_IcjqFp
 * @property array|null $gallery
=======
 * @property array<int, mixed>|null $gallery
>>>>>>> .merge_file_LT4PZv
 * @property string|null $virtual_tour_url
 * @property string|null $map_embed
 * @property string|null $place_id
 * @property bool $is_active
 * @property bool $is_public
 * @property bool $is_headquarters
 * @property bool $is_accessible
 * @property int $priority_level
<<<<<<< .merge_file_IcjqFp
 * @property array|null $metadata
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, OrganizationalUnit> $organizationalUnits
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MunicipalService> $services
 * @property-read \Illuminate\Database\Eloquent\Collection<int, MunicipalEvent> $events
=======
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
>>>>>>> .merge_file_LT4PZv
 */
class MunicipalLocation extends Model
{
    use HasFactory, SoftDeletes;

<<<<<<< .merge_file_IcjqFp
    /**
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

=======
>>>>>>> .merge_file_LT4PZv
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
     * Relazione con i punti di contatto
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return MorphMany<ContactPoint, $this>
>>>>>>> .merge_file_LT4PZv
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
     * Relazione con le unità organizzative
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return BelongsToMany<OrganizationalUnit, $this>
>>>>>>> .merge_file_LT4PZv
     */
    public function organizationalUnits(): BelongsToMany
    {
        return $this->belongsToMany(OrganizationalUnit::class, 'sixteen_unit_locations');
    }

    /**
     * Relazione con i servizi erogati
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return BelongsToMany<MunicipalService, $this>
>>>>>>> .merge_file_LT4PZv
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalService::class, 'sixteen_service_locations');
    }

    /**
     * Relazione con gli eventi che si svolgono nella sede
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return HasMany<MunicipalEvent, $this>
>>>>>>> .merge_file_LT4PZv
     */
    public function events(): HasMany
    {
        return $this->hasMany(MunicipalEvent::class, 'venue_name', 'name');
    }

    /**
     * Scope per sedi attive
     */
<<<<<<< .merge_file_IcjqFp
    public function scopeActive($query)
=======
    public function scopeActive(Builder $query): Builder
>>>>>>> .merge_file_LT4PZv
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope per sedi pubbliche
     */
<<<<<<< .merge_file_IcjqFp
    public function scopePublic($query)
=======
    public function scopePublic(Builder $query): Builder
>>>>>>> .merge_file_LT4PZv
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope per sedi accessibili
     */
<<<<<<< .merge_file_IcjqFp
    public function scopeAccessible($query)
=======
    public function scopeAccessible(Builder $query): Builder
>>>>>>> .merge_file_LT4PZv
    {
        return $query->where('is_accessible', true);
    }

    /**
     * Scope per tipologia di sede
     */
<<<<<<< .merge_file_IcjqFp
    public function scopeOfType($query, string $type)
=======
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> .merge_file_LT4PZv
    {
        return $query->where('location_type', $type);
    }

    /**
     * Scope per categoria
     */
<<<<<<< .merge_file_IcjqFp
    public function scopeInCategory($query, string $category)
=======
    public function scopeInCategory(Builder $query, string $category): Builder
>>>>>>> .merge_file_LT4PZv
    {
        return $query->where('category', $category);
    }

    /**
     * Scope per sedi principali
     */
<<<<<<< .merge_file_IcjqFp
    public function scopeHeadquarters($query)
=======
    public function scopeHeadquarters(Builder $query): Builder
>>>>>>> .merge_file_LT4PZv
    {
        return $query->where('is_headquarters', true);
    }

    /**
     * Scope ordinati per priorità
     */
<<<<<<< .merge_file_IcjqFp
    public function scopeOrdered($query)
=======
    public function scopeOrdered(Builder $query): Builder
>>>>>>> .merge_file_LT4PZv
    {
        return $query->orderByDesc('is_headquarters')
            ->orderByDesc('priority_level')
            ->orderBy('name');
    }

    /**
     * Scope per ricerca geografica
     */
<<<<<<< .merge_file_IcjqFp
    public function scopeNearby($query, float $lat, float $lng, float $radiusKm = 10)
=======
    public function scopeNearby(Builder $query, float $lat, float $lng, float $radiusKm = 10): Builder
>>>>>>> .merge_file_LT4PZv
    {
        return $query->whereRaw(
            '(6371 * acos(cos(radians(?)) * cos(radians(JSON_EXTRACT(coordinates, "$.lat"))) * cos(radians(JSON_EXTRACT(coordinates, "$.lng")) - radians(?)) + sin(radians(?)) * sin(radians(JSON_EXTRACT(coordinates, "$.lat"))))) <= ?',
            [$lat, $lng, $lat, $radiusKm]
        );
    }

    /**
     * Ottiene gli orari di apertura formattati
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return array<int|string, mixed>
>>>>>>> .merge_file_LT4PZv
     */
    public function getFormattedOpeningHours(): array
    {
        if (! $this->opening_hours || ! is_array($this->opening_hours)) {
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

        return collect($days)
<<<<<<< .merge_file_IcjqFp
            ->mapWithKeys(function ($day) use ($dayNames) {
                $hours = $this->opening_hours[$day] ?? null;
=======
            ->mapWithKeys(function (string $day) use ($dayNames, $openingHours): array {
                $hours = $openingHours[$day] ?? [];
>>>>>>> .merge_file_LT4PZv

                return [$dayNames[$day] => $hours];
            })
            ->filter()
            ->toArray();
    }

    /**
     * Ottiene le informazioni sui mezzi pubblici
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return array<int|string, mixed>
>>>>>>> .merge_file_LT4PZv
     */
    public function getFormattedPublicTransport(): array
    {
        if (! $this->public_transport || ! is_array($this->public_transport)) {
            return [];
        }

<<<<<<< .merge_file_IcjqFp
        return collect($this->public_transport)
            ->map(function ($transport) {
=======
        return collect($publicTransport)
            ->map(function (mixed $transport): mixed {
>>>>>>> .merge_file_LT4PZv
                if (is_string($transport)) {
                    return ['type' => 'bus', 'line' => $transport];
                }

                return $transport;
            })
            ->groupBy('type')
            ->toArray();
    }

    /**
     * Ottiene le informazioni sull'accessibilità
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return array<string, mixed>
>>>>>>> .merge_file_LT4PZv
     */
    public function getFormattedAccessibilityInfo(): array
    {
        if (! $this->accessibility_info || ! is_array($this->accessibility_info)) {
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

        return array_merge($defaultFeatures, $this->accessibility_info);
    }

    /**
     * Ottiene le facilities disponibili
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return array<int|string, mixed>
>>>>>>> .merge_file_LT4PZv
     */
    public function getFormattedFacilities(): array
    {
        if (! $this->facilities || ! is_array($this->facilities)) {
            return [];
        }

<<<<<<< .merge_file_IcjqFp
        return collect($this->facilities)
            ->map(function ($facility) {
=======
        return collect($facilities)
            ->map(function (mixed $facility): mixed {
>>>>>>> .merge_file_LT4PZv
                if (is_string($facility)) {
                    return ['name' => $facility, 'available' => true];
                }

                return $facility;
            })
            ->toArray();
    }

    /**
     * Ottiene i servizi disponibili formattati
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return array<array-key, mixed>
>>>>>>> .merge_file_LT4PZv
     */
    public function getFormattedServicesAvailable(): array
    {
        if (! $this->services_available || ! is_array($this->services_available)) {
            return [];
        }

<<<<<<< .merge_file_IcjqFp
        return collect($this->services_available)
            ->mapWithKeys(function ($available, $service) {
                if (is_numeric($service)) {
                    // Array semplice
=======
        return collect($servicesAvailable)
            ->mapWithKeys(function (mixed $available, int|string $service): array {
                if (is_numeric($service) && is_string($available)) {
                    // Array semplice: il valore è il nome del servizio
>>>>>>> .merge_file_LT4PZv
                    return [$available => true];
                }

                // Array associativo
                return [$service => $available];
            })
            ->toArray();
    }

    /**
     * Ottiene le informazioni sui parcheggi
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return array<string, mixed>
>>>>>>> .merge_file_LT4PZv
     */
    public function getFormattedParkingInfo(): array
    {
        if (! $this->parking_info || ! is_array($this->parking_info)) {
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

        return array_merge($defaultInfo, $this->parking_info);
    }

    /**
     * Ottiene la galleria immagini formattata
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return array<int|string, mixed>
>>>>>>> .merge_file_LT4PZv
     */
    public function getFormattedGallery(): array
    {
        if (! $this->gallery || ! is_array($this->gallery)) {
            return [];
        }

<<<<<<< .merge_file_IcjqFp
        return collect($this->gallery)
            ->map(function ($image) {
=======
        return collect($gallery)
            ->map(function (mixed $image): mixed {
>>>>>>> .merge_file_LT4PZv
                if (is_string($image)) {
                    return [
                        'path' => $image,
                        'url' => asset('storage/'.$image),
                        'caption' => null,
                        'alt' => $this->name,
                    ];
                }

<<<<<<< .merge_file_IcjqFp
=======
                if (! is_array($image)) {
                    return $image;
                }

>>>>>>> .merge_file_LT4PZv
                return array_merge([
                    'url' => isset($image['path']) ? asset('storage/'.$image['path']) : null,
                    'alt' => $this->name,
                ], $image);
            })
            ->toArray();
    }

    /**
     * Verifica se la sede è aperta ora
     */
    public function isOpenNow(): bool
    {
        if (! $this->opening_hours || ! is_array($this->opening_hours)) {
            return false;
        }

        $now = now();
        $currentDay = strtolower($now->format('l'));
        $currentTime = $now->format('H:i');

        $todayHours = $this->opening_hours[$currentDay] ?? null;

        if (! $todayHours || ! is_array($todayHours)) {
            return false;
        }

        foreach ($todayHours as $period) {
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
        if (! $this->has_coordinates) {
            return null;
        }

        $earthRadius = 6371; // km

<<<<<<< .merge_file_IcjqFp
        $latDelta = deg2rad($this->latitude - $lat);
        $lngDelta = deg2rad($this->longitude - $lng);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat)) * cos(deg2rad($this->latitude)) *
=======
        $latDelta = deg2rad($latitude - $lat);
        $lngDelta = deg2rad($longitude - $lng);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat)) * cos(deg2rad($latitude)) *
>>>>>>> .merge_file_LT4PZv
             sin($lngDelta / 2) * sin($lngDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }

    /**
     * Ottiene le informazioni complete della sede
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return array<string, mixed>
>>>>>>> .merge_file_LT4PZv
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
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_LT4PZv
     */
    protected function locationTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => MunicipalLocationTypeEnum::tryFrom($this->location_type)?->getLabel() ?? $this->location_type
        );
    }

    /**
     * Accessor per il nome della categoria
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<string|null, never>
>>>>>>> .merge_file_LT4PZv
     */
    protected function categoryName(): Attribute
    {
        return Attribute::make(
<<<<<<< .merge_file_IcjqFp
            get: fn () => self::CATEGORIES[$this->category] ?? $this->category
=======
            get: fn () => $this->category === null ? null : (MunicipalLocationCategoryEnum::tryFrom($this->category)?->getLabel() ?? $this->category)
>>>>>>> .merge_file_LT4PZv
        );
    }

    /**
     * Accessor per l'indirizzo completo
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_LT4PZv
     */
    protected function fullAddress(): Attribute
    {
        return Attribute::make(
            get: function () {
                $address = $this->address;

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
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<bool, never>
>>>>>>> .merge_file_LT4PZv
     */
    protected function hasCoordinates(): Attribute
    {
        return Attribute::make(
            get: fn () => isset($this->coordinates['lat']) && isset($this->coordinates['lng'])
        );
    }

    /**
     * Accessor per la latitudine
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<float|null, never>
>>>>>>> .merge_file_LT4PZv
     */
    protected function latitude(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->coordinates['lat'] ?? null
        );
    }

    /**
     * Accessor per la longitudine
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<float|null, never>
>>>>>>> .merge_file_LT4PZv
     */
    protected function longitude(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->coordinates['lng'] ?? null
        );
    }

    /**
     * Accessor per l'URL della sede
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_LT4PZv
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('municipal.locations.show', $this->slug)
        );
    }

    /**
     * Accessor per l'URL di Google Maps
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_LT4PZv
     */
    protected function googleMapsUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->has_coordinates) {
                    return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
                }

                return 'https://www.google.com/maps/search/'.urlencode($this->full_address);
            }
        );
    }

    /**
     * Mutator per il nome (genera automaticamente lo slug)
<<<<<<< .merge_file_IcjqFp
=======
     *
     * @return Attribute<string, string>
>>>>>>> .merge_file_LT4PZv
     */
    protected function name(): Attribute
    {
        return Attribute::make(
<<<<<<< .merge_file_IcjqFp
            set: function ($value) {
=======
            set: function (string $value): string {
>>>>>>> .merge_file_LT4PZv
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
<<<<<<< .merge_file_IcjqFp
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_LT4PZv
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });

        // Assicura unicità dello slug
<<<<<<< .merge_file_IcjqFp
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_LT4PZv
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });

        // Set default values
<<<<<<< .merge_file_IcjqFp
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_LT4PZv
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
