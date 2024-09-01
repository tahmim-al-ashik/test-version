<!-- resources/js/Pages/Services/RegisterService.vue -->
<template>
    <div>
        <h2>Registered Services</h2>
        <div v-if="registeredPackages.length">
            <ul>
                <li v-for="pkg in registeredPackages" :key="pkg.id">
                    <strong>Service:</strong> {{ pkg.service.name }} <br>
                    <strong>Package:</strong> {{ pkg.name }}
                </li>
            </ul>
        </div>
        <div v-else>
            <p>You have not registered for any services yet.</p>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const registeredPackages = props.registeredPackages;
</script>

<style scoped>
/* Add your styles here */
</style>
