<?php

declare(strict_types=1);

use Tests\TestCase;

uses(TestCase::class);

/**
 * Audit front office 2026-10-27: `/en|de|es/blog` mostrava in italiano "Cerca", "Invio", "N notizie trovate" e la
 * categoria di ripiego "NOTIZIE"; `/en|de|es/events` la categoria "EVENTI". I fallback erano stringhe scritte nei
 * template: vivono nel file lang del tema, uno per lingua, cosi' una lingua nuova non eredita l'italiano.
 */
const NEWS_INDEX_KEYS = ['default_category', 'default_event_category', 'search_label', 'search_placeholder', 'search_submit', 'result_one', 'result_many'];

it('translates the blog and events index labels in every language', function (string $locale, string $key): void {
    $italian = trans('pub_theme::news.index.'.$key, ['count' => 5], 'it');
    $translated = trans('pub_theme::news.index.'.$key, ['count' => 5], $locale);

    expect($translated)->not->toBe('pub_theme::news.index.'.$key)->and($translated)->not->toBe($italian);
})->with(function (): iterable {
    foreach (['en', 'de', 'es'] as $locale) {
        foreach (NEWS_INDEX_KEYS as $key) {
            yield "$locale $key" => [$locale, $key];
        }
    }
});

it('puts the number of results in the count message', function (string $locale): void {
    expect(trans('pub_theme::news.index.result_many', ['count' => 18], $locale))->toContain('18');
})->with(['it', 'en', 'de', 'es']);
