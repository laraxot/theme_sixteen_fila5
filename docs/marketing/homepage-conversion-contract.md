# Homepage marketing contract

## Purpose

La homepage deve spiegare in pochi secondi il servizio civico e portare l'utente
alla prima azione utile: inviare una segnalazione. La mappa pubblica e il
tracciamento sono prove operative, non elementi decorativi.

## Content rules

- un solo H1, orientato al beneficio e tradotto per ogni lingua supportata;
- una CTA primaria per inviare una segnalazione e una secondaria per esplorare
  le segnalazioni;
- copy breve, concreto e coerente con il dominio civico;
- titolo e description SEO devono descrivere segnalazione, mappa e tracciamento;
- i blocchi restano JSON-driven e riutilizzabili: niente copy specifico della
  homepage dentro i componenti Blade.

## Technical SEO

La pagina pubblica il canonical/hreflang esistente, Open Graph, Twitter Card e
uno schema `WebSite` localizzato. Il layout comune resta il punto unico per i
metadati condivisi; il contenuto della homepage fornisce i valori localizzati.

## Verification

Controllare a 375px, 768px e 1440px: nessun overflow, CTA raggiungibili da
tastiera, H1 unico, link senza 4xx/5xx e description presente nell'head.

## Layout contract

I blocchi hero, mappa, “come funziona” e azioni rapide condividono il
contenitore editoriale Design Comuni, senza utility di larghezza concorrenti.
In questo modo l'intera homepage mantiene un unico asse visivo.

Le azioni rapide mantengono icone contenute, almeno 44px di altezza attivabile,
testo leggibile e layout a colonna sui viewport stretti. Le CTA non possono
sovrapporsi né dipendere da utility Tailwind che il processo di isolamento CSS
potrebbe escludere.
