# Theme Sixteen - Product Requirements Document (PRD)

> Documento vivente. Tema istituzionale/design system.
> Stato stimato: 68% implementato, 32% da consolidare.

## 1. Purpose & Vision

**Sixteen** e' il tema orientato a una UX istituzionale e accessibile, basata su pattern della PA italiana e componenti di design system ricchi.

**Visione**: tema ad alta conformita', riusabile e accessibile, adatto a contesti pubblici o strutturati dove coerenza, chiarezza e compliance sono centrali.

## 2. Problem Statement

Senza Sixteen:
- manca un tema istituzionale forte e ad alta accessibilita'
- i moduli non dispongono di una superficie coerente per componenti PA-oriented
- i requisiti AGID/WCAG diventano lavoro manuale disperso

## 3. Target Users

| User | Ruolo | Bisogni |
|------|-------|---------|
| **Ente/organizzazione** | Usa layout istituzionali | Chiarezza, compliance, componenti standard |
| **Sviluppatore tema** | Estende il design system | Componenti e token coerenti |
| **Utente finale** | Naviga servizi e contenuti | Accessibilita' e fiducia |

## 4. Scope

### In Scope
- Layout e componenti accessibili
- Integrazione design system istituzionale
- Responsive design e navigazione semantica
- Documentazione d'uso e personalizzazione

### Out of Scope
- Trading UI avanzata del prediction market
- Admin Filament come tema principale del pannello

## 5. Functional Requirements

### P0
- **FR-001**: Offrire componenti accessibili e riusabili.
- **FR-002**: Supportare layout istituzionali e contenuti informativi.
- **FR-003**: Garantire responsive design solido.

### P1
- **FR-004**: Rendere configurabili token, palette e branding.
- **FR-005**: Ridurre il gap verso AGID/WCAG documentato.

## 6. Non-Functional Requirements

- **NFR-001**: Accessibilita' prima di estetica accessoria.
- **NFR-002**: Compatibilita' con Cms e contenuti modulari.
- **NFR-003**: Performance accettabili su pagine informative complesse.

## 7. Current State & Gaps

### Stato reale al 2026-03-12
- Libreria componenti ampia: **75%**
- Allineamento accessibilita' e compliance documentata: **65%**
- Surface pronta per prediction market: **30%**

### Gap prioritari
- chiudere i gap documentati nella analisi AGID
- migliorare integrazione con i blocchi CMS moderni
- separare meglio casi d'uso istituzionali da casi prediction market

## 8. Success Metrics

| Metrica | Target |
|--------|--------|
| Componenti chiave con varianti accessibili | 100% |
| Gap AGID critici aperti | < 10% |
| Compatibilita' Cms/theme | 100% |

## 9. References

- [agid/complete-agid-compliance-analysis.md](agid/complete-agid-compliance-analysis.md)
- [PRD Indice Centrale](../../../project_docs/PRD_INDEX_2026_03_12.md)

## Testing & Coverage

- test visuali e accessibilita' sui componenti critici
- verifica responsive su layout principali
