/**
 * Alpine.js data factory for the Design Comuni mobile header navigation.
 *
 * Used by deferred `app.js`; must stay in sync with the inline bootstrap in:
 * resources/views/partials/alpine-livewire-bootstrap-header.blade.php
 *
 * Ordering note: Livewire/Filament load Alpine synchronously via @livewireScripts;
 * theme `app.js` is an ES module and runs AFTER Alpine starts. Without the inline
 * bootstrap partial, alpine:init listeners in app.js never fire — x-data lookups fail.
 */
export default function headerMobileNavDataFactory() {
    return {
        mobileNavOpen: false,
        _mq: null,
        init() {
            this._mq = window.matchMedia('(min-width: 992px)');
            const onChange = () => {
                if (this._mq.matches) {
                    this.close();
                }
            };
            this._mq.addEventListener('change', onChange);
        },
        toggle() {
            this.mobileNavOpen = !this.mobileNavOpen;
            document.body.classList.toggle('nav-open', this.mobileNavOpen);
            if (this.mobileNavOpen) {
                this.$nextTick(() => {
                    const firstLink = document.querySelector('#nav4 .menu-wrapper a');
                    if (firstLink) {
                        firstLink.focus();
                    }
                });
            }
        },
        close() {
            this.mobileNavOpen = false;
            document.body.classList.remove('nav-open');
        },
    };
}
