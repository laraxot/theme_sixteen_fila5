/**
 * Isola le pagine Design Comuni dalle regole legacy del tema.
 *
 * Il CSS globale accumula regole scritte per pagine precedenti (reset dei bordi su div/span/p, colori forzati, `.btn`,
 * `.card`, `label`...), molte con `!important` o specificita' alta: vincono su qualunque stile del componente. Qui, in build,
 * ogni regola che NON appartiene all'ambito viene limitata agli elementi fuori dall'ambito. `:where()` ha specificita' zero:
 * per le altre pagine nulla cambia. Restano fuori solo le regole che non possono colpire un discendente (`html`, `:root`,
 * `body` soli) e i keyframes.
 *
 * L'AMBITO e' `body:has(.page-content[data-slug*="tests."])`, lo stesso usato per generare resources/css/design-comuni/components.css
 * (`extract-used-css.mjs --scope '<stesso selettore>'`). Il `<body>` resta plain (policy docs/html-parity-body-policy.md): lo scope
 * dipende dal wrapper canonico `page-content[data-slug]` delle pagine /tests (`*=` e non `^=`: l'exception renderer di Laravel, `BladeMapper`, dopo un errore
 * lascia nella cache delle viste dei marcatori `|---LINE:n---|` anche dentro gli attributi, e il prefisso farebbe saltare lo scope), e copre header, footer, modale e skiplink, che stanno
 * fuori da `page-content` ma dentro lo stesso body. Provato e scartato: una lista di 5 hook (CSS compilato 6,6 MB, parity crollata).
 * Vedi docs/bmad/stories/2026-10-13-dcp-03-legacy-parity-css-cascade-debt.story.md.
 */
const SCOPE = 'body:has(.page-content[data-slug*="tests."])';
const SCOPE_KEY = 'page-content[data-slug*=tests.]';
const GUARD = `:not(:where(${SCOPE}, ${SCOPE} *))`;
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

            rule.selectors = rule.selectors.map((selector) => {
                const trailing = selector.match(TRAILING_PSEUDO);
                return trailing ? `${selector.slice(0, trailing.index)}${GUARD}${trailing[1]}` : `${selector}${GUARD}`;
            });
        });
    },
});
module.exports.postcss = true;
module.exports.SCOPE = SCOPE;
