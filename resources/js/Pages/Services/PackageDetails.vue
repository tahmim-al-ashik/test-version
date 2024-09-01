<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Package Details</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div v-if="pkg">
                        <h3>{{ pkg.name }}</h3>
                        <p><strong>Description:</strong> {{ pkg.description }}</p>
                        <p><strong>Price:</strong> {{ pkg.price }}</p>
                        <p><strong>Service:</strong> {{ pkg.service.name }}</p>
                        <!-- Add other package details and functionalities as per your design -->
                    </div>
                    <div v-else>
                        <p>Package details not found.</p>
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
const pkg = props.package;
</script>

<style scoped>
/* Add your styles here */
</style>
