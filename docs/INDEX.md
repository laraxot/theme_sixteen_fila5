# Sixteen Theme Documentation Index

## 🎯 Current Focus: Design Comuni Body Parity (Phase 1)
Target: 90%+ structural identity with `italia/design-comuni-pagine-statiche`.

### 📄 Page Analysis & Reports
- [segnalazioni-elenco Parity Analysis](prompts/segnalazione_disservizio/segnalazioni-elenco-html-parity-analysis.md)
- [HTML Body Comparison Artifacts](html-compare/segnalazioni-elenco/report.md)
- [Theme Audit & Roadmap](../../../docs/design-comuni-theme-audit.md)

### 🛠 Tools (Agnostic)
- `bashscripts/html/html-structure-compare.sh`: Main entry point for structural comparison.
- `bashscripts/html/compare-html-body.py`: Python engine for deep tree comparison.

### 🏗 Architecture
- [Layout Hierarchy](layout-hierarchy.md)
- [Component Structure](component-structure-reorganization.md)
- [Translation System Rules](translation-system-rules.md)
- [**BODY CLASS RULE**](BODY_CLASS_RULE.md) - HTML parity enforcement: `<body>` senza classi custom
- [**STEPPER MOBILE-FIRST RULE**](STEPPER_MOBILE_FIRST_RULE.md) - Stepper CSS mobile-first con breakpoint 375/768/1024px

## 📋 Design Comuni Segnalazione Flow
- [segnalazione-02-dati Stepper Responsive](segnalazione-02-dati-stepper-responsive.md) ← Story [7-28](_bmad-output/implementation-artifacts/7-28-segnalazione-02-dati-stepper-responsive-multilingual.md)
- [segnalazione-02-dati Body Class Fix](segnalazione-02-dati-body-class-fix.md) ← Story [7-27](_bmad-output/implementation-artifacts/7-27-segnalazione-02-dati-body-class-fix-and-visual-parity.md)
- [segnalazione-crea Header/Stepper Responsive](segnalazione-crea-header-stepper-responsive.md) ← Story [7-29](_bmad-output/implementation-artifacts/7-29-segnalazione-crea-header-stepper-responsive-multilingual.md)
- [Multilingual Compliance](multilingual-compliance.md) ← Story [7-28](_bmad-output/implementation-artifacts/7-28-segnalazione-02-dati-stepper-responsive-multilingual.md)
- [Ticket Wizard Filament Refactor](ticket-wizard-filament-refactor.md) ← Story [7-30](_bmad-output/implementation-artifacts/7-30-refactor-ticket-wizard-to-filament-pure.md)

## 🚀 Status: segnalazioni-elenco
- **Overall Parity**: 93.7% ✅
- **Remaining Issues**: 24 BLOCK errors (Header structural mismatches & Detail Modal placeholders).
- **Next Step**: Fix Header DOM parity in Sixteen components.
