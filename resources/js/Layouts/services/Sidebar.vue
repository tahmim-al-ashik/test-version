<!-- resources/js/layouts/services/Sidebar.vue -->
<template>
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
                                <span class="">Create Service</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
</script>

<style scoped>
.service-icon {
    margin-right: 12px; /* Adjust the value as needed */
}
</style>
