# 📸 Screenshots Folder

> Raw screenshots of reference and local homepages at multiple viewports for visual comparison

**Status**: Capturing  
**Last Updated**: 2026-04-02  
**Related**: [← Master Index](../00-HOMEPAGE-REPLICATION-INDEX.md)

---

## 📷 Screenshot Inventory

### Viewports Captured

| Device | Width | Height | Use Case |
|--------|-------|--------|----------|
| **Desktop** | 1920px | 1080px | Large screens, full layout analysis |
| **Tablet** | 768px | 1024px | iPad / responsive breakpoint |
| **Mobile** | 375px | 667px | iPhone / mobile-first testing |

---

## 📁 File Organization

```
screenshots/
├── reference_desktop.png       (1920×1080)
├── reference_tablet.png        (768×1024)
├── reference_mobile.png        (375×667)
├── local_desktop.png           (1920×1080)
├── local_tablet.png            (768×1024)
├── local_mobile.png            (375×667)
└── README.md                   (this file)
```

---

## 🛠️ How to Capture Screenshots

### Using the Provided Script

```bash
./bashscripts/screenshot-homepage.sh
```

**Requires**: Playwright (installed via `npm`)

### Manual Capture (if script unavailable)

1. **Reference**: Visit https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
   - At each viewport, take full-page screenshot
   - Save as `reference_[viewport].png`

2. **Local**: Visit http://127.0.0.1:8000/it/tests/homepage
   - At each viewport, take full-page screenshot
   - Save as `local_[viewport].png`

---

## 📊 Screenshot Usage

### For Visual Comparison
1. Open [Visual Comparison Folder](../visual-comparison/)
2. Compare annotated analysis for each viewport
3. Cross-reference with raw screenshots here

### For Figma Import
1. Create a Figma file
2. Import both sets of screenshots
3. Add annotations for CSS differences
4. Share link in [Visual Comparison Docs](../visual-comparison/)

### For Documentation
- Embed screenshots in analysis markdown files
- Add annotations (arrows, circles, text) to highlight differences
- Save annotated versions as separate files: `reference_desktop_annotated.png`

---

## 🎯 Analysis Checklist

Use these screenshots to verify analysis in other folders:

- [ ] [HTML Structure](../analysis/01-HTML-STRUCTURE-ANALYSIS.md) - element positioning matches screenshots
- [ ] [CSS Framework](../analysis/02-CSS-FRAMEWORK-AUDIT.md) - classes visible in DOM match visual styles
- [ ] [Components](../analysis/03-COMPONENT-BREAKDOWN.md) - component boundaries match screenshot layout
- [ ] [Responsive](../analysis/04-RESPONSIVE-PATTERNS.md) - breakpoint behaviors match viewport screenshots

---

## 📝 Screenshot Metadata

When adding new screenshots, include this metadata:

```markdown
### Screenshot: [name]
- **URL**: [full URL captured]
- **Viewport**: [device/dimensions]
- **Date Captured**: [ISO date]
- **Differences Noted**: [list key visual differences]
- **Issues Found**: [list visual issues present]
```

---

## 🔗 Related Documents

| Document | Purpose |
|----------|---------|
| [Analysis](../analysis/) | Structural breakdown |
| [Visual Comparison](../visual-comparison/) | Annotated screenshot analysis |
| [Mappings](../mappings/) | CSS class mapping |
| [Phases](../phases/) | Implementation plans |

---

## 🚀 Next Steps

1. **Capture all 6 screenshots** using script or manually
2. **Annotate key differences** for [Visual Comparison](../visual-comparison/)
3. **Reference in component work** from [Phases](../phases/)
4. **Update analysis docs** in [Analysis Folder](../analysis/)

---

**Navigation**: 
- [← Back to Master Index](../00-HOMEPAGE-REPLICATION-INDEX.md)
- [← Previous: Analysis](../analysis/README.md)
- [Next: Visual Comparison →](../visual-comparison/README.md)

