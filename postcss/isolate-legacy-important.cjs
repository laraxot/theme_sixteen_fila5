/**
 * Isola le pagine Design Comuni (scope `.dc-page`) dalle regole legacy con `!important`.
 *
 * Il CSS globale del tema accumula regole `!important` scritte per pagine precedenti (reset dei bordi su
 * div/span/p, colori forzati, `.btn`, `.card`...): vincono su qualunque stile del componente. Qui, in build,
 * ogni regola con almeno una dichiarazione `!important` che NON appartiene allo scope viene limitata agli
 * elementi fuori da `.dc-page`. `:where()` ha specificita' zero: per le altre pagine nulla cambia.
 * Vedi docs/bmad/stories/2026-10-13-dcp-03-legacy-parity-css-cascade-debt.story.md.
 */
const SCOPE = '.dc-page';
const GUARD = `:not(:where(${SCOPE}, ${SCOPE} *))`;
// il guard va prima di un eventuale pseudo-elemento finale (`a::before` -> `a:not(...)::before`)
const TRAILING_PSEUDO = /((?:::[\w-]+(?:\([^)]*\))?|:(?:before|after|first-line|first-letter))+)$/;

module.exports = () => ({
    postcssPlugin: 'isolate-legacy-important',
    Once(root) {
        root.walkRules((rule) => {
            if (rule.parent?.type === 'atrule' && /keyframes$/i.test(rule.parent.name)) return;
            if (rule.selector.includes(SCOPE)) return;

            let hasImportant = false;
            rule.walkDecls((decl) => {
                if (decl.important) hasImportant = true;
            });
            if (!hasImportant) return;

            rule.selectors = rule.selectors.map((selector) => {
                const trailing = selector.match(TRAILING_PSEUDO);
                return trailing ? `${selector.slice(0, trailing.index)}${GUARD}${trailing[1]}` : `${selector}${GUARD}`;
            });
        });
    },
});
module.exports.postcss = true;
