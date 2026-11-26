# Sixteen behavioral contract index

This is the machine-readable inventory of behavioral contracts owned by the **Sixteen** module.

A contract describes an existing public operation or boundary. It names the owner, input, output, stable invariants, side effects and their order, errors, and non-goals. Every invariant gets a stable ID and a Pest group when a test exists; missing coverage is recorded as debt instead of being implied away.

## Contracts
- [cie-auth-action](cie-auth-action.md)
- [folio-page-shell](folio-page-shell.md)
- [sanitize-return-url-action](sanitize-return-url-action.md)
- [serve-theme-asset-action](serve-theme-asset-action.md)
- [spid-auth-action](spid-auth-action.md)

## Authoring

Use [Xot contract authoring standard](../../../../Modules/Xot/docs/contracts/contract-authoring-standard.md) and the shared template. Legacy behavior is documented as-is and is not a model for new code.
