# Parity Verification Status — /it/tests/* vs Design Comuni

## Checked (structural / JSON / fetch, NO screenshot file yet):
- tests.index ✅ (5 groups Generali/Sito)
- tests/homepage ✅ (header, hero, Amministrazione, Eventi, Argomenti, Siti tematici, Link utili, Contatti, Cerca, Footer)
- segnalazione-dettaglio ✅ (breadcrumb, hero, 4-step wizard, form, terms, contacts)
- amministrazione ✅ (breadcrumb, hero, card-grid 3 items)
- domande-frequenti ✅ (after faq.default fix)
- risultati-ricerca ✅ (after search-results.default fix)
- segnalazioni-elenco, segnalazione-area-personale ✅

## Block errors fixed:
- faq/default.blade.php (232B)
- search-results/default.blade.php (3077B)

## Screenshot comparison (required for 95% visual parity):
- **NOT COMPLETED** — playwright-core present, screenshots not captured to /tmp/screenshots/
- Tool: `playwright` CLI available; needs `npx playwright screenshot ...` execution

## Stack verified: Tailwind + DaisyUI + Flowbite + Alpine + Lit; NO Bootstrap.

Initiative: kp-174d15a58ff94901b2b0df0d86b8907a (header/footer) + parity tracking.
