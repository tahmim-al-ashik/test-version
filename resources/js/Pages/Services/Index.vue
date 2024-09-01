<!-- resources/js/Pages/Services/Index.vue -->

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const services = props.services;
</script>

<template>
    <Head title="Services"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Services</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="services.length > 0" class="service-container">
                        <div v-for="service in services" :key="service.id" class="service-card">
                            <Link :href="route('services.show', service.id)">
                                <img :src="service.cover_image ? '/storage/' + service.cover_image : '/images/placeholder.png'" alt="Cover Image" />
                                <h2>{{ service.name }}</h2>
                            </Link>
                        </div>
                    </div>
                    <div v-else>
                        <p>No services available.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.service-container {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}

.service-card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 16px;
    text-align: center;
    width: 200px;
}

.service-card img {
    max-width: 100%;
    border-radius: 8px;
}

.service-card h2 {
    margin-top: 8px;
    font-size: 1.2rem;
    color: #1a73e8;
}

.service-card a {
    text-decoration: none;
}

.service-card:hover {
    transform: scale(1.05);
    transition: transform 0.2s;
}
</style>
