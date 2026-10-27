# Front-office deep audit

## Verified

- Blog, events and canonical ticket detail use the Comment module's Filament Livewire widgets.
- Replies are threaded through `parent_id`, limited server-side, rendered recursively and edited through the shared Filament `MarkdownEditor` schema.
- Guests can read approved public comments but cannot write or reply; authenticated users are checked by policy and rate limit.
- `/auth/password/confirm` now renders through the Sixteen auth shell instead of falling through to generic CMS content.
- The public `/services` container now has a tenant CMS page (`services.index`); previously the URL was a reproducible 404 even though the theme already contained `components/pages/services.blade.php` and the header generated the link.

## Remaining completion backlog

- Add browser coverage for guest/authenticated flows at 375, 768 and 1440 px.
- Replace remaining area-personale placeholder content with real profile/preferences/service views.
- Remove the demo dashboard surface and verify the canonical Folio owner for blog/event detail pages.
- Add explicit empty, error and retry states for ticket list pagination and map/API failures.
- Complete localized legal-page metadata and route-matrix assertions.
- Keep a route smoke test for every header/footer destination so a view existing without its CMS page cannot regress to a 404.

The backlog is intentionally evidence-based: PHPStan and focused Livewire tests do not prove visual, browser, SEO or cross-locale parity.
