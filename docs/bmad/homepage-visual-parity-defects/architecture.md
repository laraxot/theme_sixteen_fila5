---
title: "BMAD Architecture for Homepage Visual Parity Fix"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "bmad architecture for homepage visual parity fix sixteen"
---
# BMAD Architecture for Homepage Visual Parity Fix

## Defect Analysis (14 Issues Identified)
1. **Header Icons**: Missing SVG icons, black color instead of white
2. **Hamburger Menu**: Not appearing on mobile view
3. **Underlined Links**: All navigation links underlined (violates clean design)
4. **Hero Title**: Wrong font size/color, missing "tutti gli eventi previsti" subtitle
5. **Badge Missing**: "Estate in città" badge missing from header
6. **Government Bodies**: Missing image and "vai alla pagina" button
7. **Events Calendar**: Incorrect structure/content
7. **Featured Topics**: Geometric background present but text boxes have incorrect padding/margin
8. **Thematic Sites**: Missing background colors and images
9. **Search**: Missing magnifying glass icon and submit button
10. **Rating**: Incorrect behavior (not interactive or wrong states)
10. **Contact Section**: Spacing issues (inconsistent with 8px grid)

## Component Structure Reference
- **Header**: 
  - Top bar (dark bg #006b4f): region link, utility links (social/icons), language switcher (Alpine dropdown), account CTA
  - Brand row: logo (14x14), brand name (xl/2xl), tagline (sm:block)
  - Search button (dispatches open-search), mobile menu toggle
  - Primary nav (lg:flex): 6 navigation items with active state detection
- **Footer**: 4 columns (logo, services, legal, social) + copyright
- **Data Flow**: header receives `blocks` prop → extracts first block's `data` → falls back to config('comune.*') → localizes URLs via LaravelLocalization

## Defect Mapping
| Defect | Component | Root Cause | Fix Approach |
|--------|-----------|------------|--------------|
| Header icons | Top bar (social/icons) | Missing SVG, wrong color | Use sprite SVG, white color, proper class |
| Hamburger menu | Mobile nav toggle | Missing x-data/x-show logic | Add Alpine.js x-data with x-show |
| Underlined links | Primary nav | CSS text-decoration: underline | Remove underline, use token colors |
| Hero title | Hero section | Wrong font size/color | Use design tokens (clamp(2.75rem, 7vw, 6.75rem), text-white) |
| "Estate in città" badge | Brand row | Missing component | Create badge component with bg-green-500 text-white rounded-full |
| Government bodies | Footer items | Missing image + button | Add img-fluid + btn-primary components |
| Events calendar | Content section | Wrong structure | Use card-grid with fixed column layout |
| Featured topics | Content sections | Wrong padding/margin | Apply consistent spacing tokens (p-4, mb-4) |
| Thematic sites | Page sections | Missing bg/img | Add bg-color + img components per site |
| Search | Header | Missing icon/button | Add icon-search + dispatch open-search |
| Rating | Content section | Wrong behavior | Implement interactive star rating with states |
| Contact spacing | Footer sections | Inconsistent spacing | Apply consistent spacing tokens (p-4, p-6, mt-4) |

## Design System Compliance
- **Tokens**: Use design system tokens for colors (e.g., #006b4f), spacing (8px grid), elevation (sm/md/lg/xl)
- **Elevation**: Named levels only (sm/md/lg/xl), no ad-hoc shadow values
- **States**: Every interactive element must declare default, hover, focus-visible, active, disabled
- **Motion**: All animations must have prefers-reduced-motion fallback
- **Inventory**: Document all components before implementation

## Prevention Strategy
1. **Token Enforcement**: Use design system tokens exclusively (no hardcoded values)
2. **State Contract**: Every interactive element must have all required states declared
3. **Reference-First**: Always compare against reference site before declaring completion
4. **Audit Trail**: Document every change in BMAD stories with rationale