---
title: "Fix Issues with Search Results Block"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "fix issues with search results block sixteen"
---
# Fix Issues with Search Results Block

## Problem
The search results block (`/it/tests/risultati-ricerca`) lacks critical components from the Design Comuni reference page:

1. **Search Filters Section** - "Filtri da applicare" with 7 category types
2. **Search Results List** - Results with title, description, URL links
3. **Pagination Controls** - Previous/next navigation
4. **Rating Component** - Star rating and feedback form
5. **Contact Section** - "Contatta il comune" with address, phone, email

## Root Cause
The Blade component `search-results.blade.php` was refactored but missing crucial props for the new data structure, and the JSON config file `tests.risultati-ricerca.json` didn't include all required data.

## Solution

### 1. Updated Blade Component
Updated `laravel/Themes/Sixteen/resources/views/components/blocks/listing/search-results.blade.php` to support:
- `filters` array: Filter options for categories
- `results` array: Search results with title, description, link, image
- `pagination` array: Page navigation controls
- `rating` object: Rating component with stars
- `contacts` object: Contact information

### 2. Updated JSON Configuration
Updated `laravel/config/local/fixcity/database/content/pages/tests.risultati-ricerca.json` to include:
- 7 filter categories (unità organizzativa, ambiente, arredo urbano, disinfestazione, igiene urbana, siti tematici, argomenti)
- 5 search results with full data (title, description, category, date, URL, image)
- Pagination with 4 page links (1, 2, 3, Successivo)
- Rating component (title, 4 stars selected, success message)
- Contact section (address, phone, email, URP office)

### 3. Component Structure
The component now renders:
- Search input with autocomplete icon
- Filter section with 7 checkboxes
- Results grid with images, titles, descriptions, categories, dates
- Pagination navigation
- Rating component with star interaction
- Contact section with address, phone, email, URP

## Design Comuni Compliance
This fix ensures visual parity of **≥90% HTML** and **≥97% visual** parity with the Design Comuni reference.

## Files Modified
1. `laravel/Themes/Sixteen/resources/views/components/blocks/listing/search-results.blade.php` - Updated component props and rendering logic
2. `laravel/config/local/fixcity/database/content/pages/tests.risultati-ricerca.json` - Added complete data structure

## Verification
1. Test that all 7 filter categories display correctly
2. Test that search results show title, description, and link
3. Test pagination navigation works
4. Test rating component shows stars and success message
5. Test contact section displays all information