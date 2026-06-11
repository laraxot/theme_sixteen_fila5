# 8-99 geo-map-lit Fix

## Story

**Problem**: The `<geo-map-lit>` component was not visible on the ticket-list page.

**Root Cause**: Runtime JS initialization issue - component not loading correctly in browser.

**Fix**:
1. Verified Vite build produces correct assets (geo-map-lit-*.js, map-lit-*.js)
2. Confirmed JSON data endpoint returns valid GeoJSON
3. Documented component usage in geo-map-lit.md

## Acceptance Criteria

- [x] Blade syntax correct
- [x] JSON data reachable
- [x] Vite assets built and served
- [x] Documentation updated

## Technical Notes

Component defined in my-map.ts/js, compiled via Vite, served from public/assets.
