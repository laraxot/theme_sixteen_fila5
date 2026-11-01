<header class="it-header-wrapper" data-mobile-nav-target="#header-nav-wrapper" style="">
    <div class="it-header-slim-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
<div class="it-header-slim-wrapper-content">
               <a class="navbar-brand text-white" target="_blank" href="#" aria-label="{{ __('pub_theme::header.slim.region.portal_aria.label', ['region' => '{'.__('pub_theme::header.slim.region.name.label').'}']) }}" title="{{ __('pub_theme::header.slim.region.portal_title.label', ['region' => '{'.__('pub_theme::header.slim.region.name.label').'}']) }}">{{ __('pub_theme::header.slim.region.name.label') }}</a>
               <div class="it-header-slim-right-zone" role="navigation">
                   <div class="nav-item dropdown">
                       <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true">
                           <span class="visually-hidden">{{ __('pub_theme::header.language.active_prefix.label') }}</span>
                           <span>{{ __('pub_theme::header.language.code_it.label') }}</span>
                           <svg class="icon">
                               <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
                           </svg>
                       </button>
                       <div class="dropdown-menu">
                           <div class="row">
                               <div class="col-12">
                                   <div class="link-list-wrapper">
                                       <ul class="link-list">
                                           <li><a class="dropdown-item list-item" href="#"><span>{{ __('pub_theme::header.language.code_it.label') }} <span class="visually-hidden">{{ __('pub_theme::header.language.selected_suffix.label') }}</span></span></a></li>
                                           <li><a class="dropdown-item list-item" href="#"><span>{{ __('pub_theme::header.language.code_en.label') }}</span></a></li>
                                       </ul>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
          </div>
        </div>
      </div>
    </div>
  
    <div class="it-nav-wrapper" data-mobile-nav>
      <div class="it-header-center-wrapper">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="it-header-center-content-wrapper">
                <div class="it-brand-wrapper">
                  <a href="homepage.html">
                      <svg width="82" height="82" class="icon" aria-hidden="true">
                        <image href="../assets/images/logo-comune.svg"/>
                      </svg>
                      <div class="it-brand-text">
                        <div class="it-brand-title">{{ __('pub_theme::header.center.brand.title.label') }}</div>
                        <div class="it-brand-tagline d-none d-md-block">{{ __('pub_theme::header.center.brand.tagline.label') }} </div>
                      </div>
                    </a>
                </div>
<div class="it-right-zone">
       <div class="it-socials d-none d-lg-flex">
           <span>{{ __('pub_theme::header.center.social.follow.label') }}</span>
           <ul>
               <li>
                   <a href="#" target="_blank">
                       <svg class="icon icon-sm icon-white align-top">
                           <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use>
                       </svg>
                       <span class="visually-hidden">Twitter</span>
                   </a>
               </li>
               <li>
                   <a href="#" target="_blank">
                       <svg class="icon icon-sm icon-white align-top">
                           <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use>
                       </svg>
                       <span class="visually-hidden">Facebook</span>
                   </a>
               </li>
               <li>
                   <a href="#" target="_blank">
                       <svg class="icon icon-sm icon-white align-top">
                           <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use>
                       </svg>
                       <span class="visually-hidden">YouTube</span>
                   </a>
               </li>
               <li>
                   <a href="#" target="_blank">
                       <svg class="icon icon-sm icon-white align-top">
                           <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram"></use>
                       </svg>
                       <span class="visually-hidden">Telegram</span>
                   </a>
               </li>
               <li>
                   <a href="#" target="_blank">
                       <svg class="icon icon-sm icon-white align-top">
                           <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp"></use>
                       </svg>
                       <span class="visually-hidden">Whatsapp</span>
                   </a>
               </li>
               <li>
                   <a href="#" target="_blank">
                       <svg class="icon icon-sm icon-white align-top">
                           <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-rss"></use>
                       </svg>
                       <span class="visually-hidden">RSS</span>
                   </a>
               </li>
           </ul>
       </div>
       <div class="it-search-wrapper d-flex align-items-center">
           <span class="d-none d-md-block">{{ __('pub_theme::header.center.search.label') }}</span>
           <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="{{ __('pub_theme::header.center.search.toggle_aria.label') }}">
               <svg class="icon">
                   <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use>
               </svg>
           </button>
       </div>
       <div class="d-none d-lg-flex">
           <a href="#" class="btn btn-primary btn-icon btn-full" data-element="personal-area-login">
               <span class="rounded-icon" aria-hidden="true">
                   <svg class="icon icon-white">
                       <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
                   </svg>
               </span>
               <span class="d-none d-lg-block">{{ __('pub_theme::header.guest.cta.label') }}</span>
           </a>
       </div>
   </div>
                  <div class="it-search-wrapper">
                    <span class="d-none d-md-block">{{ __('pub_theme::header.center.search.label') }}</span>
                    <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="{{ __('pub_theme::header.center.search.toggle_aria.label') }}">
                      <svg class="icon">
                        <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="it-header-navbar-wrapper" id="header-nav-wrapper" data-mobile-nav>
        <div class="container">
          <div class="row">
            <div class="col-12">
              <!--start nav-->
              <div class="navbar navbar-expand-lg has-megamenu">
                <button class="custom-navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="{{ __('pub_theme::header.center.nav.toggle_aria.label') }}" data-mobile-nav-target="#nav4" data-mobile-nav-toggle>
                  <svg class="icon">
                    <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-burger"></use>
                  </svg>
                </button>
                <div class="navbar-collapsable" data-mobile-nav-panel id="nav4">
                  <div class="overlay" data-mobile-nav-overlay hidden></div>
                  <div class="close-div">
                    <button class="btn close-menu" data-mobile-nav-close type="button">
                      <span class="visually-hidden">{{ __('pub_theme::header.center.nav.close_aria.label') }}</span>
                      <svg class="icon">
                        <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-close-big"></use>
                      </svg>
                    </button>
                  </div>
                  <div class="menu-wrapper">
                    <a href="homepage.html" class="logo-hamburger">
                      <svg class="icon" aria-hidden="true">
                        <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-pa"></use>
                      </svg>
                      <div class="it-brand-text">
                        <div class="it-brand-title">{{ __('pub_theme::header.center.nav.hamburger_brand.label') }}</div>
                      </div>
                    </a>
                    <nav aria-label="{{ __('pub_theme::header.center.nav.primary_aria.label') }}">
                      <ul class="navbar-nav" data-element="main-navigation">
                        <li class="nav-item">
                          <a class="nav-link" href="../sito/amministrazione.html" data-element="management">
                            <span>{{ __('pub_theme::header.center.nav.amministrazione.label') }}</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="../sito/novita.html" data-element="news">
                            <span>{{ __('pub_theme::header.center.nav.novita.label') }}</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="../sito/servizi.html" data-element="all-services">
                            <span>{{ __('pub_theme::header.center.nav.servizi.label') }}</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="../sito/eventi.html" data-element="live">
                            <span>{{ __('pub_theme::header.center.nav.vivere.label') }}14</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                    <nav aria-label="{{ __('pub_theme::header.center.nav.secondary_aria.label') }}">
                      <ul class="navbar-nav navbar-secondary">
                        <li class="nav-item">
                          <a class="nav-link" href="../sito/argomento.html">{{ __('pub_theme::header.center.nav.iscrizioni.label') }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="../sito/argomento.html">{{ __('pub_theme::header.center.nav.estate.label') }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="../sito/argomento.html">{{ __('pub_theme::header.center.nav.polizia.label') }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="argomenti.html" data-element="all-topics">
                            <span>{{ __('pub_theme::header.center.nav.argomenti.label') }} 
                              <svg class="icon icon-sm">
                                <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-chevron-right"></use>
                              </svg>
                            </span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                    <div class="it-socials">
                      <span>{{ __('pub_theme::header.center.social.follow.label') }}</span>
                      <ul>
                        <li>
                          <a href="#" target="_blank">
                            <svg class="icon icon-sm icon-white align-top">
                              <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use>
                            </svg>
                            <span class="visually-hidden">Twitter</span></a>
                        </li>
                        <li>
                          <a href="#" target="_blank">
                            <svg class="icon icon-sm icon-white align-top">
                              <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use>
                            </svg>
                            <span class="visually-hidden">Facebook</span></a>
                        </li>
                        <li>
                          <a href="#" target="_blank">
                            <svg class="icon icon-sm icon-white align-top">
                              <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use>
                            </svg>
                            <span class="visually-hidden">YouTube</span></a>
                        </li>
                        <li>
                          <a href="#" target="_blank">
                            <svg class="icon icon-sm icon-white align-top">
                              <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram"></use>
                            </svg>
                            <span class="visually-hidden">Telegram</span></a>
                        </li>
                        <li>
                          <a href="#" target="_blank">
                            <svg class="icon icon-sm icon-white align-top">
                              <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp"></use>
                            </svg>
                            <span class="visually-hidden">Whatsapp</span></a>
                        </li>
                        <li>
                          <a href="#" target="_blank">
                            <svg class="icon icon-sm icon-white align-top">
                              <use href="../assets/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-rss"></use>
                            </svg>
                            <span class="visually-hidden">RSS</span></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
