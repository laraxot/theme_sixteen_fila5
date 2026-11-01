<?php

declare(strict_types=1);

namespace Themes\Sixteen\Models\Municipal;

<<<<<<< .merge_file_ja8Qyi
=======
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
>>>>>>> .merge_file_DzQp7C
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Themes\Sixteen\Enums\MunicipalNewsPriorityEnum;
use Themes\Sixteen\Enums\MunicipalNewsStatusEnum;
use Themes\Sixteen\Enums\MunicipalNewsTypeEnum;
use Themes\Sixteen\Enums\MunicipalNewsUrgencyEnum;

/**
 * Modello per le notizie comunali (Municipal News)
 *
 * Rappresenta notizie, comunicati stampa, avvisi pubblici
 * e altre comunicazioni dell'ente secondo l'ontologia AGID
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string|null $subtitle
 * @property string|null $content
 * @property string|null $excerpt
 * @property string $news_type
 * @property string|null $category
 * @property string|null $subcategory
 * @property int|null $organizational_unit_id
 * @property int|null $author_id
 * @property int|null $editor_id
 * @property string|null $source
 * @property string $news_status
 * @property string $visibility
<<<<<<< .merge_file_ja8Qyi
 * @property int $priority_level
 * @property int $urgency_level
 * @property array|null $target_audience
 * @property array|null $geographic_scope
=======
 * @property int|null $priority_level
 * @property int|null $urgency_level
 * @property array<array-key, mixed>|null $target_audience
 * @property array<array-key, mixed>|null $geographic_scope
>>>>>>> .merge_file_DzQp7C
 * @property string|null $language
 * @property string|null $featured_image
 * @property string|null $image_caption
 * @property string|null $image_alt_text
<<<<<<< .merge_file_ja8Qyi
 * @property array|null $gallery
 * @property array|null $attachments
 * @property array|null $related_services
 * @property array|null $related_events
 * @property array|null $related_people
 * @property array|null $related_documents
 * @property array|null $external_links
 * @property array|null $tags
 * @property string|null $social_summary
 * @property string|null $meta_description
 * @property array|null $seo_keywords
 * @property \Carbon\Carbon|null $publication_date
 * @property \Carbon\Carbon|null $expiry_date
 * @property \Carbon\Carbon|null $last_modified
=======
 * @property array<int, mixed>|null $gallery
 * @property array<int, mixed>|null $attachments
 * @property array<array-key, mixed>|null $related_services
 * @property array<array-key, mixed>|null $related_events
 * @property array<array-key, mixed>|null $related_people
 * @property array<array-key, mixed>|null $related_documents
 * @property array<int, mixed>|null $external_links
 * @property array<int, mixed>|null $tags
 * @property string|null $social_summary
 * @property string|null $meta_description
 * @property array<int, mixed>|null $seo_keywords
 * @property Carbon|null $publication_date
 * @property Carbon|null $expiry_date
 * @property Carbon|null $last_modified
>>>>>>> .merge_file_DzQp7C
 * @property int $revision_number
 * @property bool $is_published
 * @property bool $is_featured
 * @property bool $is_breaking
 * @property bool $is_archived
 * @property bool $show_on_homepage
 * @property bool $allow_comments
 * @property int $view_count
 * @property int $share_count
 * @property int $reading_time
<<<<<<< .merge_file_ja8Qyi
 * @property array|null $accessibility_notes
 * @property string|null $feedback_url
 * @property string|null $correction_notice
 * @property array|null $translation_links
 * @property array|null $structured_data
 * @property array|null $metadata
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
=======
 * @property array<array-key, mixed>|null $accessibility_notes
 * @property string|null $feedback_url
 * @property string|null $correction_notice
 * @property array<array-key, mixed>|null $translation_links
 * @property array<array-key, mixed>|null $structured_data
 * @property array<array-key, mixed>|null $metadata
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read string $news_type_name
 * @property-read string $news_status_name
 * @property-read string $priority_name
 * @property-read string $urgency_name
 * @property-read bool $is_expired
 * @property-read bool $is_current
 * @property-read int|null $age_in_days
 * @property-read bool $is_fresh
 * @property-read int $estimated_reading_time
 * @property-read string $url
 * @property-read string|null $featured_image_url
>>>>>>> .merge_file_DzQp7C
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read PublicPerson|null $author
 * @property-read PublicPerson|null $editor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ContactPoint> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $categories
 * @property-read \Illuminate\Database\Eloquent\Collection<int, self> $tags
 */
class MunicipalNews extends Model
{
    use HasFactory, SoftDeletes;

<<<<<<< .merge_file_ja8Qyi
    /**
     * Tipologie di notizia secondo AGID
     */
    public const NEWS_TYPES = [
        'news' => 'Notizia',
        'press_release' => 'Comunicato Stampa',
        'public_notice' => 'Avviso Pubblico',
        'announcement' => 'Annuncio',
        'alert' => 'Allerta',
        'service_update' => 'Aggiornamento Servizi',
        'regulation_update' => 'Aggiornamento Normativo',
        'event_announcement' => 'Annuncio Eventi',
        'tender_notice' => 'Bando/Gara',
        'job_posting' => 'Offerta Lavoro',
        'council_update' => 'Aggiornamento Consiglio',
        'mayor_message' => 'Messaggio del Sindaco',
        'citizen_info' => 'Informazione ai Cittadini',
        'emergency' => 'Emergenza',
        'other' => 'Altro',
    ];

    /**
     * Stati della notizia
     */
    public const NEWS_STATUSES = [
        'draft' => 'Bozza',
        'review' => 'In Revisione',
        'approved' => 'Approvata',
        'published' => 'Pubblicata',
        'archived' => 'Archiviata',
        'expired' => 'Scaduta',
        'retracted' => 'Ritirata',
    ];

    /**
     * Livelli di priorità
     */
    public const PRIORITY_LEVELS = [
        1 => 'Bassa',
        2 => 'Normale',
        3 => 'Alta',
        4 => 'Urgente',
        5 => 'Critica',
    ];

    /**
     * Livelli di urgenza
     */
    public const URGENCY_LEVELS = [
        1 => 'Non Urgente',
        2 => 'Normale',
        3 => 'Urgente',
        4 => 'Molto Urgente',
        5 => 'Emergenza',
    ];

    /**
     * Ambiti geografici
     */
    public const GEOGRAPHIC_SCOPES = [
        'municipal' => 'Comunale',
        'district' => 'Quartiere/Circoscrizione',
        'regional' => 'Regionale',
        'national' => 'Nazionale',
        'european' => 'Europeo',
        'international' => 'Internazionale',
    ];

=======
>>>>>>> .merge_file_DzQp7C
    protected $table = 'sixteen_municipal_news';

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'content',
        'excerpt',
        'news_type',
        'category',
        'subcategory',
        'organizational_unit_id',
        'author_id',
        'editor_id',
        'source',
        'news_status',
        'visibility',
        'priority_level',
        'urgency_level',
        'target_audience',
        'geographic_scope',
        'language',
        'featured_image',
        'image_caption',
        'image_alt_text',
        'gallery',
        'attachments',
        'related_services',
        'related_events',
        'related_people',
        'related_documents',
        'external_links',
        'tags',
        'social_summary',
        'meta_description',
        'seo_keywords',
        'publication_date',
        'expiry_date',
        'last_modified',
        'revision_number',
        'is_published',
        'is_featured',
        'is_breaking',
        'is_archived',
        'show_on_homepage',
        'allow_comments',
        'view_count',
        'share_count',
        'reading_time',
        'accessibility_notes',
        'feedback_url',
        'correction_notice',
        'translation_links',
        'structured_data',
        'metadata',
    ];

    protected $casts = [
        'publication_date' => 'datetime',
        'expiry_date' => 'datetime',
        'last_modified' => 'datetime',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'is_breaking' => 'boolean',
        'is_archived' => 'boolean',
        'show_on_homepage' => 'boolean',
        'allow_comments' => 'boolean',
        'priority_level' => 'integer',
        'urgency_level' => 'integer',
        'view_count' => 'integer',
        'share_count' => 'integer',
        'reading_time' => 'integer',
        'revision_number' => 'integer',
        'target_audience' => 'json',
        'geographic_scope' => 'json',
        'gallery' => 'json',
        'attachments' => 'json',
        'related_services' => 'json',
        'related_events' => 'json',
        'related_people' => 'json',
        'related_documents' => 'json',
        'external_links' => 'json',
        'tags' => 'json',
        'seo_keywords' => 'json',
        'accessibility_notes' => 'json',
        'translation_links' => 'json',
        'structured_data' => 'json',
        'metadata' => 'json',
    ];

    /**
     * Relazione con l'unità organizzativa
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return BelongsTo<OrganizationalUnit, $this>
>>>>>>> .merge_file_DzQp7C
     */
    public function organizationalUnit(): BelongsTo
    {
        return $this->belongsTo(OrganizationalUnit::class);
    }

    /**
     * Relazione con l'autore
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return BelongsTo<PublicPerson, $this>
>>>>>>> .merge_file_DzQp7C
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(PublicPerson::class, 'author_id');
    }

    /**
     * Relazione con l'editor
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return BelongsTo<PublicPerson, $this>
>>>>>>> .merge_file_DzQp7C
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(PublicPerson::class, 'editor_id');
    }

    /**
     * Relazione con i punti di contatto
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return MorphMany<ContactPoint, $this>
>>>>>>> .merge_file_DzQp7C
     */
    public function contacts(): MorphMany
    {
        return $this->morphMany(ContactPoint::class, 'contactable')->ordered();
    }

    /**
     * Relazione con i servizi correlati
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return BelongsToMany<MunicipalService, $this>
>>>>>>> .merge_file_DzQp7C
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalService::class, 'sixteen_news_services');
    }

    /**
     * Relazione con gli eventi correlati
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return BelongsToMany<MunicipalEvent, $this>
>>>>>>> .merge_file_DzQp7C
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalEvent::class, 'sixteen_news_events');
    }

    /**
     * Relazione con le persone correlate
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> .merge_file_DzQp7C
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_news_people');
    }

    /**
     * Scope per notizie pubblicate
     */
<<<<<<< .merge_file_ja8Qyi
    public function scopePublished($query)
=======
    public function scopePublished(Builder $query): Builder
>>>>>>> .merge_file_DzQp7C
    {
        return $query->where('is_published', true)
            ->where('news_status', 'published')
            ->where('publication_date', '<=', now())
            ->where(function ($q): void {
                $q->whereNull('expiry_date')
                    ->orWhere('expiry_date', '>', now());
            });
    }

    /**
     * Scope per notizie in evidenza
     */
<<<<<<< .merge_file_ja8Qyi
    public function scopeFeatured($query)
=======
    public function scopeFeatured(Builder $query): Builder
>>>>>>> .merge_file_DzQp7C
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope per notizie breaking
     */
<<<<<<< .merge_file_ja8Qyi
    public function scopeBreaking($query)
=======
    public function scopeBreaking(Builder $query): Builder
>>>>>>> .merge_file_DzQp7C
    {
        return $query->where('is_breaking', true);
    }

    /**
     * Scope per notizie da homepage
     */
<<<<<<< .merge_file_ja8Qyi
    public function scopeHomepage($query)
=======
    public function scopeHomepage(Builder $query): Builder
>>>>>>> .merge_file_DzQp7C
    {
        return $query->where('show_on_homepage', true);
    }

    /**
     * Scope per tipologia di notizia
     */
<<<<<<< .merge_file_ja8Qyi
    public function scopeOfType($query, string $type)
=======
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> .merge_file_DzQp7C
    {
        return $query->where('news_type', $type);
    }

    /**
     * Scope per categoria
     */
<<<<<<< .merge_file_ja8Qyi
    public function scopeInCategory($query, string $category)
=======
    public function scopeInCategory(Builder $query, string $category): Builder
>>>>>>> .merge_file_DzQp7C
    {
        return $query->where('category', $category);
    }

    /**
     * Scope per priorità minima
     */
<<<<<<< .merge_file_ja8Qyi
    public function scopeMinPriority($query, int $priority)
=======
    public function scopeMinPriority(Builder $query, int $priority): Builder
>>>>>>> .merge_file_DzQp7C
    {
        return $query->where('priority_level', '>=', $priority);
    }

    /**
     * Scope per notizie recenti
     */
<<<<<<< .merge_file_ja8Qyi
    public function scopeRecent($query, int $days = 30)
=======
    public function scopeRecent(Builder $query, int $days = 30): Builder
>>>>>>> .merge_file_DzQp7C
    {
        return $query->where('publication_date', '>=', now()->subDays($days));
    }

    /**
     * Scope ordinati per pubblicazione
     */
    public function scopeOrdered($query, string $direction = 'desc')
    {
        return $query->orderBy('publication_date', $direction)
            ->orderBy('priority_level', 'desc');
    }

    /**
     * Ottiene l'excerpt con fallback al contenuto
     */
    public function getExcerptFormatted(int $length = 200): string
    {
        if ($this->excerpt) {
            return $this->excerpt;
        }

<<<<<<< .merge_file_ja8Qyi
        return Str::limit(strip_tags($this->content), $length);
=======
        return Str::limit(strip_tags((string) $this->content), $length);
>>>>>>> .merge_file_DzQp7C
    }

    /**
     * Ottiene i tag formattati
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return array<int|string, mixed>
>>>>>>> .merge_file_DzQp7C
     */
    public function getFormattedTags(): array
    {
        if (! $this->tags || ! is_array($this->tags)) {
            return [];
        }

        return collect($this->tags)
            ->map(function ($tag) {
                return is_string($tag) ? ['name' => $tag, 'slug' => Str::slug($tag)] : $tag;
            })
            ->toArray();
    }

    /**
     * Ottiene i link esterni formattati
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return array<int|string, mixed>
>>>>>>> .merge_file_DzQp7C
     */
    public function getFormattedExternalLinks(): array
    {
        if (! $this->external_links || ! is_array($this->external_links)) {
            return [];
        }

<<<<<<< .merge_file_ja8Qyi
        return collect($this->external_links)
            ->map(function ($link) {
=======
        return collect($externalLinks)
            ->map(function (mixed $link): mixed {
>>>>>>> .merge_file_DzQp7C
                if (is_string($link)) {
                    return ['url' => $link, 'title' => parse_url($link, PHP_URL_HOST)];
                }

                return $link;
            })
            ->toArray();
    }

    /**
     * Ottiene gli allegati formattati
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return array<int|string, mixed>
>>>>>>> .merge_file_DzQp7C
     */
    public function getFormattedAttachments(): array
    {
        if (! $this->attachments || ! is_array($this->attachments)) {
            return [];
        }

<<<<<<< .merge_file_ja8Qyi
        return collect($this->attachments)
            ->map(function ($attachment) {
=======
        return collect($attachments)
            ->map(function (mixed $attachment): mixed {
>>>>>>> .merge_file_DzQp7C
                if (is_string($attachment)) {
                    return [
                        'path' => $attachment,
                        'name' => basename($attachment),
                        'url' => asset('storage/'.$attachment),
                        'size' => null,
                        'type' => pathinfo($attachment, PATHINFO_EXTENSION),
                    ];
                }

<<<<<<< .merge_file_ja8Qyi
=======
                if (! is_array($attachment)) {
                    return $attachment;
                }

                $path = $attachment['path'] ?? null;

>>>>>>> .merge_file_DzQp7C
                return array_merge([
                    'url' => isset($attachment['path']) ? asset('storage/'.$attachment['path']) : null,
                ], $attachment);
            })
            ->toArray();
    }

    /**
     * Ottiene la galleria immagini formattata
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return array<int|string, mixed>
>>>>>>> .merge_file_DzQp7C
     */
    public function getFormattedGallery(): array
    {
        if (! $this->gallery || ! is_array($this->gallery)) {
            return [];
        }

<<<<<<< .merge_file_ja8Qyi
        return collect($this->gallery)
            ->map(function ($image) {
=======
        return collect($gallery)
            ->map(function (mixed $image): mixed {
>>>>>>> .merge_file_DzQp7C
                if (is_string($image)) {
                    return [
                        'path' => $image,
                        'url' => asset('storage/'.$image),
                        'caption' => null,
                        'alt' => null,
                    ];
                }

<<<<<<< .merge_file_ja8Qyi
=======
                if (! is_array($image)) {
                    return $image;
                }

                $path = $image['path'] ?? null;

>>>>>>> .merge_file_DzQp7C
                return array_merge([
                    'url' => isset($image['path']) ? asset('storage/'.$image['path']) : null,
                ], $image);
            })
            ->toArray();
    }

    /**
     * Incrementa il contatore di visualizzazioni
     */
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    /**
     * Incrementa il contatore di condivisioni
     */
    public function incrementShareCount(): void
    {
        $this->increment('share_count');
    }

    /**
     * Verifica se può essere pubblicata
     */
    public function canBePublished(): bool
    {
        return in_array($this->news_status, ['approved']) &&
               $this->publication_date <= now();
    }

    /**
     * Verifica se deve essere archiviata
     */
    public function shouldBeArchived(): bool
    {
        return $this->is_expired ||
               ($this->expiry_date && $this->expiry_date->isPast());
    }

    /**
     * Ottiene i dati strutturati per SEO
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return array<string, mixed>
>>>>>>> .merge_file_DzQp7C
     */
    public function getStructuredData(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            'headline' => $this->title,
            'description' => $this->getExcerptFormatted(),
            'image' => $this->featured_image_url,
            'datePublished' => $this->publication_date?->toISOString(),
            'dateModified' => $this->last_modified?->toISOString(),
            'author' => [
                '@type' => 'Person',
                'name' => $this->author?->full_name,
            ],
            'publisher' => [
                '@type' => 'Organization',
<<<<<<< .merge_file_ja8Qyi
                'name' => $this->organizationalUnit?->name ?? 'Comune',
            ],
            'mainEntityOfPage' => $this->url,
            'articleSection' => $this->category,
            'keywords' => is_array($this->seo_keywords) ? implode(', ', $this->seo_keywords) : null,
            'wordCount' => str_word_count(strip_tags($this->content)),
=======
                'name' => $this->organizationalUnit?->getAttribute('name') ?? 'Comune',
            ],
            'mainEntityOfPage' => $this->url,
            'articleSection' => $this->category,
            'keywords' => is_array($seoKeywords)
                ? implode(', ', array_map(
                    static fn (mixed $keyword): string => is_scalar($keyword) ? (string) $keyword : '',
                    $seoKeywords
                ))
                : null,
            'wordCount' => str_word_count(strip_tags((string) $this->content)),
>>>>>>> .merge_file_DzQp7C
            'timeRequired' => 'PT'.$this->estimated_reading_time.'M',
        ];
    }

    /**
     * Ottiene le informazioni complete della notizia
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return array<string, mixed>
>>>>>>> .merge_file_DzQp7C
     */
    public function getNewsDetails(): array
    {
        return [
            'basic_info' => [
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'type' => $this->news_type_name,
                'category' => $this->category,
                'status' => $this->news_status_name,
                'priority' => $this->priority_name,
                'urgency' => $this->urgency_name,
            ],
            'content' => [
                'excerpt' => $this->getExcerptFormatted(),
                'content' => $this->content,
                'reading_time' => $this->estimated_reading_time,
                'featured_image' => $this->featured_image_url,
                'gallery' => $this->getFormattedGallery(),
                'attachments' => $this->getFormattedAttachments(),
            ],
            'publication' => [
                'publication_date' => $this->publication_date,
                'expiry_date' => $this->expiry_date,
                'last_modified' => $this->last_modified,
                'is_current' => $this->is_current,
                'is_fresh' => $this->is_fresh,
                'age_in_days' => $this->age_in_days,
            ],
            'metadata' => [
                'author' => $this->author?->full_name,
                'source' => $this->source,
                'tags' => $this->getFormattedTags(),
                'external_links' => $this->getFormattedExternalLinks(),
                'view_count' => $this->view_count,
                'share_count' => $this->share_count,
            ],
        ];
    }

    /**
     * Accessor per il nome del tipo di notizia
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function newsTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => MunicipalNewsTypeEnum::tryFrom($this->news_type)?->getLabel() ?? $this->news_type
        );
    }

    /**
     * Accessor per il nome dello stato
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function newsStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => MunicipalNewsStatusEnum::tryFrom($this->news_status)?->getLabel() ?? $this->news_status
        );
    }

    /**
     * Accessor per il nome della priorità
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function priorityName(): Attribute
    {
        return Attribute::make(
            get: fn () => (MunicipalNewsPriorityEnum::tryFrom($this->priority_level ?? 0) ?? MunicipalNewsPriorityEnum::NORMAL)->getLabel()
        );
    }

    /**
     * Accessor per il nome dell'urgenza
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function urgencyName(): Attribute
    {
        return Attribute::make(
            get: fn () => (MunicipalNewsUrgencyEnum::tryFrom($this->urgency_level ?? 0) ?? MunicipalNewsUrgencyEnum::NORMAL)->getLabel()
        );
    }

    /**
     * Accessor per verificare se è scaduta
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<bool, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->expiry_date && $this->expiry_date->isPast()
        );
    }

    /**
     * Accessor per verificare se è attuale
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<bool, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function isCurrent(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->is_expired) {
                    return false;
                }

                return $this->publication_date <= now();
            }
        );
    }

    /**
     * Accessor per l'età della notizia in giorni
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<int|null, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function ageInDays(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->publication_date?->diffInDays(now())
        );
    }

    /**
     * Accessor per verificare se è una notizia fresca
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<bool, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function isFresh(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->age_in_days <= 7
        );
    }

    /**
     * Accessor per il tempo di lettura stimato
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<int, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function estimatedReadingTime(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->reading_time) {
                    return $this->reading_time;
                }

                // Stima basata su 200 parole al minuto
<<<<<<< .merge_file_ja8Qyi
                $wordCount = str_word_count(strip_tags($this->content));
=======
                $wordCount = str_word_count(strip_tags((string) $this->content));
>>>>>>> .merge_file_DzQp7C

                return max(1, ceil($wordCount / 200));
            }
        );
    }

    /**
     * Accessor per l'URL della notizia
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<string, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('municipal.news.show', $this->slug)
        );
    }

    /**
     * Accessor per l'URL dell'immagine in evidenza
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<string|null, never>
>>>>>>> .merge_file_DzQp7C
     */
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->featured_image ? asset('storage/'.$this->featured_image) : null
        );
    }

    /**
     * Mutator per il titolo (genera automaticamente lo slug)
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<string, string>
>>>>>>> .merge_file_DzQp7C
     */
    protected function title(): Attribute
    {
        return Attribute::make(
<<<<<<< .merge_file_ja8Qyi
            set: function ($value) {
=======
            set: function (string $value): string {
>>>>>>> .merge_file_DzQp7C
                $this->attributes['title'] = $value;
                if (empty($this->attributes['slug'])) {
                    $this->attributes['slug'] = Str::slug($value);
                }

                return $value;
            }
        );
    }

    /**
     * Mutator per il contenuto (aggiorna reading_time)
<<<<<<< .merge_file_ja8Qyi
=======
     *
     * @return Attribute<string, string>
>>>>>>> .merge_file_DzQp7C
     */
    protected function content(): Attribute
    {
        return Attribute::make(
<<<<<<< .merge_file_ja8Qyi
            set: function ($value) {
=======
            set: function (string $value): string {
>>>>>>> .merge_file_DzQp7C
                $this->attributes['content'] = $value;

                // Auto-calcola reading time se non impostato
                if (! isset($this->attributes['reading_time'])) {
                    $wordCount = str_word_count(strip_tags($value));
<<<<<<< .merge_file_ja8Qyi
                    $this->attributes['reading_time'] = max(1, ceil($wordCount / 200));
=======
                    $this->attributes['reading_time'] = max(1, (int) ceil($wordCount / 200));
>>>>>>> .merge_file_DzQp7C
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
<<<<<<< .merge_file_ja8Qyi
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_DzQp7C
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });

        // Assicura unicità dello slug
<<<<<<< .merge_file_ja8Qyi
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_DzQp7C
            $originalSlug = $model->slug;
            $counter = 1;

            while (static::where('slug', $model->slug)->exists()) {
                $model->slug = $originalSlug.'-'.$counter;
                $counter++;
            }
        });

        // Set default values
<<<<<<< .merge_file_ja8Qyi
        static::creating(function ($model): void {
=======
        static::creating(function (self $model): void {
>>>>>>> .merge_file_DzQp7C
            if (is_null($model->news_status)) {
                $model->news_status = 'draft';
            }

            if (is_null($model->priority_level)) {
                $model->priority_level = 2; // Normale
            }

            if (is_null($model->urgency_level)) {
                $model->urgency_level = 2; // Normale
            }

            if (is_null($model->language)) {
                $model->language = 'it';
            }

            if (is_null($model->revision_number)) {
                $model->revision_number = 1;
            }
        });

        // Auto-publish se la data è raggiunta
<<<<<<< .merge_file_ja8Qyi
        static::updating(function ($model): void {
=======
        static::updating(function (self $model): void {
>>>>>>> .merge_file_DzQp7C
            if ($model->news_status === 'approved' &&
                $model->publication_date <= now() &&
                ! $model->is_published) {
                $model->is_published = true;
                $model->news_status = 'published';
            }
        });

        // Increment revision number on updates
<<<<<<< .merge_file_ja8Qyi
        static::updating(function ($model): void {
=======
        static::updating(function (self $model): void {
>>>>>>> .merge_file_DzQp7C
            if ($model->isDirty(['title', 'content', 'excerpt'])) {
                $model->revision_number++;
                $model->last_modified = now();
            }
        });
    }
}
