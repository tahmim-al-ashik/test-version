<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registered Services</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div v-if="registeredServices.length">
                        <div v-for="service in registeredServices" :key="service.id" class="mb-4 p-4 border rounded">
                            <h3 class="font-bold text-lg">{{ service.name }}</h3>
                            <p class="text-sm text-gray-600">{{ service.description }}</p>
                            <div v-if="service.pivot.package" class="mt-2">
                                <h4 class="font-semibold">Registered Package:</h4>
                                <p>Name: {{ service.pivot.package.name }}</p>
                                <p>Description: {{ service.pivot.package.description }}</p>
                                <p>Price: {{ service.pivot.package.price }}</p>
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
const registeredServices = props.registeredServices;
</script>

<style>
</style>
