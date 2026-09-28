<?php

declare(strict_types=1);

use function Laravel\Folio\name;

name('home');
?>

{{--
  Home guest FO — Folio only (no HomeController).
  URL CTA inline con localizeURL: mai variabili $loginUrl iniettate da Controller.
--}}
<x-pub_theme::layouts.app
    :title="__('pub_theme::home.heading.title')"
    :meta-description="__('pub_theme::home.meta.description')"
    body-page="homepage"
>
    <style>
        #head-section .btn-hero-primary {
            background-color: #ffffff !important;
            color: #007a52 !important;
            border: 0 !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }
        #head-section .btn-hero-primary:hover,
        #head-section .btn-hero-primary:focus-visible {
            background-color: #f0f0f0 !important;
            color: #005c3d !important;
        }
        #head-section .btn-hero-secondary {
            background-color: rgba(255, 255, 255, 0.14) !important;
            color: #ffffff !important;
            border: 2px solid #ffffff !important;
        }
        #head-section .btn-hero-secondary:hover,
        #head-section .btn-hero-secondary:focus-visible {
            background-color: rgba(255, 255, 255, 0.24) !important;
            color: #ffffff !important;
        }
        #head-section .btn-hero-link {
            color: #ffffff !important;
            text-decoration: underline !important;
            background: transparent !important;
            border: 0 !important;
        }
        #head-section a.home-list-link,
        #head-section a.home-list-link .home-list-link-label {
            display: inline-flex;
            align-items: center;
            min-height: 44px;
            color: #ffffff !important;
            font-weight: 600;
            text-decoration: underline !important;
            text-underline-offset: 0.2em;
        }
        #head-section a.home-list-link {
            gap: 0.5rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
        }
        #head-section a.home-list-link .icon {
            width: 1rem;
            height: 1rem;
            flex: 0 0 auto;
            color: #ffffff !important;
            fill: #ffffff !important;
            stroke: #ffffff !important;
        }
        #head-section a.home-list-link:hover,
        #head-section a.home-list-link:focus-visible {
            color: #ffffff !important;
        }
        #head-section a.home-list-link:focus-visible {
            outline: 3px solid #ffffff;
            outline-offset: 4px;
        }
        #head-section #welcome-heading,
        #head-section .lead,
        #head-section .title-xsmall-semi-bold {
            color: #ffffff !important;
        }
    </style>

    <h1 class="visually-hidden" id="main-container-title">{{ __('pub_theme::home.heading.title') }}</h1>

    <section id="head-section" class="bg-primary py-5" aria-labelledby="welcome-heading">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-12 col-lg-6">
                    <p class="title-xsmall-semi-bold text-uppercase mb-2 opacity-75">{{ __('pub_theme::navigation.site_title') }}</p>
                    <h2 id="welcome-heading" class="title-xxxlarge mb-3">
                        {{ __('pub_theme::home.hero.title') }}
                    </h2>
                    <p class="lead mb-4">
                        {{ __('pub_theme::home.hero.subtitle') }}
                    </p>
                    <div class="d-flex flex-column flex-sm-row flex-wrap gap-2">
                        <a class="btn btn-lg fw-semibold btn-hero-primary" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets/create') }}">
                            {{ __('pub_theme::home.hero.cta_create') }}
                        </a>
                        @auth
                            <a class="btn btn-lg btn-hero-secondary" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/area-personale/pratiche') }}">
                                {{ __('pub_theme::home.hero.cta_practices') }}
                            </a>
                        @else
                            <a class="btn btn-lg btn-hero-secondary" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/auth/login') }}" data-element="personal-area-login">
                                {{ __('pub_theme::home.hero.cta_login') }}
                            </a>
                            <a class="btn btn-lg btn-hero-link px-sm-3" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/auth/register') }}">
                                {{ __('pub_theme::home.hero.cta_register') }}
                            </a>
                        @endauth
                    </div>
                    <a class="home-list-link d-inline-flex mt-3" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets') }}">
                        <span class="home-list-link-label">{{ __('pub_theme::home.map.cta_list') }}</span>
                        <svg class="icon" aria-hidden="true">
                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                        </svg>
                    </a>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="card-body p-0">
                            <map-lit
                                id="home-ticket-map"
                                data-url="{{ url('/api/tickets/geojson') }}"
                                height="clamp(280px, 42vh, 420px)"
                                aria-label="{{ __('pub_theme::home.list.map_aria') }}"
                            ></map-lit>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center flex-wrap gap-2 py-3">
                            <span class="text-secondary small mb-0">{{ __('pub_theme::home.map.caption') }}</span>
                            <a class="read-more" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets') }}">
                                <span class="text">{{ __('pub_theme::home.map.cta_list') }}</span>
                                <svg class="icon" aria-hidden="true">
                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" aria-labelledby="how-it-works-heading">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 col-lg-8">
                    <h2 id="how-it-works-heading" class="title-xxlarge mb-2">{{ __('pub_theme::home.how.title') }}</h2>
                    <p class="text-secondary mb-0">{{ __('pub_theme::home.how.intro') }}</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="card card-bg rounded shadow-sm border-0 h-100">
                        <div class="card-body">
                            <span class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:2.25rem;height:2.25rem" aria-hidden="true">1</span>
                            <h3 class="h5 mb-2">{{ __('pub_theme::home.how.step1_title') }}</h3>
                            <p class="text-secondary mb-0">{{ __('pub_theme::home.how.step1_body') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-bg rounded shadow-sm border-0 h-100">
                        <div class="card-body">
                            <span class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:2.25rem;height:2.25rem" aria-hidden="true">2</span>
                            <h3 class="h5 mb-2">{{ __('pub_theme::home.how.step2_title') }}</h3>
                            <p class="text-secondary mb-0">{{ __('pub_theme::home.how.step2_body') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-bg rounded shadow-sm border-0 h-100">
                        <div class="card-body">
                            <span class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:2.25rem;height:2.25rem" aria-hidden="true">3</span>
                            <h3 class="h5 mb-2">{{ __('pub_theme::home.how.step3_title') }}</h3>
                            <p class="text-secondary mb-0">{{ __('pub_theme::home.how.step3_body') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4 bg-light" aria-labelledby="quick-actions-heading">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-12 col-lg-8">
                    <h2 id="quick-actions-heading" class="h4 mb-1">{{ __('pub_theme::home.list.cta_heading') }}</h2>
                    <p class="text-secondary mb-0">{{ __('pub_theme::home.list.cta_body') }}</p>
                </div>
                <div class="col-12 col-lg-4 text-lg-end">
                    <a class="btn btn-primary btn-lg" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets/create') }}">
                        {{ __('pub_theme::home.list.cta_button') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-pub_theme::layouts.app>
