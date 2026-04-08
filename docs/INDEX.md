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

## 🚀 Status: segnalazioni-elenco
- **Overall Parity**: 93.7% ✅
- **Remaining Issues**: 24 BLOCK errors (Header structural mismatches & Detail Modal placeholders).
- **Next Step**: Fix Header DOM parity in Sixteen components.
