---
id: laraxot-bmad-story-gdpr-registration-pa
type: epic-story
status: open
priority: critical
tags: [gdpr, registration, pa, legal-basis, consent, unsubscribe, second-brain, design-comuni]
github_issue: "#56"
discussion: "https://github.com/italia/design-comuni"
rights_owner: "laravel/Modules/Gdpr"
related_to: ["STORY-cookiebar-gdpr-compliance", "STORY-adozione-linee-guida-design-pa"]
title: "BMAD Story — Registrazione Utente conforme GDPR per PA"
updated: 2026-10-15
qmd: "bmad story   registrazione utente conforme gdpr per pa sixteen"
---

# BMAD Story — Registrazione Utente conforme GDPR per PA

## Scopo

Definire il flusso di registrazione dell'utente che sia a norma di legge (GDPR Art. 6, 7, 17; Regolamento UE 2016/679; Linee Guida Design PA) e trasmissibile alla Pubblica Amministrazione.

## Requisiti legali (non negoziabili)

- **Base giuridica (Art. 6)**: `consenso` esplicito o `contratto` — per la registrazione utente il consenso deve essere liberamente dato, specifico, informato e revocabile.
- **Informativa (Art. 13/14)**: link alla privacy policy (`route('pages.view', ['slug'=>'privacy'])`) visibile prima del checkbox.
- **Checkbox consenso (Art. 7)**: NON pre-selezionato; testo chiaro (es. "Accetto il trattamento dati ai sensi dell'informativa privacy"); separato dalla registrazione se il trattamento è per marketing.
- **Accesso e cancellazione (Art. 15–17)**: diritto di accesso, rettifica, cancellazione (`data_subject_rights` in Gdpr config: access/rectification/erasure/portability in 30 giorni).
- **Disiscrizione / revoca**: funzione `unsubscribe` o `revoke-consent`; il consenso deve essere revocabile con la stessa facilità con cui è stato dato.
- **Conservazione**: `retention.user_data.personal = 365*5` (5 anni) — ma solo per dati effettivamente necessari; cancellazione immediata se revoca.
- **Cookie / consenso marketing**: coerente con `cookie.consast_lifetime = 180` giorni (Garante provv. 10.6.2021 n. 231 — non riproporre banner prima 6 mesi).
- **DPO**: `dpo.name/email/phone` configurato.

## Regole operativi dal progetto

- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite — NO Bootstrap Italia.
- Multilingua tramite `gdpr::cookie.*` / `gdpr::registration.*`.
- Componente registrazione deve usare `@props` per categoria del consenso, fallback a `config('gdpr.consent')`.
- Link relativi a `30-documentation-standards.md` e `55-md-conventions.md`.
- Second brain: `kp-gdpr-registration-pa`.

## Verifica checklist (pre-release)

- [ ] Checkbox NON pre-tickato
- [ ] Testo consenso esplicito (non implicito con il click su "Registrati")
- [ ] Link informativa privacy presente e funzionante
- [ ] Pulsante "Disiscriviti" / "Revoca consenso" in area personale
- [ ] `localStorage.cookie_consent` coerente con preferenze
- [ ] `cookie.consent_lifetime = 180` rispettato
- [ ] Audit visivo con Playwright (375/768/1440)
- [ ] Contrasto APCA Lc ≥75
- [ ] `audit-prompts.sh` pulito (slugs corretti)

## Note tecniche

- `Modules/Gdpr/config/config.php` già ha: `consent`, `data_subject_rights`, `processing_register`, `security_measures`, `dpo`.
- `Modules/Gdpr/lang/` ha `it/en/de` — estendere con chiavi `registration.consent`, `registration.unsubscribe`, `registration.info_link`.
- Component: ricalibrare su `Http/Livewire/Auth/Register.php` o nuovo componente Blade in `pub_theme/components/`.
