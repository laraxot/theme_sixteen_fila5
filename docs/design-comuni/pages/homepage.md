# Homepage Replication

> **Replicare la homepage di Design Comuni Italia**

## 📋 Panoramica

- **Originale:** https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
- **Locale:** http://fixcity.local/it/tests/homepage
- **JSON:** `config/local/fixcity/database/content/pages/tests.homepage.json`
- **Route:** `Themes/Sixteen/resources/views/pages/tests/[slug].blade.php`
- **Stato:** 🔄 In Progress

## 🎯 Obiettivi

1. **HTML Identico:** Dentro `<body>` (esclusi script) deve essere identico all'originale
2. **Stili Tailwind:** Replica Bootstrap Italia con @apply
3. **Blocchi Universali:** Suddividere in blocchi riutilizzabili
4. **Header/Footer:** Usare `<x-section slug="header" />` e `<x-section slug="footer" />`

## 🏗️ Struttura Pagina

### Header

**Componenti:**
- Top bar (Regione, Lingua, Area Personale)
- Brand bar (Nome Comune, Social)
- Navigation bar (Menu principale)

**Implementazione:**
```blade
<x-section slug="header" />
```

**Documentazione:** [Header Component](../../components/header.md)

---

### Main Content

#### 1. Hero Newscard

**Blocco:** `hero.newscard`

**JSON:**
```json
{
    "type": "hero",
    "data": {
        "view": "pub_theme::components.blocks.hero.newscard",
        "title": "Contenuti in Evidenza",
        "date": "2024-01-15",
        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit...",
        "link": "/it/tests/news-detail"
    }
}
```

**Documentazione:** [Hero Blocks](../blocks/00-index.md#1-hero-sections)

---

#### 2. Governance Card Grid

**Blocco:** `card-grid.governance`

**JSON:**
```json
{
    "type": "card-grid",
    "data": {
        "view": "pub_theme::components.blocks.card-grid.governance",
        "title": "Amministrazione",
        "cards": [
            {
                "title": "Il Sindaco",
                "description": "Descrizione...",
                "link": "/amministrazione/sindaco"
            },
            {
                "title": "La Giunta",
                "description": "Descrizione...",
                "link": "/amministrazione/giunta"
            },
            {
                "title": "Il Consiglio",
                "description": "Descrizione...",
                "link": "/amministrazione/consiglio"
            }
        ]
    }
}
```

**Documentazione:** [Card Grid Blocks](../blocks/00-index.md#2-card-grid)

---

#### 3. Events List

**Blocco:** `list.events`

**JSON:**
```json
{
    "type": "list",
    "data": {
        "view": "pub_theme::components.blocks.list.events",
        "title": "Eventi",
        "events": [
            {
                "date": "15 GEN",
                "day": "LUN",
                "title": "Evento 1",
                "time": "10:00",
                "location": "Luogo 1"
            },
            {
                "date": "16 MAR",
                "day": "MAR",
                "title": "Evento 2",
                "time": "15:00",
                "location": "Luogo 2"
            }
        ]
    }
}
```

**Documentazione:** [List Blocks](../blocks/00-index.md#4-list)

---

#### 4. Topics Grid

**Blocco:** `topics-grid.default`

**JSON:**
```json
{
    "type": "topics-grid",
    "data": {
        "view": "pub_theme::components.blocks.topics-grid.default",
        "title": "Argomenti in Evidenza",
        "topics": [
            {
                "title": "Trasporti",
                "description": "Informazioni sui trasporti pubblici..."
            },
            {
                "title": "Mobilità",
                "description": "Informazioni sulla mobilità..."
            },
            {
                "title": "Animali domestici",
                "description": "Informazioni sugli animali domestici..."
            },
            {
                "title": "Sport",
                "description": "Informazioni sullo sport..."
            }
        ]
    }
}
```

**Documentazione:** [Topics Grid Blocks](../blocks/00-index.md#3-topics-grid)

---

#### 5. Thematic Sites

**Blocco:** `card-grid.thematic-sites`

**JSON:**
```json
{
    "type": "card-grid",
    "data": {
        "view": "pub_theme::components.blocks.card-grid.thematic-sites",
        "title": "Siti Tematici",
        "cards": [
            {
                "title": "Mobilità",
                "description": "Sito tematico sulla mobilità",
                "link": "https://mobilita.comune.it"
            },
            {
                "title": "Turismo",
                "description": "Sito tematico sul turismo",
                "link": "https://turismo.comune.it"
            },
            {
                "title": "Musei",
                "description": "Sito tematico sui musei",
                "link": "https://musei.comune.it"
            }
        ]
    }
}
```

---

#### 6. Feedback Form

**Blocco:** `form.feedback`

**JSON:**
```json
{
    "type": "form",
    "data": {
        "view": "pub_theme::components.blocks.form.feedback",
        "title": "Quanto sono chiare le informazioni su questa pagina?",
        "rating": 0,
        "questions": [
            {
                "type": "checkbox",
                "label": "Cosa ti è piaciuto?",
                "options": [
                    "Chiaro",
                    "Completo",
                    "Corretta progressione",
                    "Nessun problema tecnico"
                ]
            },
            {
                "type": "checkbox",
                "label": "Quali difficoltà hai riscontrato?",
                "options": [
                    "Poco chiaro",
                    "Incompleto",
                    "Progressione poco chiara",
                    "Problemi tecnici"
                ]
            },
            {
                "type": "text",
                "label": "Dettagli",
                "maxlength": 200,
                "placeholder": "Scrivi qui..."
            }
        ],
        "actions": {
            "back": {
                "label": "Indietro",
                "link": "/"
            },
            "next": {
                "label": "Avanti",
                "action": "submit"
            }
        }
    }
}
```

**Documentazione:** [Form Blocks](../blocks/00-index.md#5-form)

---

### Footer

**Componenti:**
- Contatti (Colonna 1)
- Problemi in Città (Colonna 2)
- Cerca (Colonna 3)
- Sitemap (Amministrazione, Categorie, Novità, Vivere)
- Legal bar (Privacy, Note legali, Accessibilità)

**Implementazione:**
```blade
<x-section slug="footer" />
```

**Documentazione:** [Footer Component](../../components/footer.md)

---

## 📊 Contenuto JSON Completo

**File:** `config/local/fixcity/database/content/pages/tests.homepage.json`

```json
{
    "slug": "tests.homepage",
    "title": "Homepage",
    "blocks": [
        {
            "type": "hero",
            "data": {
                "view": "pub_theme::components.blocks.hero.newscard",
                "title": "Contenuti in Evidenza",
                "date": "2024-01-15",
                "description": "Lorem ipsum dolor sit amet...",
                "link": "/it/tests/news-detail"
            }
        },
        {
            "type": "card-grid",
            "data": {
                "view": "pub_theme::components.blocks.card-grid.governance",
                "title": "Amministrazione",
                "cards": [
                    {
                        "title": "Il Sindaco",
                        "description": "Descrizione...",
                        "link": "/amministrazione/sindaco"
                    },
                    {
                        "title": "La Giunta",
                        "description": "Descrizione...",
                        "link": "/amministrazione/giunta"
                    },
                    {
                        "title": "Il Consiglio",
                        "description": "Descrizione...",
                        "link": "/amministrazione/consiglio"
                    }
                ]
            }
        },
        {
            "type": "list",
            "data": {
                "view": "pub_theme::components.blocks.list.events",
                "title": "Eventi",
                "events": [
                    {
                        "date": "15 GEN",
                        "day": "LUN",
                        "title": "Evento 1",
                        "time": "10:00",
                        "location": "Luogo 1"
                    }
                ]
            }
        },
        {
            "type": "topics-grid",
            "data": {
                "view": "pub_theme::components.blocks.topics-grid.default",
                "title": "Argomenti in Evidenza",
                "topics": [
                    {
                        "title": "Trasporti",
                        "description": "Informazioni..."
                    }
                ]
            }
        },
        {
            "type": "card-grid",
            "data": {
                "view": "pub_theme::components.blocks.card-grid.thematic-sites",
                "title": "Siti Tematici",
                "cards": [
                    {
                        "title": "Mobilità",
                        "link": "https://mobilita.comune.it"
                    }
                ]
            }
        },
        {
            "type": "form",
            "data": {
                "view": "pub_theme::components.blocks.form.feedback",
                "title": "Quanto sono chiare le informazioni?",
                "rating": 0,
                "questions": []
            }
        }
    ]
}
```

---

## 📸 Screenshot & Analisi

### Screenshot

- **Originale:** [../screenshots/homepage/originale.png](../screenshots/homepage/originale.png)
- **Replica:** [../screenshots/homepage/replica.png](../screenshots/homepage/replica.png)
- **Confronto:** [../screenshots/homepage/confronto.png](../screenshots/homepage/confronto.png)

### Analisi Differenze

**File:** [../screenshots/homepage/homepage.md](../screenshots/homepage/homepage.md)

**Differenze Rilevate:**

### Header
- ❌ Logo non visibile
- ❌ Colori diversi (#0066CC vs #003366)
- ❌ Spaziatura: 16px vs 24px

### Hero Section
- ✅ Corretto
- ✅ Stili Tailwind applicati

### Footer
- ❌ Colonne non allineate
- ❌ Font-size: 14px vs 16px

### Come Correggere

1. **Aggiornare `style-apply.css`:**
   ```css
   .it-header-slim-wrapper {
       @apply bg-[#003366]; /* Colore corretto */
       padding: 24px 0; /* Spaziatura corretta */
   }
   
   .it-brand-wrapper img {
       @apply block; /* Assicura visibilità logo */
   }
   
   .footer-column {
       @apply text-base; /* Font-size 16px */
   }
   ```

2. **Build:**
   ```bash
   cd laravel/Themes/Sixteen
   npm run build
   npm run copy
   ```

3. **Verificare:**
   ```bash
   php artisan optimize:clear
   ```
   
   Ricaricare: http://fixcity.local/it/tests/homepage (Ctrl+Shift+R)

---

## ✅ Checklist Implementazione

```markdown
## Pre-Implementazione
- [ ] Studiato pagina originale
- [ ] Identificati blocchi universali
- [ ] Verificato non esistano già

## Creazione JSON
- [ ] Creato `tests.homepage.json`
- [ ] Definiti tutti i blocchi
- [ ] Verificato nodo "slug": "tests.homepage"

## Creazione Blocchi
- [ ] hero.newscard.blade.php
- [ ] card-grid.governance.blade.php
- [ ] list.events.blade.php
- [ ] topics-grid.default.blade.php
- [ ] card-grid.thematic-sites.blade.php
- [ ] form.feedback.blade.php

## Styling
- [ ] Aggiunto style-apply.css
- [ ] Replicate classi Bootstrap Italia
- [ ] Verificato responsive

## Build
- [ ] npm run build completato
- [ ] npm run copy eseguito
- [ ] Manifest generato

## Verifica
- [ ] HTML body identico (View Source)
- [ ] Header corretto
- [ ] Footer corretto
- [ ] Stili corretti
- [ ] Responsive OK

## Documentazione
- [ ] Screenshot originali
- [ ] Screenshot replica
- [ ] Analisi differenze
- [ ] Aggiornato index

## Quality
- [ ] PHPStan: OK
- [ ] Pint: OK
- [ ] Accessibilità: OK
```

---

## 📎 Documenti Correlati

- [Design Comuni Index](../00-index.md)
- [Pages Index](./00-index.md)
- [Block System](../blocks/00-index.md)
- [Replication Guide](../replication-guide.md)
- [Screenshot Analysis](../screenshots/homepage/homepage.md)
- [Header Component](../../components/header.md)
- [Footer Component](../../components/footer.md)

---

**Ultimo Aggiornamento:** 2026-04-01  
**Versione:** 1.0  
**Stato:** 🔄 In Progress
