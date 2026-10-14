---
title: "STORY-700 — Homepage Redesign with Impeccable/Tasteskill Standards"
type: story
status: draft
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "story-700   homepage redesign with impeccable/tasteskill standards sixteen"
---
# STORY-700 — Homepage Redesign with Impeccable/Tasteskill Standards

**Status**: In Progress
**Module**: Sixteen
**Epic**: Public-sector civic tech landing page modernization
**Labels**: design, frontend, motion, accessibility, threejs

---

## Context

The current Sixteen theme homepage (`/it`) was functional but generic:
- Hero: map preview only, no civic value proposition
- How-it-works: 3 basic Bootstrap cards
- Quick-actions: low visual priority

The first implementation slice now introduces a JSON-driven civic hero, a
contextual map section and a high-contrast tracking band without adding a
runtime dependency.

---

## Design Read (per tasteskill §0)

> **Reading this as: public-sector civic tech landing page for general citizens, with a trust-first/governmental aesthetic, leaning toward Bootstrap Italia / Design Comuni (official Italian PA design system).**

**Dial settings (per tasteskill §1):**
- DESIGN_VARIANCE: **4** (trust-first = predictable, symmetric)
- MOTION_INTENSITY: **3** (accessibility-first = minimal, prefers-reduced-motion default)
- VISUAL_DENSITY: **5** (service info needs breathing room but not art-gallery sparse)

---

## Acceptance Criteria

### Visual (tasteskill §4)
- [ ] **Hero** fits in initial viewport (≤ 100dvh), headline ≤ 2 lines, subtext ≤ 20 words, CTAs visible without scroll
- [ ] **Real imagery** in hero (deferred: the live map remains the source-of-truth visual)
- [ ] **Section layout diversity** — no two consecutive sections use same layout family
- [ ] **Eyebrow restraint** — max 1 eyebrow per 3 sections (tasteskill §4.7)
- [ ] **Shape consistency lock** — one corner-radius scale for all cards/buttons
- [ ] **Button contrast** — all CTAs pass WCAG AA (4.5:1) in light + dark

### Motion (motion-design §3, §5, §6)
- [x] **Entrance hierarchy** on hero content (CSS-only, no runtime dependency)
- [x] **Scroll-safe** how-it-works layout (no JS scroll listener)
- [ ] **Micro-feedback** on CTA hover/press (scale 0.98, shadow shrink)
- [ ] **prefers-reduced-motion** honored — all motion collapses to instant
- [ ] **No `window.addEventListener('scroll')`** — use Motion `useScroll` or CSS scroll-driven animations

### Technical
- [ ] **PHPStan Level 10** passes (zero errors across all modules)
- [ ] **Dark mode** works via `prefers-color-scheme` + manual toggle
- [ ] **Three.js map enhancement** (optional; intentionally deferred while Leaflet map is the civic data surface)
- [ ] **No new dependencies** without verification (tasteskill §3.F)

---

## Implementation Plan

### Phase 1: Hero Redesign
- [x] Add split hero copy + civic signal panel, with copy in the locale JSON
- [ ] Add generated hero photography (deferred; avoid competing with live map data)
- Refine CTAs: primary "Segnala un disservizio", secondary "Vedi tutte" (single intent each)
- Add entrance animation (fade-up stagger)

### Phase 2: How-It-Works Enhancement
- [x] Replace generic cards with a restrained numbered editorial grid
- [x] Keep motion CSS-only and reduced-motion safe
- Add subtle hover elevation (translateY -4px, shadow increase)

### Phase 3: Quick-Actions Polish
- [x] Convert to full-width CTA section with better visual weight
- [x] Add CSS micro-interaction on button press

### Phase 4: Motion & Dark Mode
- Add Motion-based entrance/reveal system
- Implement dark mode tokens (CSS variables) respecting Design Comuni
- Add reduced-motion guards

### Phase 5: Three.js Map Enhancement (Progressive)
- Add optional Three.js globe/map layer for hero map
- Fallback to current `map-lit` if WebGL unavailable

---

## References

- tasteskill: `/mnt/nas07/var/www/_bases/base_fixcity_fila5/.kilo/skills/taste-skill/skills/SKILL.md`
- motion-design: `/mnt/nas07/var/www/_bases/base_fixcity_fila5/.kilo/skills/motion-design/SKILL.md`
- threejs-fundamentals: `/mnt/nas07/var/www/_bases/base_fixcity_fila5/.kilo/skills/threejs-fundamentals/SKILL.md`
- Design Comuni: `laravel/Themes/Sixteen/design-comuni/`
- Current homepage JSON: `laravel/config/local/fixcity/database/content/pages/home.json`

---

## GitHub Issue
https://github.com/Kilo-Org/kilocode/issues/700

## Discussion
https://github.com/Kilo-Org/kilocode/discussions/700
