<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

<<<<<<< HEAD
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
=======
<<<<<<< HEAD
>>>>>>> 9e18142 (.)
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
=======
use Illuminate\Database\Eloquent\Builder;
use Themes\Sixteen\Support\FrontofficeUrl;

use Illuminate\Database\Eloquent\Casts\Attribute;
>>>>>>> 464cfc5 (.)
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Modello per i servizi comunali (Municipal Service)
 *
 * Rappresenta i servizi erogati dall'ente ai cittadini
 * secondo l'ontologia AGID e le specifiche dei servizi pubblici
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $short_description
 * @property string $service_type
 * @property string|null $category
 * @property string|null $subcategory
 * @property int|null $organizational_unit_id
 * @property int|null $parent_service_id
 * @property string $service_status
 * @property string $service_level
<<<<<<< HEAD
 * @property array<array-key, mixed>|null $target_audience
 * @property array<array-key, mixed>|null $geographic_coverage
 * @property array<array-key, mixed>|null $requirements
 * @property array<array-key, mixed>|null $procedures
 * @property array<array-key, mixed>|null $required_documents
 * @property array<array-key, mixed>|null $costs
=======
<<<<<<< HEAD
 * @property array|null $target_audience
 * @property array|null $geographic_coverage
 * @property array|null $requirements
 * @property array|null $procedures
 * @property array|null $required_documents
 * @property array|null $costs
>>>>>>> 9e18142 (.)
 * @property string|null $processing_time
 * @property array<array-key, mixed>|null $delivery_methods
 * @property array<array-key, mixed>|null $digital_channels
 * @property array<array-key, mixed>|null $physical_locations
 * @property array<array-key, mixed>|null $opening_hours
 * @property bool $appointment_required
 * @property string|null $appointment_url
 * @property string|null $online_form_url
<<<<<<< HEAD
 * @property array<array-key, mixed>|null $legislation_references
 * @property array<array-key, mixed>|null $accessibility_info
 * @property array<array-key, mixed>|null $contact_info
 * @property array<array-key, mixed>|null $faq
 * @property array<array-key, mixed>|null $related_services
 * @property array<array-key, mixed>|null $service_outcomes
 * @property array<array-key, mixed>|null $quality_standards
 * @property array<array-key, mixed>|null $satisfaction_metrics
 * @property Carbon|null $last_updated
 * @property Carbon|null $next_review_date
=======
 * @property array|null $legislation_references
 * @property array|null $accessibility_info
 * @property array|null $contact_info
 * @property array|null $faq
 * @property array|null $related_services
 * @property array|null $service_outcomes
 * @property array|null $quality_standards
 * @property array|null $satisfaction_metrics
=======
 * @property array<string, mixed>|null $target_audience
 * @property array<string, mixed>|null $geographic_coverage
 * @property array<string, mixed>|null $requirements
 * @property array<string, mixed>|null $procedures
 * @property array<string, mixed>|null $required_documents
 * @property array<string, mixed>|null $costs
 * @property string|null $processing_time
 * @property array<string, mixed>|null $delivery_methods
 * @property array<string, mixed>|null $digital_channels
 * @property array<string, mixed>|null $physical_locations
 * @property array<string, mixed>|null $opening_hours
 * @property bool $appointment_required
 * @property string|null $appointment_url
 * @property string|null $online_form_url
 * @property array<string, mixed>|null $legislation_references
 * @property array<string, mixed>|null $accessibility_info
 * @property array<string, mixed>|null $contact_info
 * @property array<string, mixed>|null $faq
 * @property array<string, mixed>|null $related_services
 * @property array<string, mixed>|null $service_outcomes
 * @property array<string, mixed>|null $quality_standards
 * @property array<string, mixed>|null $satisfaction_metrics
>>>>>>> 464cfc5 (.)
 * @property \Carbon\Carbon|null $last_updated
 * @property \Carbon\Carbon|null $next_review_date
>>>>>>> 9e18142 (.)
 * @property bool $is_active
 * @property bool $is_public
 * @property bool $is_digital
 * @property bool $is_accessible
 * @property int $priority_level
<<<<<<< HEAD
 * @property array<array-key, mixed>|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
=======
<<<<<<< HEAD
 * @property array|null $metadata
=======
 * @property array<string, mixed>|null $metadata
>>>>>>> 464cfc5 (.)
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
>>>>>>> 9e18142 (.)
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read self|null $parentService
 * @property-read Collection<int, self> $subServices
 * @property-read Collection<int, ContactPoint> $contacts
 * @property-read Collection<int, PublicDocument> $documents
 * @property-read Collection<int, MunicipalLocation> $locations
 * @property-read string $service_type_name
 * @property-read string $service_status_name
 * @property-read string $service_level_name
 * @property-read bool $is_available
 * @property-read bool $requires_appointment
 * @property-read string $url
 */
<<<<<<< HEAD
class MunicipalService extends Model
{
    /** @use HasFactory<Factory<static>> */
    use HasFactory, SoftDeletes;

    /**
=======
class MunicipalService extends MunicipalBaseModel
{
    use SoftDeletes;

    /**
     * @param  Builder<MunicipalService>  $query
     * @return Builder<MunicipalService>
>>>>>>> 464cfc5 (.)
     * Tipologie di servizio secondo AGID
     */
    public const SERVICE_TYPES = [
        'administrative' => 'Servizio Amministrativo',
        'demographic' => 'Servizio Demografico',
        'social' => 'Servizio Sociale',
        'educational' => 'Servizio Educativo',
        'cultural' => 'Servizio Culturale',
        'sports' => 'Servizio Sportivo',
        'environmental' => 'Servizio Ambientale',
        'urban_planning' => 'Servizio Urbanistico',
        'economic' => 'Servizio Economico',
        'tourism' => 'Servizio Turistico',
        'transport' => 'Servizio Trasporti',
        'safety' => 'Servizio Sicurezza',
        'health' => 'Servizio Sanitario',
        'digital' => 'Servizio Digitale',
        'other' => 'Altro',
    ];

    /**
     * Stati del servizio
     */
    public const SERVICE_STATUSES = [
        'active' => 'Attivo',
        'suspended' => 'Sospeso',
        'discontinued' => 'Sospeso Definitivamente',
        'in_development' => 'In Sviluppo',
        'testing' => 'In Fase di Test',
        'maintenance' => 'In Manutenzione',
    ];

    /**
     * Livelli di servizio
     */
    public const SERVICE_LEVELS = [
        'essential' => 'Servizio Essenziale',
        'standard' => 'Servizio Standard',
        'premium' => 'Servizio Premium',
        'emergency' => 'Servizio di Emergenza',
    ];

    /**
     * Metodi di erogazione
     */
    public const DELIVERY_METHODS = [
        'online' => 'Online',
        'in_person' => 'Di Persona',
        'phone' => 'Telefonico',
        'email' => 'Email',
        'mail' => 'Posta',
        'mobile_app' => 'App Mobile',
        'kiosk' => 'Chiosco Digitale',
    ];

    protected $table = 'sixteen_municipal_services';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'service_type',
        'category',
        'subcategory',
        'organizational_unit_id',
        'parent_service_id',
        'service_status',
        'service_level',
        'target_audience',
        'geographic_coverage',
        'requirements',
        'procedures',
        'required_documents',
        'costs',
        'processing_time',
        'delivery_methods',
        'digital_channels',
        'physical_locations',
        'opening_hours',
        'appointment_required',
        'appointment_url',
        'online_form_url',
        'legislation_references',
        'accessibility_info',
        'contact_info',
        'faq',
        'related_services',
        'service_outcomes',
        'quality_standards',
        'satisfaction_metrics',
        'last_updated',
        'next_review_date',
        'is_active',
        'is_public',
        'is_digital',
        'is_accessible',
        'priority_level',
        'metadata',
    ];

    protected $casts = [
        'requirements' => 'json',
        'procedures' => 'json',
        'required_documents' => 'json',
        'costs' => 'json',
        'delivery_methods' => 'json',
        'digital_channels' => 'json',
        'physical_locations' => 'json',
        'opening_hours' => 'json',
        'target_audience' => 'json',
        'geographic_coverage' => 'json',
        'legislation_references' => 'json',
        'accessibility_info' => 'json',
        'contact_info' => 'json',
        'faq' => 'json',
        'related_services' => 'json',
        'service_outcomes' => 'json',
        'quality_standards' => 'json',
        'satisfaction_metrics' => 'json',
        'last_updated' => 'datetime',
        'next_review_date' => 'date',
        'is_active' => 'boolean',
        'is_public' => 'boolean',
        'is_digital' => 'boolean',
        'is_accessible' => 'boolean',
        'appointment_required' => 'boolean',
        'priority_level' => 'integer',
        'metadata' => 'json',
    ];

    /**
<<<<<<< HEAD
     * Relazione con l'unità organizzativa responsabile
<<<<<<< HEAD
     *
     * @return BelongsTo<OrganizationalUnit, $this>
=======
=======
     * @return BelongsTo<OrganizationalUnit, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function organizationalUnit(): BelongsTo
    {
        return $this->belongsTo(OrganizationalUnit::class);
    }

    /**
<<<<<<< HEAD
     * Relazione con il servizio padre (per sottocategorie)
<<<<<<< HEAD
     *
     * @return BelongsTo<static, $this>
=======
=======
     * @return BelongsTo<self, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function parentService(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_service_id');
    }

    /**
<<<<<<< HEAD
     * Relazione con i servizi figlio
<<<<<<< HEAD
     *
     * @return HasMany<static, $this>
=======
=======
     * @return HasMany<self, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function subServices(): HasMany
    {
        return $this->hasMany(static::class, 'parent_service_id')->ordered();
    }

    /**
<<<<<<< HEAD
     * Relazione con i punti di contatto
<<<<<<< HEAD
     *
     * @return MorphMany<ContactPoint, $this>
=======
=======
     * @return MorphMany<ContactPoint, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
<<<<<<< HEAD
     * Relazione con i documenti associati
<<<<<<< HEAD
     *
     * @return HasMany<PublicDocument, $this>
=======
=======
     * @return HasMany<PublicDocument, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function documents(): HasMany
    {
        return $this->hasMany(PublicDocument::class, 'service_id');
    }

    /**
<<<<<<< HEAD
     * Relazione con le sedi di erogazione
<<<<<<< HEAD
     *
     * @return BelongsToMany<MunicipalLocation, $this, Pivot, 'pivot'>
=======
=======
     * @return BelongsToMany<MunicipalLocation, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalLocation::class, 'sixteen_service_locations');
    }

    /**
<<<<<<< HEAD
     * Scope per servizi attivi
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeActive(Builder $query): Builder
=======
    public function scopeActive($query)
=======
     * @param  Builder<MunicipalService>  $query
     * @return Builder<MunicipalService>
     * Scope per servizi attivi
     */
    public function scopeActive(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('is_active', true)
            ->where('service_status', 'active');
    }

    /**
<<<<<<< HEAD
     * Scope per servizi pubblici
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopePublic(Builder $query): Builder
=======
    public function scopePublic($query)
=======
     * @param  Builder<MunicipalService>  $query
     * @return Builder<MunicipalService>
     * Scope per servizi pubblici
     */
    public function scopePublic(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('is_public', true);
    }

    /**
<<<<<<< HEAD
     * Scope per servizi digitali
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeDigital(Builder $query): Builder
=======
    public function scopeDigital($query)
=======
     * @param  Builder<MunicipalService>  $query
     * @return Builder<MunicipalService>
     * Scope per servizi digitali
     */
    public function scopeDigital(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('is_digital', true);
    }

    /**
<<<<<<< HEAD
     * Scope per tipologia di servizio
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeOfType(Builder $query, string $type): Builder
=======
    public function scopeOfType($query, string $type)
=======
     *
     * @param  Builder<MunicipalService>  $query
     * @return Builder<MunicipalService>
     * Scope per tipologia di servizio
     */
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('service_type', $type);
    }

    /**
<<<<<<< HEAD
     * Scope per categoria
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeInCategory(Builder $query, string $category): Builder
=======
    public function scopeInCategory($query, string $category)
=======
     *
     * @param  Builder<MunicipalService>  $query
     * @return Builder<MunicipalService>
     * Scope per categoria
     */
    public function scopeInCategory(Builder $query, string $category): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('category', $category);
    }

    /**
<<<<<<< HEAD
     * Scope per servizi principali (senza parent)
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeMain(Builder $query): Builder
=======
    public function scopeMain($query)
=======
     * @param  Builder<MunicipalService>  $query
     * @return Builder<MunicipalService>
     * Scope per servizi principali (senza parent)
     */
    public function scopeMain(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->whereNull('parent_service_id');
    }

    /**
<<<<<<< HEAD
     * Scope ordinati per priorità e nome
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeOrdered(Builder $query): Builder
=======
    public function scopeOrdered($query)
=======
     * @param  Builder<MunicipalService>  $query
     * @return Builder<MunicipalService>
     * Scope ordinati per priorità e nome
     */
    public function scopeOrdered(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->orderByDesc('priority_level')->orderBy('name');
    }

    /**
     * Ottiene i requisiti formattati
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
>>>>>>> 464cfc5 (.)
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
>>>>>>> 464cfc5 (.)
    }

    /**
     * Ottiene le procedure formattate
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getFormattedProcedures(): array
    {
        if (! $this->procedures || ! is_array($this->procedures)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->procedures)
            ->map(function ($procedure, $index) {
                if (is_string($procedure)) {
                    return ['step' => $index + 1, 'description' => $procedure];
                }

                if (is_array($procedure)) {
                    return array_merge(['step' => $index + 1], $procedure);
                }

                return ['step' => $index + 1, 'description' => $procedure];
            })
            ->toArray();
=======
        $formatted = collect($this->procedures)
            ->map(function (mixed $procedure, int|string $index): array {
                if (is_string($procedure)) {
                    return ['step' => (int) $index + 1, 'description' => $procedure];
                }

                return is_array($procedure) ? array_merge(['step' => (int) $index + 1], $procedure) : ['step' => (int) $index + 1, 'description' => $procedure];
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> 464cfc5 (.)
    }

    /**
     * Ottiene i documenti richiesti formattati
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getFormattedRequiredDocuments(): array
    {
        if (! $this->required_documents || ! is_array($this->required_documents)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->required_documents)
=======
        $formatted = collect($this->required_documents)
>>>>>>> 464cfc5 (.)
            ->map(function ($document) {
                if (is_string($document)) {
                    return ['name' => $document, 'mandatory' => true];
                }

                return $document;
            })
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> 464cfc5 (.)
    }

    /**
     * Ottiene i costi formattati
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getFormattedCosts(): array
    {
        if (! $this->costs || ! is_array($this->costs)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->costs)
=======
        $formatted = collect($this->costs)
>>>>>>> 464cfc5 (.)
            ->map(function ($cost) {
                if (is_numeric($cost)) {
                    return ['amount' => $cost, 'description' => 'Costo del servizio'];
                }

                return $cost;
            })
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> 464cfc5 (.)
    }

    /**
     * Ottiene i canali digitali formattati
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getFormattedDigitalChannels(): array
    {
        if (! $this->digital_channels || ! is_array($this->digital_channels)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->digital_channels)
=======
        $formatted = collect($this->digital_channels)
>>>>>>> 464cfc5 (.)
            ->mapWithKeys(function ($url, $channel) {
                $channelNames = [
                    'website' => 'Sito Web',
                    'app' => 'App Mobile',
                    'portal' => 'Portale',
                    'pec' => 'PEC',
                    'spid' => 'SPID',
                    'cie' => 'CIE',
                    'pagopa' => 'PagoPA',
                ];

                return [$channelNames[$channel] ?? $channel => $url];
            })
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> 464cfc5 (.)
    }

    /**
     * Ottiene le FAQ formattate
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getFormattedFaq(): array
    {
        if (! $this->faq || ! is_array($this->faq)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->faq)
=======
        $formatted = collect($this->faq)
>>>>>>> 464cfc5 (.)
            ->map(function ($item, $index) {
                if (is_array($item) && isset($item['question']) && isset($item['answer'])) {
                    return $item;
                }

                return ['question' => "Domanda {$index}", 'answer' => $item];
            })
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> 464cfc5 (.)
    }

    /**
     * Verifica se il servizio è gratuito
     */
    public function isFree(): bool
    {
        if (! $this->costs || ! is_array($this->costs)) {
            return true;
        }

        return collect($this->costs)->every(function ($cost) {
            $amount = is_array($cost) ? ($cost['amount'] ?? 0) : $cost;

            return $amount === 0;
        });
    }

    /**
     * Verifica se il servizio è completamente digitale
     */
    public function isFullyDigital(): bool
    {
        return $this->is_digital &&
               is_array($this->delivery_methods) &&
               in_array('online', $this->delivery_methods) &&
               ! in_array('in_person', $this->delivery_methods);
    }

    /**
     * Ottiene il tempo di elaborazione stimato
     */
    public function getProcessingTimeFormatted(): ?string
    {
        if (! $this->processing_time) {
            return null;
        }

        // Se è un numero, assume giorni lavorativi
        if (is_numeric($this->processing_time)) {
            $days = (int) $this->processing_time;

            return $days === 1 ? '1 giorno lavorativo' : "{$days} giorni lavorativi";
        }

        return $this->processing_time;
    }

    /**
     * Verifica se il servizio necessita di aggiornamento
     */
    public function needsReview(): bool
    {
        if (! $this->next_review_date) {
            return false;
        }

        return $this->next_review_date->isPast();
    }

    /**
     * Ottiene informazioni per il citizen journey
<<<<<<< HEAD
     *
     * @return array<array-key, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getCitizenJourney(): array
    {
        return [
            'discover' => [
                'name' => $this->name,
                'description' => $this->short_description,
                'category' => $this->category,
                'target_audience' => $this->target_audience,
            ],
            'understand' => [
                'requirements' => $this->getFormattedRequirements(),
                'procedures' => $this->getFormattedProcedures(),
                'required_documents' => $this->getFormattedRequiredDocuments(),
                'costs' => $this->getFormattedCosts(),
                'processing_time' => $this->getProcessingTimeFormatted(),
            ],
            'access' => [
                'delivery_methods' => $this->delivery_methods,
                'digital_channels' => $this->getFormattedDigitalChannels(),
                'appointment_required' => $this->appointment_required,
                'appointment_url' => $this->appointment_url,
                'locations' => $this->physical_locations,
            ],
            'complete' => [
                'online_form_url' => $this->online_form_url,
                'contact_info' => $this->contact_info,
                'outcomes' => $this->service_outcomes,
            ],
        ];
    }

    /**
     * Accessor per il nome del tipo di servizio
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function serviceTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::SERVICE_TYPES[$this->service_type] ?? $this->service_type
        );
    }

    /**
     * Accessor per il nome dello stato
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function serviceStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::SERVICE_STATUSES[$this->service_status] ?? $this->service_status
        );
    }

    /**
     * Accessor per il nome del livello
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function serviceLevelName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::SERVICE_LEVELS[$this->service_level] ?? $this->service_level
        );
    }

    /**
     * Accessor per verificare se il servizio è disponibile
<<<<<<< HEAD
     *
     * @return Attribute<bool, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function isAvailable(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_active && $this->service_status === 'active'
        );
    }

    /**
     * Accessor per verificare se richiede appuntamento
<<<<<<< HEAD
     *
     * @return Attribute<bool, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function requiresAppointment(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->appointment_required
        );
    }

    /**
     * Accessor per l'URL del servizio
<<<<<<< HEAD
     *
     * @return Attribute<string, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function url(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => route('municipal.services.show', $this->slug)
=======
            get: fn () => FrontofficeUrl::path('/servizi/'.$this->slug)
>>>>>>> 464cfc5 (.)
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
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
>>>>>>> 9e18142 (.)
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
=======
        static::creating(function (MunicipalService $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug((string) $model->name);
>>>>>>> 464cfc5 (.)
            }
        });

        // Assicura unicità dello slug
<<<<<<< HEAD
        static::creating(function (self $model): void {
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
=======
        static::creating(function (MunicipalService $model): void {
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
        static::creating(function (MunicipalService $model): void {
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
            if (is_null($model->service_status)) {
                $model->service_status = 'active';
            }

            if (is_null($model->priority_level)) {
                $model->priority_level = 1;
            }

            if (is_null($model->last_updated)) {
                $model->last_updated = now();
            }
        });
    }
}
