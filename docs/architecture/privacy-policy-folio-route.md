---
title: "Public privacy policy route ownership"
type: architecture-note
status: active
created: 2026-09-27
updated: 2026-09-27
tags: [theme, fixcity, folio, privacy, route-precedence]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ../../../../Modules/Fixcity/docs/bmad/stories/STORY-FIXCITY-PRIVACY-PUBLICATION-GATE.md
---

# Route and ownership

`XotData::getPubThemeViewPath()` resolves the configured `Sixteen` theme to
`Themes/Sixteen/resources/views/pages`. Folio matches a literal directory index
before wildcard directory indexes; the explicit
`resources/views/pages/privacy/index.blade.php` therefore owns `/it|en/privacy`
ahead of the CMS `[container0]/index` catch-all.

The theme page owns route precedence and hands off rendering to the FixCity
module. The module action resolves the tenant-localized `policy.md`; its view
renders configured content and fails closed with HTTP 503 while the file is the
starter placeholder. Legal copy, data-controller identity and contacts remain
tenant-owned values. Do not add demo legal data to this theme.
