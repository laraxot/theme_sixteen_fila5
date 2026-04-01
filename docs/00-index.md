# Sixteen Theme - Documentation Index

**Last Update**: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
**Status**: ✅ Active Theme  
**Theme Version**: 1.0

## 📚 Quick Navigation

### 🎯 Essential Reading
1. [README.md](./README.md) - Theme overview
2. [Roadmap](./roadmap.md) - Project status and plan
3. [Design Comuni Implementation](./design-comuni-implementation.md) - Main implementation guide for Municipality Design

### 🏗️ Architecture & Standards
<<<<<<< HEAD
- [Agid Layout Usage Rules](./agid-layout-usage-rules.md) - How to use Agid-compliant layouts
- [Sixteen Theme Naming Rules](./sixteen-theme-naming-rules.md) - Naming conventions for this theme
- [Vite Configuration Rules](./vite-configuration-rules.md) - Asset loading optimization
- [SVG Icon Convention](./svg-icon-convention.md) - Rules for using SVG icons
=======
- **[Layout Hierarchy](./layout-hierarchy.md)** ✅ - `x-layouts.app` extends `x-layouts.main`
  - Base structure → Public frontend → Specialized layouts
  - DRY + KISS compliant architecture
  - See: [[components-directory-structure]], [[vite-configuration-guide]]
- **[Components Directory Structure](./components-directory-structure.md)** ✅ - Complete component organization
  - Layouts, Sections, Blocks, AGID components
  - Block types (hero, topics, events, news, etc.)
  - Naming conventions
- **[Vite Configuration Guide](./vite-configuration-guide.md)** ✅ - Build configuration
  - `outDir: './public'` explained (NOT `../../public_html/themes/Sixteen/`)
  - Manifest generation and Laravel integration
  - Development vs Production builds
- **[Build Commands Guide](./build-commands-guide.md)** ✅ - Complete build process
  - `composer update -W` → `npm install` → `npm run build` → `npm run copy`
  - Troubleshooting Vite manifest errors
  - Development vs Production builds
- [Agid Layout Usage Rules](./agid-layout-usage-rules.md) - How to use Agid-compliant layouts
- [Sixteen Theme Naming Rules](./sixteen-theme-naming-rules.md) - Naming conventions for this theme
>>>>>>> 4a11dcf (.)

### 🎨 Design Comuni Italia (Agid Compliance)
- [Design Comuni Implementation Guide](./design-comuni-implementation.md) - **Primary Technical Reference**
- [Agid Checklist](./agid-checklist.md) - Compliance verification
- [Agid Compliance Summary](./agid-compliance-summary.md) - Summary of work done
- [Components Status](./components-status.md) - Current state of all components

### 🔐 Authentication & Auth Widgets
- [Agid Login Implementation Plans](./agid-login-implementation-plan.md) - Strategy for compliant login
- [Login Agid Fix Complete](./login-agid-fix-complete.md) - Verification of login functionality
- [Auth Best Practices](./auth-best-practices.md) - Security guidelines

### 📧 Mail Layouts
- [Christmas Email Template Implementation](./christmas-email-template-implementation.md) - Implementation guide
- [Mail Layouts Natale](./mail-layouts-natale.md) - Full list of festive templates
- [Luxury Email Design Masterclass](./luxury-email-design-masterclass.md) - Visual excellence for emails

### 🔗 Related Resources
- [Cms Module](../../Modules/Cms/docs/README.md) - Content management
- [UI Module](../../Modules/UI/docs/README.md) - UI components
- [Xot Module](../../Modules/Xot/docs/README.md) - Core framework

---

*Theme documentation conforme agli standard Laraxot*