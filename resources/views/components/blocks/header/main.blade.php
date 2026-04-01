@props(['municipality' => '', 'subtitle' => '', 'search_url' => '#', 'logo_url' => ''])

{{-- Header Main - Bootstrap Italia Style (EXACT REPLICATION) --}}
<div class="it-header-main-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="it-header-main-content-wrapper py-4">
                    <div class="it-brand-wrapper d-flex align-items-center gap-4">
                        <a href="/" class="d-flex align-items-center gap-4 text-decoration-none">
                            {{-- Logo - Circular 80x80 --}}
                            <img src="{{ $logo_url ?: 'https://picsum.photos/80/80' }}" 
                                 alt="Logo" 
                                 class="it-logo rounded-circle" 
                                 width="80" 
                                 height="80"
                                 style="object-fit: cover;">
                            
                            {{-- Brand Text --}}
                            <div class="it-brand-text d-flex flex-column gap-1">
                                <h2 class="it-brand-title h3 mb-0 fw-bold text-dark" style="font-size: 1.5rem; line-height: 1.2;">
                                    {{ $municipality ?: 'NOME DEL COMUNE' }}
                                </h2>
                                @if($subtitle)
                                <p class="it-brand-tagline mb-0 text-muted small" style="font-size: 0.875rem; color: #5d7083;">
                                    {{ $subtitle }}
                                </p>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Search Button (Absolute positioned) --}}
<div class="it-search-wrapper position-absolute top-0 end-0 mt-3 me-3">
    <button class="search-link" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Cerca">
        <svg class="icon icon-white" style="width: 24px; height: 24px;">
            <use href="#it-search"></use>
        </svg>
        <span class="d-none d-lg-block ms-2">Cerca</span>
    </button>
</div>

{{-- Search Modal --}}
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Cerca nel sito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ $search_url }}" method="get">
                    <div class="mb-3">
                        <label for="search-input" class="form-label">Parola chiave</label>
                        <input type="text" class="form-control" id="search-input" placeholder="Cerca una parola chiave">
                    </div>
                    <button type="submit" class="btn btn-primary">Cerca</button>
                </form>
            </div>
        </div>
    </div>
</div>
