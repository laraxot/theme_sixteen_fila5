<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Casts\Attribute;
=======
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
>>>>>>> laraxot/dev
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

<<<<<<< HEAD
=======
use function Safe\filesize;
use function Safe\hash_file;

>>>>>>> laraxot/dev
/**
 * Modello per i documenti pubblici (Public Document)
 *
 * Rappresenta atti, delibere, determine, regolamenti
 * e altri documenti ufficiali dell'ente secondo l'ontologia AGID
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $summary
 * @property string $document_type
 * @property string|null $category
 * @property string|null $subcategory
 * @property int|null $organizational_unit_id
 * @property int|null $author_id
 * @property int|null $service_id
 * @property string|null $document_number
 * @property string|null $protocol_number
 * @property string|null $registration_number
 * @property string $document_status
 * @property string $publication_status
 * @property string|null $legal_status
 * @property string|null $classification_code
 * @property string|null $subject_matter
<<<<<<< HEAD
 * @property array|null $keywords
 * @property string|null $language
 * @property \Carbon\Carbon|null $document_date
 * @property \Carbon\Carbon|null $approval_date
 * @property \Carbon\Carbon|null $publication_date
 * @property \Carbon\Carbon|null $effective_date
 * @property \Carbon\Carbon|null $expiry_date
 * @property \Carbon\Carbon|null $review_date
=======
 * @property array<array-key, mixed>|null $keywords
 * @property string|null $language
 * @property Carbon|null $document_date
 * @property Carbon|null $approval_date
 * @property Carbon|null $publication_date
 * @property Carbon|null $effective_date
 * @property Carbon|null $expiry_date
 * @property Carbon|null $review_date
>>>>>>> laraxot/dev
 * @property string|null $file_path
 * @property string|null $file_name
 * @property int|null $file_size
 * @property string|null $file_type
 * @property string|null $file_hash
 * @property string|null $original_format
 * @property string|null $accessible_format
 * @property string|null $signed_version
<<<<<<< HEAD
 * @property array|null $attachments
 * @property array|null $versions
 * @property array|null $related_documents
 * @property array|null $legislative_references
 * @property array|null $administrative_references
=======
 * @property array<array-key, mixed>|null $attachments
 * @property array<array-key, mixed>|null $versions
 * @property array<array-key, mixed>|null $related_documents
 * @property array<array-key, mixed>|null $legislative_references
 * @property array<array-key, mixed>|null $administrative_references
>>>>>>> laraxot/dev
 * @property string|null $transparency_section
 * @property string|null $access_rights
 * @property string $privacy_level
 * @property int|null $retention_period
<<<<<<< HEAD
 * @property \Carbon\Carbon|null $disposal_date
 * @property array|null $digital_signature
 * @property array|null $timestamp
=======
 * @property Carbon|null $disposal_date
 * @property array<array-key, mixed>|null $digital_signature
 * @property array<array-key, mixed>|null $timestamp
>>>>>>> laraxot/dev
 * @property bool $accessibility_compliance
 * @property bool $format_compliance
 * @property bool $metadata_compliance
 * @property int $download_count
<<<<<<< HEAD
 * @property \Carbon\Carbon|null $last_accessed
=======
 * @property Carbon|null $last_accessed
>>>>>>> laraxot/dev
 * @property string|null $checksum
 * @property bool $is_published
 * @property bool $is_active
 * @property bool $is_searchable
 * @property bool $is_downloadable
 * @property bool $requires_authentication
 * @property string $visibility_level
<<<<<<< HEAD
 * @property array|null $metadata
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read PublicPerson|null $author
 * @property-read MunicipalService|null $service
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 */
class PublicDocument extends Model
{
=======
 * @property array<array-key, mixed>|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read PublicPerson|null $author
 * @property-read MunicipalService|null $service
 * @property-read Collection<int, ContactPoint> $contacts
 * @property-read Collection<int, PublicPerson> $people
 * @property-read string $document_type_name
 * @property-read string $document_status_name
 * @property-read string $publication_status_name
 * @property-read string $privacy_level_name
 * @property-read bool $is_expired
 * @property-read bool $is_effective
 * @property-read bool $needs_review
 * @property-read string|null $formatted_file_size
 * @property-read string $url
 * @property-read string|null $download_url
 */
class PublicDocument extends Model
{
    /** @use HasFactory<Factory<self>> */
>>>>>>> laraxot/dev
    use HasFactory, SoftDeletes;

    /**
     * Tipologie di documento secondo AGID
     */
    public const DOCUMENT_TYPES = [
        // Atti normativi
        'statute' => 'Statuto',
        'regulation' => 'Regolamento',
        'ordinance' => 'Ordinanza',
        'directive' => 'Direttiva',

        // Atti amministrativi
        'deliberation' => 'Deliberazione',
        'determination' => 'Determinazione',
        'decree' => 'Decreto',
        'resolution' => 'Risoluzione',
        'circular' => 'Circolare',
        'instruction' => 'Istruzione',

        // Atti di programmazione
        'plan' => 'Piano',
        'program' => 'Programma',
        'budget' => 'Bilancio',
        'report' => 'Relazione',

        // Documenti contrattuali
        'contract' => 'Contratto',
        'agreement' => 'Convenzione',
        'concession' => 'Concessione',
        'authorization' => 'Autorizzazione',
        'permit' => 'Permesso',
        'license' => 'Licenza',

        // Atti di trasparenza
        'transparency_act' => 'Atto di Trasparenza',
        'publication_notice' => 'Avviso di Pubblicazione',
        'selection_notice' => 'Avviso di Selezione',
        'tender_notice' => 'Bando di Gara',

        // Altri documenti
        'form' => 'Modulistica',
        'guide' => 'Guida',
        'manual' => 'Manuale',
        'procedure' => 'Procedura',
        'specification' => 'Capitolato',
        'minutes' => 'Verbale',
        'opinion' => 'Parere',
        'certificate' => 'Certificato',
        'other' => 'Altro',
    ];

    /**
     * Stati del documento
     */
    public const DOCUMENT_STATUSES = [
        'draft' => 'Bozza',
        'review' => 'In Revisione',
        'approved' => 'Approvato',
        'published' => 'Pubblicato',
        'effective' => 'In Vigore',
        'suspended' => 'Sospeso',
        'revoked' => 'Revocato',
        'expired' => 'Scaduto',
        'archived' => 'Archiviato',
    ];

    /**
     * Stati di pubblicazione
     */
    public const PUBLICATION_STATUSES = [
        'unpublished' => 'Non Pubblicato',
        'scheduled' => 'Programmato',
        'published' => 'Pubblicato',
        'updated' => 'Aggiornato',
        'withdrawn' => 'Ritirato',
    ];

    /**
     * Livelli di privacy secondo GDPR
     */
    public const PRIVACY_LEVELS = [
        'public' => 'Pubblico',
        'restricted' => 'Accesso Limitato',
        'confidential' => 'Riservato',
        'classified' => 'Classificato',
        'personal_data' => 'Dati Personali',
        'sensitive_data' => 'Dati Sensibili',
    ];

    /**
     * Sezioni di Amministrazione Trasparente
     */
    public const TRANSPARENCY_SECTIONS = [
        'organization' => 'Organizzazione',
        'consulting' => 'Consulenti e Collaboratori',
        'personnel' => 'Personale',
        'performance' => 'Performance',
        'public_procurement' => 'Bandi di Gara e Contratti',
        'grants' => 'Sovvenzioni, Contributi, Sussidi',
        'budgets' => 'Bilanci',
        'assets' => 'Beni Immobili e Gestione Patrimonio',
        'services' => 'Servizi Erogati',
        'public_works' => 'Opere Pubbliche',
        'urban_planning' => 'Pianificazione e Governo del Territorio',
        'environmental_info' => 'Informazioni Ambientali',
        'social_interventions' => 'Interventi Straordinari e di Emergenza',
        'other' => 'Altri Contenuti',
    ];

    protected $table = 'sixteen_public_documents';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'summary',
        'document_type',
        'category',
        'subcategory',
        'organizational_unit_id',
        'author_id',
        'service_id',
        'document_number',
        'protocol_number',
        'registration_number',
        'document_status',
        'publication_status',
        'legal_status',
        'classification_code',
        'subject_matter',
        'keywords',
        'language',
        'document_date',
        'approval_date',
        'publication_date',
        'effective_date',
        'expiry_date',
        'review_date',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'file_hash',
        'original_format',
        'accessible_format',
        'signed_version',
        'attachments',
        'versions',
        'related_documents',
        'legislative_references',
        'administrative_references',
        'transparency_section',
        'access_rights',
        'privacy_level',
        'retention_period',
        'disposal_date',
        'digital_signature',
        'timestamp',
        'accessibility_compliance',
        'format_compliance',
        'metadata_compliance',
        'download_count',
        'last_accessed',
        'checksum',
        'is_published',
        'is_active',
        'is_searchable',
        'is_downloadable',
        'requires_authentication',
        'visibility_level',
        'metadata',
    ];

<<<<<<< HEAD
    protected $casts = [
        'document_date' => 'date',
        'approval_date' => 'date',
        'publication_date' => 'date',
        'effective_date' => 'date',
        'expiry_date' => 'date',
        'review_date' => 'date',
        'disposal_date' => 'date',
        'last_accessed' => 'datetime',
        'file_size' => 'integer',
        'download_count' => 'integer',
        'retention_period' => 'integer',
        'is_published' => 'boolean',
        'is_active' => 'boolean',
        'is_searchable' => 'boolean',
        'is_downloadable' => 'boolean',
        'requires_authentication' => 'boolean',
        'accessibility_compliance' => 'boolean',
        'format_compliance' => 'boolean',
        'metadata_compliance' => 'boolean',
        'keywords' => 'json',
        'attachments' => 'json',
        'versions' => 'json',
        'related_documents' => 'json',
        'legislative_references' => 'json',
        'administrative_references' => 'json',
        'access_rights' => 'json',
        'digital_signature' => 'json',
        'timestamp' => 'json',
        'metadata' => 'json',
    ];

    /**
     * Relazione con l'unità organizzativa
=======
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'document_date' => 'date',
            'approval_date' => 'date',
            'publication_date' => 'date',
            'effective_date' => 'date',
            'expiry_date' => 'date',
            'review_date' => 'date',
            'disposal_date' => 'date',
            'last_accessed' => 'datetime',
            'file_size' => 'integer',
            'download_count' => 'integer',
            'retention_period' => 'integer',
            'is_published' => 'boolean',
            'is_active' => 'boolean',
            'is_searchable' => 'boolean',
            'is_downloadable' => 'boolean',
            'requires_authentication' => 'boolean',
            'accessibility_compliance' => 'boolean',
            'format_compliance' => 'boolean',
            'metadata_compliance' => 'boolean',
            'keywords' => 'json',
            'attachments' => 'json',
            'versions' => 'json',
            'related_documents' => 'json',
            'legislative_references' => 'json',
            'administrative_references' => 'json',
            'access_rights' => 'json',
            'digital_signature' => 'json',
            'timestamp' => 'json',
            'metadata' => 'json',
        ];
    }

    /**
     * Relazione con l'unità organizzativa
     *
     * @return BelongsTo<OrganizationalUnit, $this>
>>>>>>> laraxot/dev
     */
    public function organizationalUnit(): BelongsTo
    {
        return $this->belongsTo(OrganizationalUnit::class);
    }

    /**
     * Relazione con l'autore
<<<<<<< HEAD
=======
     *
     * @return BelongsTo<PublicPerson, $this>
>>>>>>> laraxot/dev
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(PublicPerson::class, 'author_id');
    }

    /**
     * Relazione con il servizio correlato
<<<<<<< HEAD
=======
     *
     * @return BelongsTo<MunicipalService, $this>
>>>>>>> laraxot/dev
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(MunicipalService::class, 'service_id');
    }

    /**
     * Relazione con i punti di contatto
<<<<<<< HEAD
=======
     *
     * @return MorphMany<ContactPoint, $this>
>>>>>>> laraxot/dev
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
     * Relazione con le persone correlate
<<<<<<< HEAD
=======
     *
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> laraxot/dev
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_document_people')
            ->withPivot(['role', 'order'])
            ->withTimestamps()
            ->orderBy('pivot_order');
    }

    /**
     * Scope per documenti pubblicati
<<<<<<< HEAD
     */
    public function scopePublished($query)
=======
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopePublished(Builder $query): Builder
>>>>>>> laraxot/dev
    {
        return $query->where('is_published', true)
            ->where('publication_date', '<=', now())
            ->where('document_status', 'published');
    }

    /**
     * Scope per documenti attivi
<<<<<<< HEAD
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q): void {
=======
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $q): void {
>>>>>>> laraxot/dev
                $q->whereNull('expiry_date')
                    ->orWhere('expiry_date', '>', now());
            });
    }

    /**
     * Scope per documenti ricercabili
<<<<<<< HEAD
     */
    public function scopeSearchable($query)
=======
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeSearchable(Builder $query): Builder
>>>>>>> laraxot/dev
    {
        return $query->where('is_searchable', true);
    }

    /**
     * Scope per tipologia di documento
<<<<<<< HEAD
     */
    public function scopeOfType($query, string $type)
=======
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> laraxot/dev
    {
        return $query->where('document_type', $type);
    }

    /**
     * Scope per sezione di trasparenza
<<<<<<< HEAD
     */
    public function scopeInTransparencySection($query, string $section)
=======
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeInTransparencySection(Builder $query, string $section): Builder
>>>>>>> laraxot/dev
    {
        return $query->where('transparency_section', $section);
    }

    /**
     * Scope per documenti in vigore
<<<<<<< HEAD
     */
    public function scopeEffective($query)
    {
        return $query->where('document_status', 'effective')
            ->where(function ($q): void {
=======
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeEffective(Builder $query): Builder
    {
        return $query->where('document_status', 'effective')
            ->where(function (Builder $q): void {
>>>>>>> laraxot/dev
                $q->whereNull('effective_date')
                    ->orWhere('effective_date', '<=', now());
            });
    }

    /**
     * Scope ordinati per data
<<<<<<< HEAD
     */
    public function scopeOrdered($query, string $field = 'document_date', string $direction = 'desc')
=======
     *
     * @param  Builder<static>  $query
     * @param  'asc'|'desc'  $direction
     * @return Builder<static>
     */
    public function scopeOrdered(Builder $query, string $field = 'document_date', string $direction = 'desc'): Builder
>>>>>>> laraxot/dev
    {
        return $query->orderBy($field, $direction);
    }

    /**
     * Ottiene le parole chiave formattate
<<<<<<< HEAD
     */
    public function getFormattedKeywords(): array
    {
        if (! $this->keywords || ! is_array($this->keywords)) {
            return [];
        }

        return collect($this->keywords)
            ->map(function ($keyword) {
=======
     *
     * @return array<int|string, mixed>
     */
    public function getFormattedKeywords(): array
    {
        $keywords = $this->keywords;

        if (! is_array($keywords)) {
            return [];
        }

        return collect($keywords)
            ->map(function (mixed $keyword): mixed {
>>>>>>> laraxot/dev
                return is_string($keyword) ? ['name' => $keyword, 'slug' => Str::slug($keyword)] : $keyword;
            })
            ->toArray();
    }

    /**
     * Ottiene gli allegati formattati
<<<<<<< HEAD
     */
    public function getFormattedAttachments(): array
    {
        if (! $this->attachments || ! is_array($this->attachments)) {
            return [];
        }

        return collect($this->attachments)
            ->map(function ($attachment) {
=======
     *
     * @return array<int|string, mixed>
     */
    public function getFormattedAttachments(): array
    {
        $attachments = $this->attachments;

        if (! is_array($attachments)) {
            return [];
        }

        return collect($attachments)
            ->map(function (mixed $attachment): mixed {
>>>>>>> laraxot/dev
                if (is_string($attachment)) {
                    return [
                        'path' => $attachment,
                        'name' => basename($attachment),
                        'url' => asset('storage/'.$attachment),
                        'type' => pathinfo($attachment, PATHINFO_EXTENSION),
                    ];
                }

<<<<<<< HEAD
                return array_merge([
                    'url' => isset($attachment['path']) ? asset('storage/'.$attachment['path']) : null,
=======
                if (! is_array($attachment)) {
                    return $attachment;
                }

                $path = $attachment['path'] ?? null;

                return array_merge([
                    'url' => is_string($path) ? asset('storage/'.$path) : null,
>>>>>>> laraxot/dev
                ], $attachment);
            })
            ->toArray();
    }

    /**
     * Ottiene le versioni del documento
<<<<<<< HEAD
     */
    public function getFormattedVersions(): array
    {
        if (! $this->versions || ! is_array($this->versions)) {
            return [];
        }

        return collect($this->versions)
            ->map(function ($version, $index) {
                return array_merge([
                    'version' => $index + 1,
=======
     *
     * @return array<int|string, mixed>
     */
    public function getFormattedVersions(): array
    {
        $versions = $this->versions;

        if (! is_array($versions)) {
            return [];
        }

        return collect($versions)
            ->map(function (mixed $version, int|string $index): array {
                return array_merge([
                    'version' => (is_int($index) ? $index : 0) + 1,
>>>>>>> laraxot/dev
                    'date' => null,
                    'changes' => null,
                    'file' => null,
                ], is_array($version) ? $version : ['file' => $version]);
            })
            ->sortByDesc('version')
            ->values()
            ->toArray();
    }

    /**
     * Ottiene i riferimenti normativi formattati
<<<<<<< HEAD
     */
    public function getFormattedLegislativeReferences(): array
    {
        if (! $this->legislative_references || ! is_array($this->legislative_references)) {
            return [];
        }

        return collect($this->legislative_references)
            ->map(function ($reference) {
=======
     *
     * @return array<int|string, mixed>
     */
    public function getFormattedLegislativeReferences(): array
    {
        $references = $this->legislative_references;

        if (! is_array($references)) {
            return [];
        }

        return collect($references)
            ->map(function (mixed $reference): mixed {
>>>>>>> laraxot/dev
                if (is_string($reference)) {
                    return ['title' => $reference];
                }

                return $reference;
            })
            ->toArray();
    }

    /**
     * Incrementa il contatore di download
     */
    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
        $this->update(['last_accessed' => now()]);
    }

    /**
     * Verifica se è accessibile al pubblico
     */
    public function isPubliclyAccessible(): bool
    {
        return $this->is_published &&
               $this->visibility_level === 'public' &&
               $this->privacy_level === 'public' &&
               ! $this->requires_authentication;
    }

    /**
     * Verifica l'integrità del file
     */
    public function verifyFileIntegrity(): bool
    {
        if (! $this->file_path || ! $this->checksum) {
            return false;
        }

        $filePath = storage_path('app/'.$this->file_path);

        if (! file_exists($filePath)) {
            return false;
        }

        return hash_file('sha256', $filePath) === $this->checksum;
    }

    /**
     * Verifica la compliance AGID
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> laraxot/dev
     */
    public function checkAgidCompliance(): array
    {
        $compliance = [
            'accessibility' => $this->accessibility_compliance,
            'format' => $this->format_compliance,
            'metadata' => $this->metadata_compliance,
            'overall' => false,
        ];

        // Verifica requisiti AGID
        $requirements = [
            'has_title' => ! empty($this->title),
            'has_description' => ! empty($this->description),
            'has_date' => ! empty($this->document_date),
            'has_author' => ! empty($this->author_id),
            'has_classification' => ! empty($this->classification_code),
            'has_keywords' => ! empty($this->keywords),
            'accessible_format' => ! empty($this->accessible_format),
            'digital_signature' => ! empty($this->digital_signature),
        ];

        $compliance['requirements'] = $requirements;
        $compliance['score'] = count(array_filter($requirements)) / count($requirements) * 100;
        $compliance['overall'] = $compliance['score'] >= 80;

        return $compliance;
    }

    /**
<<<<<<< HEAD
     * Ottiene i dati strutturati per SEO
     */
    public function getStructuredData(): array
    {
=======
     * Ottiene il nome completo dell'autore, se presente
     */
    protected function authorFullName(): ?string
    {
        if ($this->author === null) {
            return null;
        }

        return trim($this->author->first_name.' '.$this->author->last_name);
    }

    /**
     * Ottiene i dati strutturati per SEO
     *
     * @return array<string, mixed>
     */
    public function getStructuredData(): array
    {
        $keywords = $this->keywords;
        $keywordNames = is_array($keywords)
            ? array_map(static fn (mixed $keyword): string => is_array($keyword) && is_string($keyword['name'] ?? null) ? $keyword['name'] : (is_scalar($keyword) ? (string) $keyword : ''), $keywords)
            : [];

>>>>>>> laraxot/dev
        return [
            '@context' => 'https://schema.org',
            '@type' => 'DigitalDocument',
            'name' => $this->title,
            'description' => $this->description,
            'dateCreated' => $this->document_date?->toISOString(),
            'datePublished' => $this->publication_date?->toISOString(),
<<<<<<< HEAD
            'dateModified' => $this->updated_at->toISOString(),
            'author' => [
                '@type' => 'Person',
                'name' => $this->author?->full_name,
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $this->organizationalUnit?->name ?? 'Comune',
            ],
            'encodingFormat' => $this->file_type,
            'contentSize' => $this->formatted_file_size,
            'keywords' => is_array($this->keywords) ? implode(', ', array_column($this->keywords, 'name')) : null,
=======
            'dateModified' => $this->updated_at?->toISOString(),
            'author' => [
                '@type' => 'Person',
                'name' => $this->authorFullName(),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $this->organizationalUnit?->getAttribute('name') ?? 'Comune',
            ],
            'encodingFormat' => $this->file_type,
            'contentSize' => $this->formatted_file_size,
            'keywords' => $keywordNames !== [] ? implode(', ', $keywordNames) : null,
>>>>>>> laraxot/dev
            'inLanguage' => $this->language ?? 'it',
            'isAccessibleForFree' => true,
            'license' => 'https://creativecommons.org/licenses/by/4.0/',
        ];
    }

    /**
     * Ottiene le informazioni complete del documento
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> laraxot/dev
     */
    public function getDocumentDetails(): array
    {
        return [
            'basic_info' => [
                'title' => $this->title,
                'description' => $this->description,
                'type' => $this->document_type_name,
                'category' => $this->category,
                'status' => $this->document_status_name,
                'document_number' => $this->document_number,
                'protocol_number' => $this->protocol_number,
            ],
            'dates' => [
                'document_date' => $this->document_date,
                'approval_date' => $this->approval_date,
                'publication_date' => $this->publication_date,
                'effective_date' => $this->effective_date,
                'expiry_date' => $this->expiry_date,
                'is_effective' => $this->is_effective,
                'is_expired' => $this->is_expired,
            ],
            'file_info' => [
                'file_name' => $this->file_name,
                'file_type' => $this->file_type,
                'file_size' => $this->formatted_file_size,
                'download_url' => $this->download_url,
                'accessible_format' => $this->accessible_format,
                'download_count' => $this->download_count,
            ],
            'classification' => [
                'classification_code' => $this->classification_code,
                'transparency_section' => $this->transparency_section,
                'privacy_level' => $this->privacy_level_name,
                'keywords' => $this->getFormattedKeywords(),
            ],
            'relationships' => [
<<<<<<< HEAD
                'author' => $this->author?->full_name,
                'organizational_unit' => $this->organizationalUnit?->name,
                'service' => $this->service?->name,
=======
                'author' => $this->authorFullName(),
                'organizational_unit' => $this->organizationalUnit?->getAttribute('name'),
                'service' => $this->service?->getAttribute('name'),
>>>>>>> laraxot/dev
                'attachments' => $this->getFormattedAttachments(),
                'versions' => $this->getFormattedVersions(),
            ],
            'compliance' => $this->checkAgidCompliance(),
        ];
    }

    /**
     * Accessor per il nome del tipo di documento
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> laraxot/dev
     */
    protected function documentTypeName(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => self::DOCUMENT_TYPES[$this->document_type] ?? $this->document_type
=======
            get: fn (): string => self::DOCUMENT_TYPES[$this->document_type] ?? $this->document_type
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per il nome dello stato
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> laraxot/dev
     */
    protected function documentStatusName(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => self::DOCUMENT_STATUSES[$this->document_status] ?? $this->document_status
=======
            get: fn (): string => self::DOCUMENT_STATUSES[$this->document_status] ?? $this->document_status
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per il nome dello stato di pubblicazione
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> laraxot/dev
     */
    protected function publicationStatusName(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => self::PUBLICATION_STATUSES[$this->publication_status] ?? $this->publication_status
=======
            get: fn (): string => self::PUBLICATION_STATUSES[$this->publication_status] ?? $this->publication_status
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per il nome del livello di privacy
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> laraxot/dev
     */
    protected function privacyLevelName(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => self::PRIVACY_LEVELS[$this->privacy_level] ?? $this->privacy_level
=======
            get: fn (): string => self::PRIVACY_LEVELS[$this->privacy_level] ?? $this->privacy_level
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per verificare se è scaduto
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> laraxot/dev
     */
    protected function isExpired(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => $this->expiry_date && $this->expiry_date->isPast()
=======
            get: fn (): bool => (bool) ($this->expiry_date && $this->expiry_date->isPast())
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per verificare se è in vigore
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> laraxot/dev
     */
    protected function isEffective(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: function () {
=======
            get: function (): bool {
>>>>>>> laraxot/dev
                if ($this->document_status !== 'effective') {
                    return false;
                }

                if ($this->effective_date && $this->effective_date->isFuture()) {
                    return false;
                }

                if ($this->is_expired) {
                    return false;
                }

                return true;
            }
        );
    }

    /**
     * Accessor per verificare se necessita revisione
<<<<<<< HEAD
=======
     *
     * @return Attribute<bool, never>
>>>>>>> laraxot/dev
     */
    protected function needsReview(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => $this->review_date && $this->review_date->isPast()
=======
            get: fn (): bool => (bool) ($this->review_date && $this->review_date->isPast())
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per la dimensione del file formattata
<<<<<<< HEAD
=======
     *
     * @return Attribute<string|null, never>
>>>>>>> laraxot/dev
     */
    protected function formattedFileSize(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: function (): void {
                if (! $this->file_size) {
                    return;
=======
            get: function (): ?string {
                if (! $this->file_size) {
                    return null;
>>>>>>> laraxot/dev
                }

                $units = ['B', 'KB', 'MB', 'GB'];
                $size = $this->file_size;
                $unit = 0;

                while ($size >= 1024 && $unit < count($units) - 1) {
                    $size /= 1024;
                    $unit++;
                }

                return round($size, 2).' '.$units[$unit];
            }
        );
    }

    /**
     * Accessor per l'URL del documento
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, never>
>>>>>>> laraxot/dev
     */
    protected function url(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => route('municipal.documents.show', $this->slug)
=======
            get: fn (): string => route('municipal.documents.show', $this->slug)
>>>>>>> laraxot/dev
        );
    }

    /**
     * Accessor per l'URL di download
<<<<<<< HEAD
=======
     *
     * @return Attribute<string|null, never>
>>>>>>> laraxot/dev
     */
    protected function downloadUrl(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            get: fn () => $this->file_path ? route('municipal.documents.download', $this->id) : null
=======
            get: fn (): ?string => $this->file_path ? route('municipal.documents.download', $this->id) : null
>>>>>>> laraxot/dev
        );
    }

    /**
     * Mutator per il titolo (genera automaticamente lo slug)
<<<<<<< HEAD
=======
     *
     * @return Attribute<string, string>
>>>>>>> laraxot/dev
     */
    protected function title(): Attribute
    {
        return Attribute::make(
<<<<<<< HEAD
            set: function ($value) {
=======
            set: function (string $value): string {
>>>>>>> laraxot/dev
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
=======
        static::creating(function (self $model): void {
>>>>>>> laraxot/dev
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });

        // Assicura unicità dello slug
<<<<<<< HEAD
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
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
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> laraxot/dev
            if (is_null($model->document_status)) {
                $model->document_status = 'draft';
            }

            if (is_null($model->publication_status)) {
                $model->publication_status = 'unpublished';
            }

            if (is_null($model->privacy_level)) {
                $model->privacy_level = 'public';
            }

            if (is_null($model->language)) {
                $model->language = 'it';
            }

            if (is_null($model->visibility_level)) {
                $model->visibility_level = 'public';
            }
        });

        // Calcola checksum del file se presente
<<<<<<< HEAD
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> laraxot/dev
            if ($model->file_path && empty($model->checksum)) {
                $filePath = storage_path('app/'.$model->file_path);
                if (file_exists($filePath)) {
                    $model->checksum = hash_file('sha256', $filePath);
                    $model->file_size = filesize($filePath);
                }
            }
        });
    }
}
