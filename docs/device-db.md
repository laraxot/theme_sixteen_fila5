# Device DB — Sorgente errore fixcity_data vs user
Scopo: mantenere dispositivi su DB separato (user) per sicurezza multi-tenant.
Azione: tabella devices su fixcity_user, BaseModel connection=user, docs aggiornate.
