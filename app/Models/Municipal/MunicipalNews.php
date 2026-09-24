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
use function Safe\parse_url;

use Illuminate\Database\Eloquent\Builder;
use Themes\Sixteen\Support\FrontofficeUrl;

use Illuminate\Database\Eloquent\Casts\Attribute;
>>>>>>> 464cfc5 (.)
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

use function Safe\parse_url;

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
 * @property int $priority_level
 * @property int $urgency_level
<<<<<<< HEAD
 * @property array<array-key, mixed>|null $target_audience
 * @property array<array-key, mixed>|null $geographic_scope
=======
<<<<<<< HEAD
 * @property array|null $target_audience
 * @property array|null $geographic_scope
=======
 * @property array<string, mixed>|null $target_audience
 * @property array<string, mixed>|null $geographic_scope
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
 * @property string|null $language
 * @property string|null $featured_image
 * @property string|null $image_caption
 * @property string|null $image_alt_text
<<<<<<< HEAD
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
=======
<<<<<<< HEAD
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
=======
 * @property array<string, mixed>|null $gallery
 * @property array<string, mixed>|null $attachments
 * @property array<string, mixed>|null $related_services
 * @property array<string, mixed>|null $related_events
 * @property array<string, mixed>|null $related_people
 * @property array<string, mixed>|null $related_documents
 * @property array<string, mixed>|null $external_links
 * @property array<string, mixed>|null $tags
 * @property string|null $social_summary
 * @property string|null $meta_description
 * @property array<string, mixed>|null $seo_keywords
>>>>>>> 464cfc5 (.)
 * @property \Carbon\Carbon|null $publication_date
 * @property \Carbon\Carbon|null $expiry_date
 * @property \Carbon\Carbon|null $last_modified
>>>>>>> 9e18142 (.)
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
<<<<<<< HEAD
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
=======
<<<<<<< HEAD
 * @property array|null $accessibility_notes
 * @property string|null $feedback_url
 * @property string|null $correction_notice
 * @property array|null $translation_links
 * @property array|null $structured_data
 * @property array|null $metadata
=======
 * @property array<string, mixed>|null $accessibility_notes
 * @property string|null $feedback_url
 * @property string|null $correction_notice
 * @property array<string, mixed>|null $translation_links
 * @property array<string, mixed>|null $structured_data
 * @property array<string, mixed>|null $metadata
>>>>>>> 464cfc5 (.)
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 *
>>>>>>> 9e18142 (.)
 * @property-read OrganizationalUnit|null $organizationalUnit
 * @property-read PublicPerson|null $author
 * @property-read PublicPerson|null $editor
 * @property-read Collection<int, ContactPoint> $contacts
 */
<<<<<<< HEAD
class MunicipalNews extends Model
{
    /** @use HasFactory<Factory<self>> */
    use HasFactory, SoftDeletes;

    /**
=======
class MunicipalNews extends MunicipalBaseModel
{
    use SoftDeletes;

    /**
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
>>>>>>> 464cfc5 (.)
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
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
    }

    /**
<<<<<<< HEAD
     * Relazione con l'unità organizzativa
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
     * Relazione con l'autore
<<<<<<< HEAD
     *
     * @return BelongsTo<PublicPerson, $this>
=======
=======
     * @return BelongsTo<PublicPerson, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(PublicPerson::class, 'author_id');
    }

    /**
<<<<<<< HEAD
     * Relazione con l'editor
<<<<<<< HEAD
     *
     * @return BelongsTo<PublicPerson, $this>
=======
=======
     * @return BelongsTo<PublicPerson, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(PublicPerson::class, 'editor_id');
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
     * Relazione con i servizi correlati
<<<<<<< HEAD
     *
     * @return BelongsToMany<MunicipalService, $this>
=======
=======
     * @return BelongsToMany<MunicipalService, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalService::class, 'sixteen_news_services');
    }

    /**
<<<<<<< HEAD
     * Relazione con gli eventi correlati
<<<<<<< HEAD
     *
     * @return BelongsToMany<MunicipalEvent, $this>
=======
=======
     * @return BelongsToMany<MunicipalEvent, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(MunicipalEvent::class, 'sixteen_news_events');
    }

    /**
<<<<<<< HEAD
     * Relazione con le persone correlate
<<<<<<< HEAD
     *
     * @return BelongsToMany<PublicPerson, $this>
=======
=======
     * @return BelongsToMany<PublicPerson, $this>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function people(): BelongsToMany
    {
        return $this->belongsToMany(PublicPerson::class, 'sixteen_news_people');
    }

    /**
<<<<<<< HEAD
     * Scope per notizie pubblicate
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopePublished(Builder $query): Builder
=======
    public function scopePublished($query)
=======
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie pubblicate
     */
    public function scopePublished(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('is_published', true)
            ->where('news_status', 'published')
            ->where('publication_date', '<=', now())
            ->where(function (Builder $q): void {
                $q->whereNull('expiry_date')
                    ->orWhere('expiry_date', '>', now());
            });
    }

    /**
<<<<<<< HEAD
     * Scope per notizie in evidenza
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeFeatured(Builder $query): Builder
=======
    public function scopeFeatured($query)
=======
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie in evidenza
     */
    public function scopeFeatured(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('is_featured', true);
    }

    /**
<<<<<<< HEAD
     * Scope per notizie breaking
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeBreaking(Builder $query): Builder
=======
    public function scopeBreaking($query)
=======
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie breaking
     */
    public function scopeBreaking(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('is_breaking', true);
    }

    /**
<<<<<<< HEAD
     * Scope per notizie da homepage
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeHomepage(Builder $query): Builder
=======
    public function scopeHomepage($query)
=======
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie da homepage
     */
    public function scopeHomepage(Builder $query): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('show_on_homepage', true);
    }

    /**
<<<<<<< HEAD
     * Scope per tipologia di notizia
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
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per tipologia di notizia
     */
    public function scopeOfType(Builder $query, string $type): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('news_type', $type);
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
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
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
     * Scope per priorità minima
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeMinPriority(Builder $query, int $priority): Builder
=======
    public function scopeMinPriority($query, int $priority)
=======
     *
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per priorità minima
     */
    public function scopeMinPriority(Builder $query, int $priority): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('priority_level', '>=', $priority);
    }

    /**
<<<<<<< HEAD
     * Scope per notizie recenti
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
<<<<<<< HEAD
    public function scopeRecent(Builder $query, int $days = 30): Builder
=======
    public function scopeRecent($query, int $days = 30)
=======
     *
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope per notizie recenti
     */
    public function scopeRecent(Builder $query, int $days = 30): Builder
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $query->where('publication_date', '>=', now()->subDays($days));
    }

    /**
<<<<<<< HEAD
     * Scope ordinati per pubblicazione
     *
     * @param  Builder<static>  $query
     * @param  'asc'|'desc'  $direction
     * @return Builder<static>
     */
    public function scopeOrdered(Builder $query, string $direction = 'desc'): Builder
    {
        return $query->orderBy('publication_date', $direction)
=======
     *
     * @param  Builder<MunicipalNews>  $query
     * @return Builder<MunicipalNews>
     * Scope ordinati per pubblicazione
     */
    public function scopeOrdered(Builder $query, string $direction = 'desc'): Builder
    {
        $dir = in_array($direction, ['asc', 'desc'], true) ? $direction : 'desc';

        return $query->orderBy('publication_date', $dir)
>>>>>>> 464cfc5 (.)
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

<<<<<<< HEAD
        return Str::limit(strip_tags((string) $this->content), $length);
=======
<<<<<<< HEAD
        return Str::limit(strip_tags($this->content), $length);
=======
        return Str::limit(strip_tags((string) ($this->content ?? '')), $length);
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    }

    /**
     * Ottiene i tag formattati
<<<<<<< HEAD
     *
     * @return array<int|string, mixed>
=======
<<<<<<< HEAD
>>>>>>> 9e18142 (.)
     */
    public function getFormattedTags(): array
    {
        $tags = $this->tags;

        if (! is_array($tags)) {
            return [];
        }

        return collect($tags)
            ->map(function (mixed $tag): mixed {
                return is_string($tag) ? ['name' => $tag, 'slug' => Str::slug($tag)] : $tag;
            })
            ->toArray();
=======
     *
     * @return array<int, array<string, mixed>>
     */
    public function getFormattedTags(): array
    {
        if (! is_array($this->tags) || $this->tags === []) {
            return [];
        }

        $formatted = [];
        foreach ($this->tags as $tag) {
            if (is_string($tag)) {
                $formatted[] = ['name' => $tag, 'slug' => Str::slug($tag)];
                continue;
            }

            if (is_array($tag)) {
                $formatted[] = $tag;
            }
        }

        return $formatted;
>>>>>>> 464cfc5 (.)
    }

    /**
     * Ottiene i link esterni formattati
<<<<<<< HEAD
     *
     * @return array<int|string, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getFormattedExternalLinks(): array
    {
        $externalLinks = $this->external_links;

        if (! is_array($externalLinks)) {
            return [];
        }

<<<<<<< HEAD
        return collect($externalLinks)
            ->map(function (mixed $link): mixed {
=======
<<<<<<< HEAD
        return collect($this->external_links)
=======
        $formatted = collect($this->external_links)
>>>>>>> 464cfc5 (.)
            ->map(function ($link) {
>>>>>>> 9e18142 (.)
                if (is_string($link)) {
                    return ['url' => $link, 'title' => parse_url($link, PHP_URL_HOST)];
                }

                return $link;
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
     * Ottiene gli allegati formattati
<<<<<<< HEAD
     *
     * @return array<int|string, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getFormattedAttachments(): array
    {
        $attachments = $this->attachments;

        if (! is_array($attachments)) {
            return [];
        }

<<<<<<< HEAD
        return collect($attachments)
            ->map(function (mixed $attachment): mixed {
=======
<<<<<<< HEAD
        return collect($this->attachments)
=======
        $formatted = collect($this->attachments)
>>>>>>> 464cfc5 (.)
            ->map(function ($attachment) {
>>>>>>> 9e18142 (.)
                if (is_string($attachment)) {
                    return [
                        'path' => $attachment,
                        'name' => basename($attachment),
                        'url' => asset('storage/'.$attachment),
                        'size' => null,
                        'type' => pathinfo($attachment, PATHINFO_EXTENSION),
                    ];
                }

<<<<<<< HEAD
                if (! is_array($attachment)) {
                    return $attachment;
                }

                $path = $attachment['path'] ?? null;

=======
<<<<<<< HEAD
>>>>>>> 9e18142 (.)
                return array_merge([
                    'url' => is_string($path) ? asset('storage/'.$path) : null,
                ], $attachment);
            })
            ->toArray();
=======
                return is_array($attachment)
                    ? array_merge([
                        'url' => isset($attachment['path']) && is_string($attachment['path'])
                            ? asset('storage/'.$attachment['path'])
                            : null,
                    ], $attachment)
                    : [];
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> 464cfc5 (.)
    }

    /**
     * Ottiene la galleria immagini formattata
<<<<<<< HEAD
     *
     * @return array<int|string, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<int, array<string, mixed>>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getFormattedGallery(): array
    {
        $gallery = $this->gallery;

        if (! is_array($gallery)) {
            return [];
        }

<<<<<<< HEAD
        return collect($gallery)
            ->map(function (mixed $image): mixed {
=======
<<<<<<< HEAD
        return collect($this->gallery)
=======
        $formatted = collect($this->gallery)
>>>>>>> 464cfc5 (.)
            ->map(function ($image) {
>>>>>>> 9e18142 (.)
                if (is_string($image)) {
                    return [
                        'path' => $image,
                        'url' => asset('storage/'.$image),
                        'caption' => null,
                        'alt' => null,
                    ];
                }

<<<<<<< HEAD
                if (! is_array($image)) {
                    return $image;
                }

                $path = $image['path'] ?? null;

=======
<<<<<<< HEAD
>>>>>>> 9e18142 (.)
                return array_merge([
                    'url' => is_string($path) ? asset('storage/'.$path) : null,
                ], $image);
            })
            ->toArray();
=======
                return is_array($image)
                    ? array_merge([
                        'url' => isset($image['path']) && is_string($image['path'])
                            ? asset('storage/'.$image['path'])
                            : null,
                    ], $image)
                    : [];
            })
            ->values()->all();

        /** @var array<int, array<string, mixed>> $formatted */
        return $formatted;
>>>>>>> 464cfc5 (.)
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
        return $this->news_status === 'approved' &&
               $this->publication_date !== null &&
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
<<<<<<< HEAD
     *
     * @return array<string, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    public function getStructuredData(): array
    {
        $seoKeywords = $this->seo_keywords;

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
                'name' => $this->authorFullName(),
            ],
            'publisher' => [
                '@type' => 'Organization',
<<<<<<< HEAD
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
=======
<<<<<<< HEAD
                'name' => $this->organizationalUnit?->name ?? 'Comune',
            ],
            'mainEntityOfPage' => $this->url,
            'articleSection' => $this->category,
            'keywords' => is_array($this->seo_keywords) ? implode(', ', $this->seo_keywords) : null,
            'wordCount' => str_word_count(strip_tags($this->content)),
=======
                'name' => $this->organizationalUnit->name ?? 'Comune',
            ],
            'mainEntityOfPage' => $this->url,
            'articleSection' => $this->category,
            'keywords' => is_array($this->seo_keywords)
                ? implode(', ', array_map(static fn (mixed $keyword): string => (string) $keyword, $this->seo_keywords))
                : null,
            'wordCount' => str_word_count(strip_tags((string) ($this->content ?? ''))),
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
            'timeRequired' => 'PT'.$this->estimated_reading_time.'M',
        ];
    }

    /**
     * Ottiene le informazioni complete della notizia
<<<<<<< HEAD
     *
     * @return array<string, mixed>
=======
<<<<<<< HEAD
=======
     *
     * @return array<string, mixed>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
                'author' => $this->authorFullName(),
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
    protected function newsTypeName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::NEWS_TYPES[$this->news_type] ?? $this->news_type
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
    protected function newsStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::NEWS_STATUSES[$this->news_status] ?? $this->news_status
        );
    }

    /**
     * Accessor per il nome della priorità
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
    protected function priorityName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::PRIORITY_LEVELS[$this->priority_level] ?? 'Normale'
        );
    }

    /**
     * Accessor per il nome dell'urgenza
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
    protected function urgencyName(): Attribute
    {
        return Attribute::make(
            get: fn () => self::URGENCY_LEVELS[$this->urgency_level] ?? 'Normale'
        );
    }

    /**
     * Accessor per verificare se è scaduta
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
    protected function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => (bool) ($this->expiry_date && $this->expiry_date->isPast())
        );
    }

    /**
     * Accessor per verificare se è attuale
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
    protected function isCurrent(): Attribute
    {
        return Attribute::make(
            get: function (): bool {
                if ($this->is_expired) {
                    return false;
                }

                return $this->publication_date !== null && $this->publication_date <= now();
            }
        );
    }

    /**
     * Accessor per l'età della notizia in giorni
<<<<<<< HEAD
     *
     * @return Attribute<int|null, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<int, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function ageInDays(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->publication_date?->diffInDays(now())
        );
    }

    /**
     * Accessor per verificare se è una notizia fresca
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
    protected function isFresh(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->age_in_days !== null && $this->age_in_days <= 7
        );
    }

    /**
     * Accessor per il tempo di lettura stimato
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
    protected function estimatedReadingTime(): Attribute
    {
        return Attribute::make(
            get: function (): int {
                if ($this->reading_time) {
                    return $this->reading_time;
                }

                // Stima basata su 200 parole al minuto
<<<<<<< HEAD
                $wordCount = str_word_count(strip_tags((string) $this->content));
=======
<<<<<<< HEAD
                $wordCount = str_word_count(strip_tags($this->content));
=======
                $wordCount = str_word_count(strip_tags((string) ($this->content ?? '')));
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)

                return max(1, (int) ceil($wordCount / 200));
            }
        );
    }

    /**
     * Accessor per l'URL della notizia
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
            get: fn () => route('municipal.news.show', $this->slug)
=======
            get: fn () => FrontofficeUrl::path('/novita/'.$this->slug)
>>>>>>> 464cfc5 (.)
        );
    }

    /**
     * Accessor per l'URL dell'immagine in evidenza
<<<<<<< HEAD
     *
     * @return Attribute<string|null, never>
=======
<<<<<<< HEAD
=======
     *
     * @return Attribute<string|null, never>
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
     */
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->featured_image ? asset('storage/'.$this->featured_image) : null
        );
    }

    /**
     * Mutator per il titolo (genera automaticamente lo slug)
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
    protected function title(): Attribute
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
    protected function content(): Attribute
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
                $this->attributes['content'] = $value;

                // Auto-calcola reading time se non impostato
                if (! isset($this->attributes['reading_time'])) {
<<<<<<< HEAD
                    $wordCount = str_word_count(strip_tags($value));
<<<<<<< HEAD
                    $this->attributes['reading_time'] = max(1, (int) ceil($wordCount / 200));
=======
=======
                    $wordCount = str_word_count(strip_tags((string) $value));
>>>>>>> 464cfc5 (.)
                    $this->attributes['reading_time'] = max(1, ceil($wordCount / 200));
>>>>>>> 9e18142 (.)
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
                $model->slug = Str::slug($model->title);
=======
        static::creating(function (MunicipalNews $model): void {
            if (empty($model->slug)) {
                $model->slug = Str::slug((string) $model->title);
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
        static::creating(function (MunicipalNews $model): void {
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
        static::creating(function (MunicipalNews $model): void {
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
<<<<<<< HEAD
        static::updating(function (self $model): void {
=======
<<<<<<< HEAD
        static::updating(function ($model): void {
=======
        static::updating(function (MunicipalNews $model): void {
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
            if ($model->news_status === 'approved' &&
                $model->publication_date !== null &&
                $model->publication_date <= now() &&
                ! $model->is_published) {
                $model->is_published = true;
                $model->news_status = 'published';
            }
        });

        // Increment revision number on updates
<<<<<<< HEAD
        static::updating(function (self $model): void {
=======
<<<<<<< HEAD
        static::updating(function ($model): void {
=======
        static::updating(function (MunicipalNews $model): void {
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
            if ($model->isDirty(['title', 'content', 'excerpt'])) {
                $model->revision_number++;
                $model->last_modified = now();
            }
        });
    }
}
