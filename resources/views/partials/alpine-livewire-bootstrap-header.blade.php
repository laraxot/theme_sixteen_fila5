{{--
  Bootstrap Alpine PRIMA di @livewireScripts: Livewire/Filament avvia Alpine in modo sincrono;
  theme `resources/js/app.js` è ES module defer → eseguito DOPO lo start Alpine, quindi
  `Alpine.data('headerMobileNav')` dentro app.js sarebbe tardivo e `headerMobileNav` risulta
  undefined nelle direttive iniziali.

  Canonico (DRY logico): stessa factory JS in Themes/Sixteen/resources/js/theme/header-mobile-nav-scope.js
    Aggiorna entrambi i file quando cambi il comportamento.

  geoMapPickerField (legacy / asset stale): alcuni HTML cached o bundle vecchi chiamano
  ancora geoMapPickerField(...) come funzione JS globale mentre il modulo tema è defer:
  questo shim definisce SUBITO una factory no-op-compatibile prima di @livewireScripts;
  `Modules/Geo/resources/js/filament/map-picker.js` la sostituisce quando il bundle è caricato.
--}}
<script>
(function () {
    if (typeof window.geoMapPickerField === 'function') {
        return;
    }

    window.geoMapPickerField = function geoMapPickerFieldShim(config) {
        console.warn('[Sixteen] shim geoMapPickerField: eseguire `npm run build` in Themes/Sixteen e pubblicare public/ dal manifest aggiornato se questo messaggio è frequente.');
        config = config || {};
        var noop = function noop() {};

        var lat =
            config.state != null ? config.state.latitude : config.latitude;
        var lng =
            config.state != null ? config.state.longitude : config.longitude;

        return {
            latitude: lat ?? null,
            longitude: lng ?? null,
            geolocateWhenEmpty: config.geolocateWhenEmpty,
            reverseGeocoding: config.reverseGeocoding,
            zoom: config.zoom,
            formattedAddress: '',
            statusLabel: 'Caricamento mappa…',
            hasServerErrors: !!config.hasServerErrors,
            isSyncingFromMap: false,
            reverseGeocodeTimer: null,
            lastMapSignature: null,
            unwatchState: null,
            init: noop,
            handleCoordsChanged: noop,
            syncToMap: noop,
            performReverseGeocoding: noop,
            scheduleReverseGeocoding: noop,
            coordinatesAreValid: function coordinatesAreValid() {
                return false;
            },
            get latitudeValid() {
                return false;
            },
            get longitudeValid() {
                return false;
            },
            updateStatus: noop,
            inputClass: function inputClass() {
                return {};
            },
            statusDotClass: function statusDotClass() {
                return 'bg-gray-400';
            },
        };
    };
})();
</script>
<script>
(function () {
    document.addEventListener('alpine:init', () => {
        Alpine.data('headerMobileNav', () => ({
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
        }));
    });
})();
</script>
