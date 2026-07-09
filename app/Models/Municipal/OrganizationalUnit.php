<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

use Illuminate\Database\Eloquent\Builder;
use Themes\Sixteen\Support\FrontofficeUrl;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Modello per le unità organizzative
 *
 * Rappresenta uffici, dipartimenti, settori e altre unità organizzative
 * dell'ente secondo l'ontologia AGID
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $short_description
 * @property string $type
 * @property int|null $parent_id
 * @property string|null $code
 * @property string|null $logo
 * @property string|null $image
 * @property string|null $website
 * @property string|null $email
 * @property string|null $pec
 * @property string|null $phone
 * @property string|null $address
 * @property array<string, mixed>|null $office_hours
 * @property bool $is_active
 * @property bool $is_public
 * @property int $position
 * @property array<string, mixed>|null $competences
 * @property array<string, mixed>|null $services_provided
 * @property array<string, mixed>|null $accessibility_info
 * @property array<string, mixed>|null $metadata
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
 * @property-read self|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $children
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $allChildren
 */
class OrganizationalUnit extends MunicipalBaseModel
{
    use SoftDeletes;

    /**
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Tipi di unità organizzative secondo AGID
     */
    public const TYPES = [
        'municipality' => 'Comune',
        'department' => 'Dipartimento',
        'sector' => 'Settore',
        'office' => 'Ufficio',
        'service' => 'Servizio',
        'area' => 'Area',
        'division' => 'Divisione',
        'unit' => 'Unità',
        'committee' => 'Commissione',
        'council' => 'Consiglio',
        'board' => 'Giunta',
        'authority' => 'Autorità',
        'agency' => 'Agenzia',
    ];

    protected $table = 'sixteen_organizational_units';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'type',
        'parent_id',
        'code',
        'logo',
        'image',
        'website',
        'email',
        'pec',
        'phone',
        'address',
        'office_hours',
        'is_active',
        'is_public',
        'position',
        'competences',
        'services_provided',
        'accessibility_info',
        'metadata',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_public' => 'boolean',
        'position' => 'integer',
        'office_hours' => 'json',
        'competences' => 'json',
        'services_provided' => 'json',
        'accessibility_info' => 'json',
        'metadata' => 'json',
    ];

    /**
     * @return BelongsTo<self, $this>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return HasMany<self, $this>
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->ordered();
    }

    /**
     * @return HasMany<self, $this>
     */
    public function descendants(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->with('descendants');
    }

    /**
     * @return MorphMany<ContactPoint, $this>
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
     * @return BelongsToMany<PublicPerson, $this>
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_person_unit')
            ->withPivot(['role', 'start_date', 'end_date', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Relazione con i responsabili attuali
     *
     * @return BelongsToMany<PublicPerson, $this>
     */
    public function managers(): BelongsToMany
    {
        return $this->people()
            ->wherePivot('is_active', true)
            ->wherePivot('role', 'like', '%responsabile%')
            ->orWherePivot('role', 'like', '%dirigente%');
    }

    /**
     * @return HasMany<MunicipalService, $this>
     */
    public function services(): HasMany
    {
        return $this->hasMany(MunicipalService::class, 'organizational_unit_id');
    }

    /**
     * @return BelongsToMany<MunicipalLocation, $this>
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalLocation::class, 'sixteen_unit_locations');
    }

    /**
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità attive
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità pubbliche
     */
    public function scopePublic(Builder $query): Builder
    {
        return $query->where('is_public', true);
    }

    /**
     *
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per tipo di unità
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità radice (senza parent)
     */
    public function scopeRoot(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    /**
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope ordinato per posizione
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('position')->orderBy('name');
    }

    /**
     * Ottiene le competenze formattate
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFormattedCompetences(): array
    {
        if (! $this->competences || ! is_array($this->competences)) {
            return [];
        }

        $formatted = collect($this->competences)
            ->map(function ($competence) {
                if (is_string($competence)) {
                    return ['title' => $competence];
                }

                return $competence;
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
    }

    /**
     * Ottiene i servizi forniti formattati
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFormattedServices(): array
    {
        if (! $this->services_provided || ! is_array($this->services_provided)) {
            return [];
        }

        $formatted = collect($this->services_provided)
            ->map(function ($service) {
                if (is_string($service)) {
                    return ['name' => $service];
                }

                return $service;
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
    }

    /**
     * Ottiene gli orari di apertura formattati
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFormattedOfficeHours(): array
    {
        if (! $this->office_hours || ! is_array($this->office_hours)) {
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

        $formatted = collect($days)
            ->mapWithKeys(function ($day) use ($dayNames) {
                $hours = $this->office_hours[$day] ?? null;

                return [$dayNames[$day] => $hours];
            })
            ->filter()
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
    }

    /**
     * Verifica se l'unità è aperta ora
     */
    public function isOpenNow(): bool
    {
        $now = now();
        $currentDay = strtolower($now->format('l'));
        $currentTime = $now->format('H:i');

        $todayHours = $this->office_hours[$currentDay] ?? null;

        if (! $todayHours || ! is_array($todayHours)) {
            return false;
        }

        foreach ($todayHours as $period) {
            if (! is_array($period)) {
                continue;
            }
            if (isset($period['open']) && isset($period['close'])) {
                if ($currentTime >= $period['open'] && $currentTime <= $period['close']) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Ottiene tutti gli antenati
     */
    /** @return Collection<int, self> */
    public function getAncestors(): Collection
    {
        /** @var Collection<int, self> $ancestors */
        $ancestors = collect();
        $current = $this->parent;

        while ($current) {
            $ancestors->prepend($current);
            $current = $current->parent;
        }

        return $ancestors;
    }

    /**
     * Ottiene tutti i discendenti (recursivo)
     */
    /** @return Collection<int, self> */
    public function getAllDescendants(): Collection
    {
        /** @var Collection<int, self> $descendants */
        $descendants = collect();

        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->getAllDescendants());
        }

        return $descendants;
    }

    /**
     * Verifica se l'unità è antenata di un'altra
     */
    public function isAncestorOf(self $unit): bool
    {
        return $unit->getAncestors()->contains('id', $this->id);
    }

    /**
     * Verifica se l'unità è discendente di un'altra
     */
    public function isDescendantOf(self $unit): bool
    {
        return $this->getAncestors()->contains('id', $unit->id);
    }

    /**
     * Accessor per il nome del tipo
     *
     * @return Attribute<string, never>
     */
    protected function typeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::TYPES[$this->type] ?? $this->type
        );
    }

    /**
     * Accessor per il percorso gerarchico
     *
     * @return Attribute<string, never>
     */
    protected function hierarchyPath(): Attribute
    {
        return Attribute::make(
            get: function () {
                $path = collect([$this->name]);
                $current = $this;

                while ($current->parent) {
                    $current = $current->parent;
                    $path->prepend($current->name);
                }

                return $path->implode(' › ');
            }
        );
    }

    /**
     * Accessor per verificare se ha figli
     *
     * @return Attribute<string, never>
     */
    protected function hasChildren(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->children()->exists()
        );
    }

    /**
     * Accessor per il livello gerarchico
     *
     * @return Attribute<int, never>
     */
    protected function level(): Attribute
    {
        return Attribute::make(
            get: function () {
                $level = 0;
                $current = $this;

                while ($current->parent) {
                    $level++;
                    $current = $current->parent;
                }

                return $level;
            }
        );
    }

    /**
     * Accessor per l'URL dell'unità
     *
     * @return Attribute<string, never>
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => FrontofficeUrl::path('/amministrazione/organizzazione/'.$this->slug)
        );
    }

    /**
     * Mutator per il nome (genera automaticamente lo slug)
     *
     * @return Attribute<mixed, mixed>
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $value = (string) $value;
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

        // Auto-increment position nella stessa categoria
        static::creating(function (OrganizationalUnit $model): void {
            if (is_null($model->position)) {
                $model->position = (int) (static::where('parent_id', $model->parent_id)
                    ->where('type', $model->type)->max('position') ?? 0) + 1;
            }
        });

        // Genera slug se mancante
        static::creating(function (OrganizationalUnit $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug((string) $model->name);
            }
        });

        // Assicura unicità dello slug
        static::creating(function (OrganizationalUnit $model): void {
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });
    }
}
