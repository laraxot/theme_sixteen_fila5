/**
 * Isola le pagine Design Comuni dalle regole legacy del tema.
 *
 * Il CSS globale accumula regole scritte per pagine precedenti (reset dei bordi su div/span/p, colori forzati, `.btn`,
 * `.card`, `label`...), molte con `!important` o specificita' alta: vincono su qualunque stile del componente. Qui, in build,
 * ogni regola che NON appartiene all'ambito viene limitata agli elementi fuori dall'ambito. `:where()` ha specificita' zero:
 * per le altre pagine nulla cambia. Restano fuori solo le regole che non possono colpire un discendente (`html`, `:root`,
 * `body` soli) e i keyframes.
 *
 * L'AMBITO e' `body:has(.page-content[data-dc])` (attributo messo dal wrapper delle pagine di prova e delle pagine reali con JSON `layout` design-comuni*, vedi DCP-32), lo stesso usato per generare resources/css/design-comuni/components.css
 * (`extract-used-css.mjs --scope '<stesso selettore>'`). Il `<body>` resta plain (policy docs/html-parity-body-policy.md): lo scope
 * dipende dal wrapper `page-content[data-dc]` (presenza dell'attributo: non si confronta nessun valore, quindi i marcatori `|---LINE:n---|` dell'exception renderer
 * di Laravel nella cache delle viste non possono farlo saltare), e copre header, footer, modale e skiplink, che stanno
 * fuori da `page-content` ma dentro lo stesso body. Provato e scartato: una lista di 5 hook (CSS compilato 6,6 MB, parity crollata).
 * Vedi docs/bmad/stories/2026-10-13-dcp-03-legacy-parity-css-cascade-debt.story.md.
 */
const SCOPE = 'body:has(.page-content[data-dc])';
const SCOPE_KEY = 'page-content[data-dc]';
const GUARD = `:not(:where(${SCOPE}, ${SCOPE} *))`;
// Home reale (DCP-51/106): `.fc-home` e' il wrapper della home JSON-driven. I file di parity dei ticket e i `civic-design-*` contengono regole GLOBALI con
// `!important` su elementi nudi (`a{padding:0!important}`, `p{color:#191919!important}`, `h1{color:#1a1a1a!important}`, `.card{padding:0!important}`) che battono lo strato
// della home (`app/16-homepage-civic-reframe.css`): pulsanti senza padding, testo scuro su verde scuro. Dentro `.fc-home` le regole legacy con `!important` non valgono.
// Restano valide le utility Tailwind e il preflight (nessun `!important`), ogni regola con `.fc-` nel selettore (lo strato della home) e i plugin della mappa.
// Il pannello del menu mobile dell'header Design Comuni (`.it-header-wrapper .navbar-collapsable`, DCP-121) ha le sue regole in app/17-dc-chrome-mobile-nav.css (derivate da components.css):
// le regole legacy con `!important` sul pannello (`width:85%!important`, `transform:translate(-100%)!important`, `a{padding:0!important}`) lo lasciavano largo 48 px e fuori schermo.
// L'esenzione vale SOLO mentre il menu e' aperto (`body.nav-open`, messa da theme/header-mobile-nav.js): cioe' solo sotto i 992 px. A pannello chiuso e su desktop il legacy resta com'era
// (provato: esentarlo sempre faceva sparire o sbiadire il menu principale a 1440 px).
const FC_GUARD = ':not(:where(.fc-home *, body.nav-open .it-header-wrapper .navbar-collapsable, body.nav-open .it-header-wrapper .navbar-collapsable *))';
const hasImportant = (rule) => rule.some((node) => node.type === 'decl' && node.important);
// Regole dei plugin della mappa (leaflet.css: `.leaflet-container .leaflet-tile{max-width:none!important}`): sono vendor, non legacy, e senza di esse le tile hanno larghezza 0.
const isOwnFcRule = (rule) => rule.selector.includes('.fc-')
    || rule.selector.includes('.cmp-wizard-widget')
    || rule.selector.includes('.wizard-dc-form-shell')
    || /\.(?:leaflet|marker-cluster)[-\w]*/.test(rule.selector);
const isWizardContractRule = (rule) => rule.selector.includes('.cmp-wizard-widget')
    || rule.selector.includes('.wizard-dc-form-shell');
// Plugin della mappa (leaflet.css, MarkerCluster): CSS vendor che non puo' essere "legacy". Il guard lo spegneva dentro l'ambito Design Comuni, anche senza
// `!important`: `.leaflet-pane` e i tile restavano `position: static`, i tile si impilavano in colonna fuori dal riquadro e la mappa del wizard sembrava rotta
// (DCP-146). Le sue regole valgono quindi anche dentro l'ambito; i nomi non coincidono con quelli del legacy (`.leaflet-*`, `.marker-cluster*`).
const isMapVendorSelector = (selector) => /\.(?:leaflet|marker-cluster)[-\w]*/.test(selector);
// il guard va prima di un eventuale pseudo-elemento finale (`a::before` -> `a:not(...)::before`)
const TRAILING_PSEUDO = /((?:::[\w-]+(?:\([^)]*\))?|:(?:before|after|first-line|first-letter))+)$/;

module.exports = () => ({
    postcssPlugin: 'isolate-legacy-important',
    Once(root) {
        root.walkRules((rule) => {
            if (rule.parent?.type === 'atrule' && /keyframes$/i.test(rule.parent.name)) return;
            // gia' nell'ambito (le regole generate): i passaggi precedenti possono riscrivere virgolette ed escape
            if (rule.selector.replace(/["'\\]/g, '').includes(SCOPE_KEY)) return;
            // regole che colpiscono solo la radice non possono toccare un discendente dell'ambito
            if (rule.selectors.every((selector) => /^(?:html|body|:root)(?:\s*,)?$/.test(selector.trim()))) return;

            // The wizard is a Design Comuni contract rendered inside the
            // data-dc scope; guarding it would disable its own layout rules.
            const guard = isWizardContractRule(rule)
                ? ''
                : hasImportant(rule) && !isOwnFcRule(rule) ? `${GUARD}${FC_GUARD}` : GUARD;
            rule.selectors = rule.selectors.map((selector) => {
                if (isMapVendorSelector(selector)) return selector;
                const trailing = selector.match(TRAILING_PSEUDO);
                return trailing ? `${selector.slice(0, trailing.index)}${guard}${trailing[1]}` : `${selector}${guard}`;
            });
        });
    },
});
module.exports.postcss = true;
module.exports.SCOPE = SCOPE;
