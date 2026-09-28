{{-- Bootstrap Italia Cookiebar Component --}}

<div class="cookiebar" role="alert" aria-live="polite" aria-atomic="true">
    <div class="cookiebar-content">
        <p class="cookiebar-text">
            Questo sito utilizza cookie tecnici, analytics e di terze parti.
            Proseguendo nella navigazione accetti l'utilizzo dei cookie.
        </p>
        <div class="cookiebar-buttons">
            <button type="button" class="btn btn-primary btn-sm cookiebar-accept">
                {{ $acceptText ?? 'Accetta tutti' }}
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm cookiebar-reject">
                {{ $rejectText ?? 'Rifiuta tutti' }}
            </button>
            <button type="button" class="btn btn-link btn-sm cookiebar-customize">
                {{ $customizeText ?? 'Personalizza' }}
            </button>
        </div>
    </div>
</div>
