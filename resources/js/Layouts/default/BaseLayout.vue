<!-- resources/js/layouts/services/BaseLayout.vue -->
<template>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <Header />
        <div class="page-body-wrapper">
            <Sidebar />
            <div class="page-body">
                <slot></slot>
            </div>
            <Footer />
        </div>
    </div>
</template>

<script setup>
import Header from './Header.vue';
import Sidebar from './Sidebar.vue';
import Footer from './Footer.vue';
</script>
