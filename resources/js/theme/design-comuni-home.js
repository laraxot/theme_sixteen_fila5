/**
 * Componenti Alpine del blocco homepage Design Comuni (resources/views/components/blocks/homepage.blade.php).
 * Riproducono i comportamenti osservati nella pagina di riferimento senza il suo bundle.
 * Verifica: scripts/homepage-parity-defects.sh (clic + confronto pixel).
 */
import Splide from '@splidejs/splide';

/** Opzioni del carosello calendario, misurate dal riferimento (classe `it-calendar-wrapper`). */
const CALENDAR_OPTIONS = {
    type: 'slide',
    perPage: 4,
    gap: 0,
    padding: { left: 0, right: 0 },
    arrows: false,
    slideFocus: true,
    breakpoints: {
        560: { perPage: 1, padding: { left: 24, right: 24 } },
        768: { perPage: 2 },
        992: { perPage: 3 },
    },
};

export const dcCalendar = () => ({
    init() {
        new Splide(this.$el, CALENDAR_OPTIONS).mount();
    },
});

/**
 * Valutazione a passi: il voto (>3 stelle: domande positive, altrimenti negative) apre il passo 1;
 * "Avanti" scorre i passi, "Indietro" torna indietro; finito l'ultimo passo il form si nasconde.
 */
export const dcRating = () => ({
    step: 0,

    init() {
        this.$el.querySelectorAll('.rating input').forEach((input) => input.addEventListener('change', () => {
            this.deactivate();
            this.hide(this.form());
            this.fieldsets().forEach((fieldset) => this.hide(fieldset));
            this.step = 0;
            if (input.checked) this.next();
        }));
        this.$el.querySelector('.btn-next')?.addEventListener('click', () => { this.deactivate(); this.next(); });
        this.$el.querySelector('.btn-back')?.addEventListener('click', () => { this.deactivate(); this.back(); });
    },

    form: () => document.querySelector('.cmp-rating .form-rating'),
    first() { return this.$el.querySelector('.cmp-rating__card-first'); },
    fieldsets() { return [...this.$el.querySelectorAll('.fieldset-rating-one, .fieldset-rating-two')]; },
    stepCount() { return this.$el.querySelectorAll('[data-step]').length; },
    stepEl(n) { return this.$el.querySelector(`[data-step="${n}"]`); },
    hide: (el) => el.classList.add('d-none'),
    show: (el) => el.classList.remove('d-none'),

    deactivate() {
        const current = this.$el.querySelector('[data-step].active');
        if (current) { this.hide(current); current.classList.remove('active'); }
    },

    next() {
        this.show(this.form());
        const positive = Number(this.$el.querySelector('[name="ratingA"]:checked').value) > 3;
        this.show(this.$el.querySelector(positive ? '.fieldset-rating-one' : '.fieldset-rating-two'));
        const target = this.stepEl(this.step + 1);
        this.show(target);
        target.classList.add('active');
        this.step += 1;
        if (this.step === this.stepCount()) {
            this.hide(this.form());
            this.hide(this.first());
            document.dispatchEvent(new Event('feedback-submit'));
        }
    },

    back() {
        this.show(this.form());
        this.step -= 1;
        if (this.step === 0) {
            this.hide(this.form());
            this.show(this.first());
            this.fieldsets().forEach((fieldset) => this.hide(fieldset));
            this.$el.querySelector('[name="ratingA"]:checked').checked = false;
            return;
        }
        const current = this.stepEl(this.step + 1);
        this.hide(current);
        current.classList.remove('active');
        const previous = this.stepEl(this.step);
        this.show(previous);
        previous.classList.add('active');
    },
});
