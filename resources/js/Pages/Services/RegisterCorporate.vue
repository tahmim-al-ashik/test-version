<!-- resources/js/Pages/Services/RegisterCorporate.vue -->
<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { service, corporateData, package_id } = defineProps(['service', 'corporateData', 'package_id']);

const form = useForm({
    ...corporateData,
    package_id,
    name: corporateData?.name || '',
    phone: corporateData?.phone || '',
    postal_code: corporateData?.postal_code || '',
    zip_code: corporateData?.zip_code || '',
    country: corporateData?.country || '',
    city: corporateData?.city || '',
    logo: null,
});

function submit() {
    form.post(route('services.store.corporate', service.id));
}
</script>

<template>
    <Head title="Register Corporate"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Register Corporate</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="package_id" class="block text-gray-700">Package</label>
                            <select v-model="form.package_id" id="package_id" class="mt-1 block w-full" required>
                                <option value="" disabled>Select a package</option>
                                <option v-for="pkg in service.packages" :key="pkg.id" :value="pkg.id">
                                    {{ pkg.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" id="name" v-model="form.name" class="mt-1 block w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Phone</label>
                            <input type="text" id="phone" v-model="form.phone" class="mt-1 block w-full">
                        </div>
                        <div class="mb-4">
                            <label for="postal_code" class="block text-gray-700">Postal Code</label>
                            <input type="text" id="postal_code" v-model="form.postal_code" class="mt-1 block w-full">
                        </div>
                        <div class="mb-4">
                            <label for="zip_code" class="block text-gray-700">Zip Code</label>
                            <input type="text" id="zip_code" v-model="form.zip_code" class="mt-1 block w-full">
                        </div>
                        <div class="mb-4">
                            <label for="country" class="block text-gray-700">Country</label>
                            <input type="text" id="country" v-model="form.country" class="mt-1 block w-full">
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block text-gray-700">City</label>
                            <input type="text" id="city" v-model="form.city" class="mt-1 block w-full">
                        </div>
                        <div class="mb-4">
                            <label for="logo" class="block text-gray-700">Logo</label>
                            <input type="file" id="logo" @change="(e) => form.logo = e.target.files[0]" class="mt-1 block w-full">
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
