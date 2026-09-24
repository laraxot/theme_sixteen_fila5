# Pages Documentation Index

> **Documentazione di tutte le pagine Design Comuni replicate**

## 📋 Panoramica

Ogni pagina Design Comuni viene replicata utilizzando:
- **Route:** `Themes/Sixteen/resources/views/pages/tests/[slug].blade.php`
- **Content:** `config/local/fixcity/database/content/pages/tests.<slug>.json`
- **Blocks:** Universal blocks da `pub_theme::components.blocks.*`

## 📄 Pagine

### Homepage

- **Originale:** https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
- **Locale:** http://fixcity.local/it/tests/homepage
- **JSON:** `config/local/fixcity/database/content/pages/tests.homepage.json`
- **Stato:** 🔄 In Progress

**Componenti:**
- Hero newscard
- Governance card grid
- Events list
- Topics grid
- Thematic sites
- Feedback form

**Documentazione:**
- [Homepage Page](./homepage.md)
- [Screenshot](../screenshots/homepage/)

---

### Argomenti

- **Originale:** https://italia.github.io/design-comuni-pagine-statiche/sito/argomenti.html
- **Locale:** http://fixcity.local/it/tests/argomenti
- **JSON:** `config/local/fixcity/database/content/pages/tests.argomenti.json`
- **Stato:** 🔄 In Progress

**Componenti:**
- Breadcrumb
- Page introduction
- Featured topics (Cultura, Sport, Famiglia)
- Topics grid
- Feedback form

**Documentazione:**
- [Argomenti Page](./argomenti.md)
- [Screenshot](../screenshots/argomenti/)

---

### Appuntamento 06 Conferma

- **Originale:** https://italia.github.io/design-comuni-pagine-statiche/sito/appuntamento-06-conferma.html
- **Locale:** http://fixcity.local/it/tests/appuntamento-06-conferma
- **JSON:** `config/local/fixcity/database/content/pages/tests.appuntamento-06-conferma.json`
- **Stato:** ⏳ Pending

**Componenti:**
- Breadcrumb
- Confirmation message
- Appointment details
- Personal data section
- Next steps

**Documentazione:**
- [Appuntamento Page](./appuntamento-06-conferma.md)
- [Screenshot](../screenshots/appuntamento-06-conferma/)

---

### Amministrazione

- **Originale:** https://italia.github.io/design-comuni-pagine-statiche/sito/amministrazione.html
- **Locale:** http://fixcity.local/it/tests/amministrazione
- **JSON:** `config/local/fixcity/database/content/pages/tests.amministrazione.json`
- **Stato:** ⏳ Pending

**Componenti:**
- Breadcrumb
- Section introduction
- Organi grid
- Aree list
- Uffici list
- Enti list

**Documentazione:**
- [Amministrazione Page](./amministrazione.md)
- [Screenshot](../screenshots/amministrazione/)

---

### Documenti Dati

- **Originale:** https://italia.github.io/design-comuni-pagine-statiche/sito/documenti-dati.html
- **Locale:** http://fixcity.local/it/tests/documenti-dati
- **JSON:** `config/local/fixcity/database/content/pages/tests.documenti-dati.json`
- **Stato:** ⏳ Pending

**Componenti:**
- Breadcrumb
- Section introduction
- Documenti list
- Dati aperti section
- Search filter

**Documentazione:**
- [Documenti Dati Page](./documenti-dati.md)
- [Screenshot](../screenshots/documenti-dati/)

---

## 📊 Coverage Map

| Pagina | HTML Identico | Stili Tailwind | Blocchi JSON | Documentazione | Stato |
|--------|--------------|----------------|--------------|----------------|-------|
| Homepage | ⏳ | ⏳ | ⏳ | ⏳ | 🔄 In Progress |
| Argomenti | ⏳ | ⏳ | ⏳ | ⏳ | 🔄 In Progress |
| Appuntamento 06 | ⏳ | ⏳ | ⏳ | ⏳ | ⏳ Pending |
| Amministrazione | ⏳ | ⏳ | ⏳ | ⏳ | ⏳ Pending |
| Documenti Dati | ⏳ | ⏳ | ⏳ | ⏳ | ⏳ Pending |

**Legenda:**
- ✅ Completo
- 🔄 In Progress
- ⏳ Pending
- ❌ Da Correggere

## 📐 Template Pagina

Ogni documentazione pagina DEVE seguire questo template:

```markdown
# [Nome Pagina]

## Panoramica

- **Originale:** URL
- **Locale:** URL
- **JSON:** Percorso
- **Stato:** Stato

## Struttura

### Header
Descrizione header...

### Main Content
Descrizione contenuti principali...

### Footer
Descrizione footer...

## Blocchi Utilizzati

| Tipo | Blade | Dati |
|------|-------|------|
| hero | hero.newscard | {...} |
| card-grid | card-grid.governance | {...} |

## Screenshot

- [Originale](../screenshots/<pagina>/originale.png)
- [Replica](../screenshots/<pagina>/replica.png)
- [Confronto](../screenshots/<pagina>/confronto.png)

## Analisi Differenze

### Header
- ❌ Differenza 1
- ❌ Differenza 2

### Main Content
- ✅ Corretto
- ❌ Differenza 3

## Come Correggere

1. Modificare `style-apply.css`:
   ```css
   .classe {
       @apply ...;
   }
   ```

2. Build:
   ```bash
   npm run build
   npm run copy
   ```

3. Verificare

## Note Tecniche

Note specifiche...

## Documenti Correlati

- [Design Comuni Index](../00-index.md)
- [Block System](../../components/blocks/README.md)
- [Screenshot Analysis](../screenshots/<pagina>/<pagina>.md)
```

## 📎 Risorse

- [Design Comuni Demo](https://italia.github.io/design-comuni-pagine-statiche/)
- [Replication Guide](../replication-guide.md)
- [Block System](../../components/blocks/README.md)
- [Screenshot Index](../screenshots/00-index.md)

---

**Ultimo Aggiornamento:** 2026-04-01  
**Versione:** 1.0  
**Stato:** 🔄 In Progress
