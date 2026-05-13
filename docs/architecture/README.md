# Architecture Documentation Index

**Theme**: Sixteen  
**Last Updated**: 2026-04-01  
**Status**: ✅ Active

---

## 📚 Core Architecture Documents

### Layout & Routing
| Document | Description | Cross-References |
|----------|-------------|------------------|
| [PAGE_ROUTING_ARCHITECTURE.md](./PAGE_ROUTING_ARCHITECTURE.md) | Folio + Volt routing with [slug].blade.php | → [ARCHITECTURAL_DECISIONS.md](../design-comuni/ARCHITECTURAL_DECISIONS.md), → [LAYOUT_ARCHITECTURE_MAP.md](./LAYOUT_ARCHITECTURE_MAP.md) |
| [LAYOUT_ARCHITECTURE_MAP.md](./LAYOUT_ARCHITECTURE_MAP.md) | Layout hierarchy and components | → [PAGE_ROUTING_ARCHITECTURE.md](./PAGE_ROUTING_ARCHITECTURE.md), → [component-namespace.md](./component-namespace.md) |
| [component-namespace.md](./component-namespace.md) | pub_theme:: namespace convention | → [LAYOUT_ARCHITECTURE_MAP.md](./LAYOUT_ARCHITECTURE_MAP.md) |

### Design Comuni
| Document | Description | Cross-References |
|----------|-------------|------------------|
| [ARCHITECTURAL_DECISIONS.md](../design-comuni/ARCHITECTURAL_DECISIONS.md) | Philosophy, Zen, 10 key decisions | → [PAGE_ROUTING_ARCHITECTURE.md](./PAGE_ROUTING_ARCHITECTURE.md), → [MASTER_IMPLEMENTATION_PLAN.md](../design-comuni/MASTER_IMPLEMENTATION_PLAN.md) |
| [MASTER_IMPLEMENTATION_PLAN.md](../design-comuni/MASTER_IMPLEMENTATION_PLAN.md) | 38 pages implementation plan | → [ARCHITECTURAL_DECISIONS.md](../design-comuni/ARCHITECTURAL_DECISIONS.md), → [HTML_PARITY_VERIFICATION_REPORT.md](../design-comuni/HTML_PARITY_VERIFICATION_REPORT.md) |
| [HTML_PARITY_VERIFICATION_REPORT.md](../design-comuni/HTML_PARITY_VERIFICATION_REPORT.md) | HTML parity verification tool & reports | → [MASTER_IMPLEMENTATION_PLAN.md](../design-comuni/MASTER_IMPLEMENTATION_PLAN.md) |
| [PARITY_SESSION_SUMMARY.md](../design-comuni/PARITY_SESSION_SUMMARY.md) | Session summary with html_parity_check.py tool | → [HTML_PARITY_VERIFICATION_REPORT.md](../design-comuni/HTML_PARITY_VERIFICATION_REPORT.md) |

---

## 🎯 Key Principles

### 1. DRY (Don't Repeat Yourself)
- ✅ ONE `[slug].blade.php` for ALL pages
- ✅ 47 reusable blocks for 38 pages
- ✅ JSON content, NOT hardcoded HTML

### 2. KISS (Keep It Simple, Stupid)
- ✅ Dynamic slug routing
- ✅ Simple mount($slug) → load JSON → render
- ✅ Minimal blade files

### 3. Forward-Only Git
- ✅ Study old versions for understanding
- ✅ NEVER restore/revert old commits
- ✅ Always move forward with improvements

### 4. Frontend Dependency Resolution In Monorepo
- ✅ `Sixteen` is the Vite root for the public frontend bundle
- ✅ If the theme imports JS files from another module, bare imports inside those files must still resolve through the theme toolchain
- ✅ For external packages like `lit` and `leaflet`, prefer explicit `resolve.alias` entries in `vite.config.js` when the importer is outside `laravel/Themes/Sixteen/`
- ❌ Do not assume sibling modules can see `laravel/Themes/Sixteen/node_modules` automatically

### Lit Rule
- Lit official docs recommend installing the `lit` npm package and importing it directly from JavaScript modules
- In this repository that installation boundary is the theme bundle actually running Vite
- When a Geo-owned Lit component is imported by the Sixteen bundle, the theme must expose `lit` to Rollup/Vite even though the source file lives under `Modules/Geo`

### Build And Publish Rule
- `npm run build` generates the new theme manifest and hashed assets under `laravel/Themes/Sixteen/public/`
- `npm run copy` must force-overwrite `public_html/themes/Sixteen/manifest.json` and the compiled assets, otherwise Laravel may keep serving an old JS entry even after a successful build
- If the browser is still loading an older hashed bundle, inspect both manifests:
  - `laravel/Themes/Sixteen/public/manifest.json`
  - `public_html/themes/Sixteen/manifest.json`

### Filament + Lit Rule
- If a Geo Filament field selects a Lit renderer, the field still remains Filament-governed on the PHP side
- The theme only bundles and publishes the Web Component assets
- The field chooses the renderer; the theme does not choose field behavior

---

## 📁 Allowed Directory Structure

```
laravel/Themes/Sixteen/resources/views/pages/
├── [container0]/       ✅ CMS dynamic pages
├── [slug].blade.php    ✅ Dynamic route
├── auth/              ✅ Authentication
├── tests/             ✅ Design Comuni
└── index.blade.php    ✅ Homepage
```

### ❌ DELETED (Not Allowed)
```
❌ administration/  ❌ news/  ❌ services/  ❌ home.blade.php
❌ ambiente/        ❌ pages/ ❌ sport/     ❌ homepage.blade.php
❌ article/         ❌ profile/ ❌ tickets/  ❌ prova01.blade.php
❌ articles/        ❌ salute/ ❌ turismo/   ❌ segnalazioni.blade.php
❌ categories/      ❌ segnalazioni/ ❌ show.blade.php
❌ cultura/         ❌ dashboard/    ❌ counter.blade.php
❌ eventi/          ❌ famiglia/    ❌ bootstrap-italia-showcase.blade.php
❌ genesis/         ❌ lavoro/
❌ learn/           ❌ mobilita/
```

---

## 🔗 External References

- **QWEN.md**: Project-wide rules and memories
- **MODULE_DOCS_INDEX.md**: Master documentation index
- **BMad Documents**: `_bmad-output/design-comuni-*.md`

---

## 📊 Metrics

| Metric | Count |
|--------|-------|
| Architecture Docs | 10+ |
| Design Comuni Docs | 15+ |
| Cross-References | 30+ |
| Bidirectional Links | ✅ All docs |

---

**Maintained By**: Architecture Team  
**Last Review**: 2026-04-01  
**Next Review**: After each major architecture change
