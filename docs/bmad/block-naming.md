---
title: "Sixteen block naming contract"
type: theme-bmad-decision
status: draft
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "block naming sixteen"
---

Sixteen is the DesignComuni theme owner. `pub_theme` therefore already identifies
the DesignComuni implementation and must not be followed by a second
`design-comuni` namespace or variant name.

Use direct theme block names such as:

```text
pub_theme::components.blocks.homepage
pub_theme::components.blocks.service.detail
pub_theme::components.blocks.catalog-page
```

JSON page content chooses the block view; the block does not create a second
DesignComuni theme. This keeps the ownership chain `page JSON → Sixteen block →
Sixteen layout` explicit and avoids duplicate visual systems.
