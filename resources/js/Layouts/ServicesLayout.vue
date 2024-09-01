<!-- resources/js/Layouts/ServicesLayout.vue -->
<template>
    <div>
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <form class="form-inline search-full col" action="#" method="get">
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative">
                                <input
                                    class="demo-input Typeahead-input form-control-plaintext w-100"
                                    type="text"
                                    placeholder="Search..."
                                    name="q"
                                    title=""
                                    autofocus
                                />
                                <div class="spinner-border Typeahead-spinner" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <i class="close-search" data-feather="x"></i>
                            </div>
                            <div class="Typeahead-menu"></div>
                        </div>
                    </div>
                </form>
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper">
                        <a href="/">
                            <img class="img-fluid for-light" src="/template/assets/images/logo/logo.png" alt="" />
                        </a>
                    </div>
                    <div class="toggle-sidebar">
                        <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                    </div>
                </div>
                <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
                    <div class="notification-slider">
                        <div class="d-flex h-100">
                            <img src="/template/assets/images/giftools.gif" alt="gif" />
                            <h6 class="mb-0 f-w-400">
                                <span class="font-primary">Don't Miss Out! </span>
                                <span class="f-light">New updates are available.</span>
                            </h6>
                            <i class="icon-arrow-top-right f-light"></i>
                        </div>
                        <div class="d-flex h-100">
                            <img src="/template/assets/images/giftools.gif" alt="gif" />
                            <h6 class="mb-0 f-w-400">
                                <span class="f-light">Something you love is on sale! </span>
                            </h6>
                            <a class="ms-1" href="https://1.envato.market/3GVzd" target="_blank">Buy now!</a>
                        </div>
                    </div>
                </div>
                <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                    <ul class="nav-menus">
                        <li class="language-nav">
                            <div class="translate_wrapper">
                                <div class="current_lang">
                                    <div class="lang">
                                        <i class="flag-icon flag-icon-us"></i><span class="lang-txt">EN</span>
                                    </div>
                                </div>
                                <div class="more_lang">
                                    <div class="lang selected" data-value="en">
                                        <i class="flag-icon flag-icon-us"></i><span class="lang-txt">English<span> (US)</span></span>
                                    </div>
                                    <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i><span class="lang-txt">Deutsch</span></div>
                                    <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span class="lang-txt">Español</span></div>
                                    <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span class="lang-txt">Français</span></div>
                                    <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span class="lang-txt">Português<span> (BR)</span></span></div>
                                    <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span class="lang-txt">简体中文</span></div>
                                    <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div>
                                </div>
                            </div>
                        </li>
                        <li class="profile-nav onhover-dropdown pe-0 py-0">
                            <div class="media profile-media">
                                <img class="b-r-10" src="/template/assets/images/dashboard/profile.png" alt="" />
                                <div class="media-body">
                                    <span>{{ user.name }}</span>
                                    <p class="mb-0">{{ user.role.value }} <i class="middle fa fa-angle-down"></i></p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li>
                                    <a :href="route('profile.edit')">
                                        <i data-feather="user"></i><span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" :action="route('logout')">
                                        @csrf
                                        <button type="submit" class="btn btn-link logout-button">
                                            <i data-feather="log-out"></i><span>Log Out</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Sidebar -->
        <div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
            <div>
                <div class="logo-wrapper">
                    <a :href="route('services')">
                        <img class="img-fluid for-light" src="/template/assets/images/logo/logo.png" alt="" />
                        <img class="img-fluid for-dark" src="/assets/images/logo/logo_dark.png" alt="" />
                    </a>
                </div>
                <div class="logo-icon-wrapper">
                    <a :href="route('services')">
                        <img class="img-fluid" src="/template/assets/images/logo/logo-icon.png" alt="" />
                    </a>
                </div>
                <nav class="sidebar-main">
                    <div id="sidebar-menu">
                        <ul class="sidebar-links" id="simple-bar">
                            <li class="back-btn">
                                <a :href="route('services')">
                                    <img class="img-fluid" src="/template/assets/images/logo/logo-icon.png" alt="" />
                                </a>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" :href="route('services')">
                                    <svg class="stroke-icon">
                                        <use href="/template/assets/svg/icon-sprite.svg#stroke-home"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="/template/assets/svg/icon-sprite.svg#fill-home"></use>
                                    </svg>
                                    <span class="lan-3">Services</span>
                                </a>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title" :href="route('services.create')">
                                    <i class="icon-package service-icon"></i>
                                    <span>Create Service</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="right-arrow" id="right-arrow">
                        <i data-feather="arrow-right"></i>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Main Content -->
        <div class="page-body-wrapper">
            <div class="page-body">
                <slot></slot>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">Copyright 2023 © JsKraft theme by pixelstrap</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
const { user } = usePage().props.auth;
</script>

<style scoped>
.service-icon {
    margin-right: 12px; /* Adjust the value as needed */
}
</style>
