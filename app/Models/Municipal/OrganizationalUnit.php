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
<<<<<<< HEAD
 * @property array<array-key, mixed>|null $office_hours
 * @property bool $is_active
 * @property bool $is_public
 * @property int $position
 * @property array<array-key, mixed>|null $competences
 * @property array<array-key, mixed>|null $services_provided
 * @property array<array-key, mixed>|null $accessibility_info
 * @property array<array-key, mixed>|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
=======
<<<<<<< HEAD
 * @property array|null $office_hours
 * @property bool $is_active
 * @property bool $is_public
 * @property int $position
 * @property array|null $competences
 * @property array|null $services_provided
 * @property array|null $accessibility_info
 * @property array|null $metadata
=======
 * @property array<string, mixed>|null $office_hours
 * @property bool $is_active
 * @property bool $is_public
 * @property int $position
 * @property array<string, mixed>|null $competences
 * @property array<string, mixed>|null $services_provided
 * @property array<string, mixed>|null $accessibility_info
 * @property array<string, mixed>|null $metadata
>>>>>>> 464cfc5 (.)
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
>>>>>>> 9e18142 (.)
 * @property-read self|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $children
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $allChildren
 * @property-read string $type_name
 * @property-read string $hierarchy_path
 * @property-read bool $has_children
 * @property-read int $level
 * @property-read string $url
 */
<<<<<<< HEAD
class OrganizationalUnit extends Model
{
    /** @use HasFactory<Factory<static>> */
    use HasFactory, SoftDeletes;

    /**
=======
class OrganizationalUnit extends MunicipalBaseModel
{
    use SoftDeletes;

    /**
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
>>>>>>> 464cfc5 (.)
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
<<<<<<< HEAD
     * Relazione con l'unità parent
<<<<<<< HEAD
     *
     * @return BelongsTo<static, $this>
=======
=======
     * @return BelongsTo<self, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    /**
<<<<<<< HEAD
     * Relazione con le unità figlie
<<<<<<< HEAD
     *
     * @return HasMany<static, $this>
=======
=======
     * @return HasMany<self, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id')->ordered();
    }

    /**
<<<<<<< HEAD
     * Relazione con tutti i discendenti
<<<<<<< HEAD
     *
     * @return HasMany<static, $this>
=======
=======
     * @return HasMany<self, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function descendants(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id')->with('descendants');
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
     * Relazione con le persone pubbliche
<<<<<<< HEAD
     *
     * @return BelongsToMany<PublicPerson, $this, Pivot, 'pivot'>
=======
=======
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_person_unit')
            ->withPivot(['role', 'start_date', 'end_date', 'is_active'])
            ->withTimestamps();
    }

    /**
     * Relazione con i responsabili attuali
<<<<<<< HEAD
     *
     * @return BelongsToMany<PublicPerson, $this, Pivot, 'pivot'>
=======
<<<<<<< HEAD
=======
     *
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function managers(): BelongsToMany
    {
        return $this->people()
            ->wherePivot('is_active', true)
            ->wherePivot('role', 'like', '%responsabile%')
            ->orWherePivot('role', 'like', '%dirigente%');
    }

    /**
<<<<<<< HEAD
     * Relazione con i servizi erogati
<<<<<<< HEAD
     *
     * @return HasMany<MunicipalService, $this>
=======
=======
     * @return HasMany<MunicipalService, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function services(): HasMany
    {
        return $this->hasMany(MunicipalService::class, 'organizational_unit_id');
    }

    /**
<<<<<<< HEAD
     * Relazione con le location
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
        return $this->belongsToMany(MunicipalLocation::class, 'sixteen_unit_locations');
    }

    /**
<<<<<<< HEAD
     * Scope per unità attive
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeActive(Builder $query): Builder
=======
    public function scopeActive($query)
=======
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità attive
     */
    public function scopeActive(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('is_active', true);
    }

    /**
<<<<<<< HEAD
     * Scope per unità pubbliche
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopePublic(Builder $query): Builder
=======
    public function scopePublic($query)
=======
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità pubbliche
     */
    public function scopePublic(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('is_public', true);
    }

    /**
<<<<<<< HEAD
     * Scope per tipo di unità
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
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per tipo di unità
     */
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('type', $type);
    }

    /**
<<<<<<< HEAD
     * Scope per unità radice (senza parent)
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeRoot(Builder $query): Builder
=======
    public function scopeRoot($query)
=======
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope per unità radice (senza parent)
     */
    public function scopeRoot(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->whereNull('parent_id');
    }

    /**
<<<<<<< HEAD
     * Scope ordinato per posizione
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeOrdered(Builder $query): Builder
=======
    public function scopeOrdered($query)
=======
     * @param  Builder<OrganizationalUnit>  $query
     * @return Builder<OrganizationalUnit>
     * Scope ordinato per posizione
     */
    public function scopeOrdered(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->orderBy('position')->orderBy('name');
    }

    /**
     * Ottiene le competenze formattate
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
    public function getFormattedCompetences(): array
    {
        if (! $this->competences || ! is_array($this->competences)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->competences)
=======
        $formatted = collect($this->competences)
>>>>>>> 464cfc5 (.)
            ->map(function ($competence) {
                if (is_string($competence)) {
                    return ['title' => $competence];
                }

                return $competence;
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
     * Ottiene i servizi forniti formattati
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
    public function getFormattedServices(): array
    {
        if (! $this->services_provided || ! is_array($this->services_provided)) {
            return [];
        }

<<<<<<< HEAD
        return collect($this->services_provided)
=======
        $formatted = collect($this->services_provided)
>>>>>>> 464cfc5 (.)
            ->map(function ($service) {
                if (is_string($service)) {
                    return ['name' => $service];
                }

                return $service;
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
     * Ottiene gli orari di apertura formattati
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

<<<<<<< HEAD
        return collect($days)
=======
        $formatted = collect($days)
>>>>>>> 464cfc5 (.)
            ->mapWithKeys(function ($day) use ($dayNames) {
                $hours = $this->office_hours[$day] ?? null;

                return [$dayNames[$day] => $hours];
            })
            ->filter()
<<<<<<< HEAD
            ->toArray();
=======
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> 464cfc5 (.)
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
<<<<<<< HEAD
            if (! is_array($period)) {
                continue;
            }

            if (isset($period['open'], $period['close'])) {
=======
<<<<<<< HEAD
=======
            if (! is_array($period)) {
                continue;
            }
>>>>>>> 464cfc5 (.)
            if (isset($period['open']) && isset($period['close'])) {
>>>>>>> 9e18142 (.)
                if ($currentTime >= $period['open'] && $currentTime <= $period['close']) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Ottiene tutti gli antenati
     *
     * @return Collection<int, self>
     */
<<<<<<< HEAD
    public function getAncestors(): Collection
    {
<<<<<<< HEAD
        $ancestors = [];
=======
=======
    /** @return Collection<int, self> */
    public function getAncestors(): Collection
    {
        /** @var Collection<int, self> $ancestors */
>>>>>>> 464cfc5 (.)
        $ancestors = collect();
>>>>>>> 9e18142 (.)
        $current = $this->parent;

        while ($current) {
            array_unshift($ancestors, $current);
            $current = $current->parent;
        }

        return new Collection($ancestors);
    }

    /**
     * Ottiene tutti i discendenti (recursivo)
     *
     * @return Collection<int, self>
     */
<<<<<<< HEAD
    public function getAllDescendants(): Collection
    {
<<<<<<< HEAD
        $descendants = [];
=======
=======
    /** @return Collection<int, self> */
    public function getAllDescendants(): Collection
    {
        /** @var Collection<int, self> $descendants */
>>>>>>> 464cfc5 (.)
        $descendants = collect();
>>>>>>> 9e18142 (.)

        foreach ($this->children as $child) {
            $descendants[] = $child;
            $descendants = array_merge($descendants, $child->getAllDescendants()->all());
        }

        return new Collection($descendants);
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
    protected function typeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::TYPES[$this->type] ?? $this->type
        );
    }

    /**
     * Accessor per il percorso gerarchico
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
<<<<<<< HEAD
     *
     * @return Attribute<bool, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function hasChildren(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->children()->exists()
        );
    }

    /**
     * Accessor per il livello gerarchico
<<<<<<< HEAD
     *
     * @return Attribute<int, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<int, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
            get: fn () => route('municipal.organizational-units.show', $this->slug)
=======
            get: fn () => FrontofficeUrl::path('/amministrazione/organizzazione/'.$this->slug)
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

        // Auto-increment position nella stessa categoria
<<<<<<< HEAD
        static::creating(function (self $model): void {
=======
<<<<<<< HEAD
        static::creating(function ($model): void {
>>>>>>> 9e18142 (.)
            if (is_null($model->position)) {
                $maxPosition = static::where('parent_id', $model->parent_id)
                    ->where('type', $model->type)
<<<<<<< HEAD
                    ->max('position');
                $model->position = is_numeric($maxPosition) ? ((int) $maxPosition + 1) : 1;
=======
                    ->max('position') + 1;
=======
        static::creating(function (OrganizationalUnit $model): void {
            if (is_null($model->position)) {
                $model->position = (int) (static::where('parent_id', $model->parent_id)
                    ->where('type', $model->type)->max('position') ?? 0) + 1;
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
            }
        });

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
        static::creating(function (OrganizationalUnit $model): void {
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
        static::creating(function (OrganizationalUnit $model): void {
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });
    }
}
