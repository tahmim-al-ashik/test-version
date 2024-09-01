<!-- resources/js/Pages/Services/RegisteredServices.vue -->

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registered Services</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div v-if="registeredServices.length > 0">
                        <div v-for="service in registeredServices" :key="service.id">
                            <h3>{{ service.name }}</h3>
                            <div v-if="service.packages.length > 0">
                                <div v-for="pkg in service.packages" :key="pkg.id">
                                    <p><strong>Package:</strong> {{ pkg.name }}</p>
                                    <p><strong>Description:</strong> {{ pkg.description }}</p>
                                    <p><strong>Price:</strong> {{ pkg.price }}</p>
                                </div>
                            </div>
                            <div v-else>
                                <p>No packages registered for this service.</p>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p>You have not registered for any services yet.</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const registeredServices = props.registeredServices || [];
</script>

<style scoped>
/* Add your styles here */
</style>
