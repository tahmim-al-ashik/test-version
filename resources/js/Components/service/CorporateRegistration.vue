<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const { props } = usePage();
const service = props.service;

const form = useForm({
    name: '',
    phone: '',
    postal_code: '',
    zip_code: '',
    country: '',
    city: '',
    logo: null,
    service_id: service.id,
    package_id: null,
});

function submit() {
    form.post(route('services.saveCorporate'), {
        onSuccess: () => {
            form.reset();
        }
    });
}
</script>

<template>
    <Head title="Corporate Registration"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Corporate Registration</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" v-model="form.name" class="mt-1 block w-full" id="name" required>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" v-model="form.phone" class="mt-1 block w-full" id="phone" required>
                        </div>
                        <div class="mb-4">
                            <label for="postal_code" class="block text-sm font-medium text-gray-700">Postal Code</label>
                            <input type="text" v-model="form.postal_code" class="mt-1 block w-full" id="postal_code" required>
                        </div>
                        <div class="mb-4">
                            <label for="zip_code" class="block text-sm font-medium text-gray-700">Zip Code</label>
                            <input type="text" v-model="form.zip_code" class="mt-1 block w-full" id="zip_code" required>
                        </div>
                        <div class="mb-4">
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <input type="text" v-model="form.country" class="mt-1 block w-full" id="country" required>
                        </div>
                        <div class="mb-4">
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" v-model="form.city" class="mt-1 block w-full" id="city" required>
                        </div>
                        <div class="mb-4">
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                            <input type="file" @change="e => form.logo = e.target.files[0]" class="mt-1 block w-full" id="logo">
                        </div>
                        <div class="mb-4">
                            <label for="package_id" class="block text-sm font-medium text-gray-700">Package</label>
                            <select v-model="form.package_id" class="mt-1 block w-full" id="package_id" required>
                                <option v-for="pkg in service.packages" :key="pkg.id" :value="pkg.id">{{ pkg.name }}</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
