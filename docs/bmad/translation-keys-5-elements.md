---
title: "Translation key convention (five elements)"
type: note
status: draft
updated: 2026-10-19
tags: [docs, sixteen, bmad]
qmd: "translation key convention (five elements) sixteen"
---
# Translation key convention (five elements)

Every new translation key has exactly five elements:

```text
<namespace>::<context>.<collection>.<key>.<type>
```

Examples:

- `fixcity::auth.login.form.email.input`
- `fixcity::auth.login.form.password.input`
- `user::auth.login.password.text`
- `fixcity::auth.register.link.text`
- `pub_theme::accessibility.page.title.text`

The namespace is part of the count. Therefore `fixcity::auth.intro`,
`user::auth.password`, `user::auth.login.password`, and
`pub_theme::accessibility.title` are incomplete and must not be introduced.

For legacy keys, migrate the caller and the owning locale tree together;
preserve the translated value and add a focused contract test when the key is
used by a public page or Filament widget.
