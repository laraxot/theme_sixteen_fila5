{{-- Bootstrap Italia Header - EXACT COPY of Design Comuni Template --}}
{{-- https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html --}}

<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <a class="d-lg-block navbar-brand" target="_blank" href="#" aria-label="Vai al portale {Nome della Regione} - link esterno - apertura nuova scheda" title="Vai al portale {Nome della Regione}">Nome della Regione</a>
            <div class="it-header-slim-right-zone" role="navigation">
              <div class="nav-item dropdown">
                <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true">
                  <span class="visually-hidden">Lingua attiva:</span>
                  <span>ITA</span>
                  <svg class="icon">
                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
                  </svg>
                </button>
                <div class="dropdown-menu">
                  <div class="row">
                    <div class="col-12">
                      <div class="link-list-wrapper">
                        <ul class="link-list">
                          <li><a class="dropdown-item list-item" href="#"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
                          <li><a class="dropdown-item list-item" href="#"><span>ENG</span></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <a class="btn btn-primary btn-icon btn-full" href="#" data-element="personal-area-login">
                <span class="rounded-icon" aria-hidden="true">
                  <svg class="icon icon-primary">
                    <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
                  </svg>
                </span>
                <span class="d-none d-lg-block">Accedi all'area personale</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="it-nav-wrapper">
    <div class="it-header-center-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="it-header-center-content-wrapper">
              <div class="it-brand-wrapper">
                <a href="/">
                    <svg width="82" height="82" class="icon" aria-hidden="true">
                      <image xlink:href="/themes/sixteen/assets/images/logo-comune.svg"/>
                    </svg>
                    <div class="it-brand-text">
                      <div class="it-brand-title">Il mio Comune</div>
                      <div class="it-brand-tagline d-none d-md-block">Un comune da vivere </div>
                    </div>
                  </a>
              </div>
              <div class="it-right-zone">
                <div class="it-socials d-flex gap-2">
                  <h4 class="sr-only">Seguici su</h4>
                  <ul class="list-inline m-0">
                    <li class="list-inline-item">
                      <a href="#" aria-label="Twitter" target="_blank">
                        <svg class="icon icon-sm">
                          <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use>
                        </svg>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" aria-label="Facebook" target="_blank">
                        <svg class="icon icon-sm">
                          <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use>
                        </svg>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" aria-label="YouTube" target="_blank">
                        <svg class="icon icon-sm">
                          <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use>
                        </svg>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" aria-label="Telegram" target="_blank">
                        <svg class="icon icon-sm">
                          <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram"></use>
                        </svg>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" aria-label="WhatsApp" target="_blank">
                        <svg class="icon icon-sm">
                          <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp"></use>
                        </svg>
                      </a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" aria-label="RSS" target="_blank">
                        <svg class="icon icon-sm">
                          <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-rss"></use>
                        </svg>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="it-search-wrapper">
                  <span class="d-lg-block sr-only">Cerca nel sito:</span>
                  <form role="search" action="/search" method="get">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Cerca nel sito" aria-label="Cerca nel sito" name="q">
                      <button class="btn" type="submit" aria-label="Cerca">
                        <svg class="icon">
                          <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use>
                        </svg>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="it-header-navbar-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="it-nav-scroll">
              <nav class="navbar navbar-expand-lg" aria-label="Navigazione principale">
                <button class="custom-navbar-toggler navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav-wrapper" aria-controls="header-nav-wrapper" aria-expanded="false" aria-label="Apri/chudi menu">
                  <svg class="icon">
                    <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-burger"></use>
                  </svg>
                </button>
                <div class="collapse navbar-collapse" id="header-nav-wrapper">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="/">
                        <span>Home</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/it/tests/amministrazione">
                        <span>Amministrazione</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/it/tests/novita">
                        <span>Novità</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/it/tests/servizi">
                        <span>Servizi</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/it/tests/eventi">
                        <span>Vivere il Comune</span>
                      </a>
                    </li>
                  </ul>
                </div>
                <nav aria-label="Navigazione secondaria" class="d-none d-lg-block">
                  <ul class="navbar-nav navbar-secondary">
                    <li class="nav-item">
                      <a class="nav-link" href="#">Iscrizioni</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Estate in città</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Polizia locale</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="/it/tests/argomenti" data-element="all-topics">
                        <span>Tutti gli argomenti 
                          <svg class="icon icon-sm">
                            <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-chevron-right"></use>
                          </svg>
                        </span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
