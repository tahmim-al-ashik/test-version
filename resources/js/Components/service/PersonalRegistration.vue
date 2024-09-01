<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const service = props.service;
const personalData = props.personalData;

const form = useForm({
    package_id: '',
    name: personalData.name || '',
    email: personalData.email || '',
    phone: personalData.phone || '',
    additional_email: personalData.additional_email || '',
    postal_code: personalData.postal_code || '',
    zip_code: personalData.zip_code || '',
    country: personalData.country || '',
    city: personalData.city || '',
});

const selectedPackageId = ref(form.package_id); // New ref to store selected package ID

function submit() {
    console.log('Submitting form with package_id:', form.package_id); // Debugging line
    form.post(route('services.store.personal', { service: service.id }), {
        onSuccess: () => {
            form.reset();
            selectedPackageId.value = ''; // Reset selected package ID
        }
    });
}

watch(form, (newForm) => {
    selectedPackageId.value = newForm.package_id;
});
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Personal Registration</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div v-if="selectedPackageId">Selected Package ID: {{ selectedPackageId }}</div> <!-- Display selected package ID -->
                        <div>
                            <label for="package_id">Package</label>
                            <select v-model="form.package_id" id="package_id" required>
                                <option value="" disabled>Select a package</option>
                                <option v-for="pkg in service.packages" :key="pkg.id" :value="pkg.id">{{ pkg.name }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="name">Name</label>
                            <input v-model="form.name" type="text" id="name" required />
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input v-model="form.email" type="email" id="email" required />
                        </div>
                        <div>
                            <label for="phone">Phone</label>
                            <input v-model="form.phone" type="text" id="phone" required />
                        </div>
                        <div>
                            <label for="additional_email">Additional Email</label>
                            <input v-model="form.additional_email" type="email" id="additional_email" />
                        </div>
                        <div>
                            <label for="postal_code">Postal Code</label>
                            <input v-model="form.postal_code" type="text" id="postal_code" />
                        </div>
                        <div>
                            <label for="zip_code">Zip Code</label>
                            <input v-model="form.zip_code" type="text" id="zip_code" />
                        </div>
                        <div>
                            <label for="country">Country</label>
                            <input v-model="form.country" type="text" id="country" />
                        </div>
                        <div>
                            <label for="city">City</label>
                            <input v-model="form.city" type="text" id="city" />
                        </div>
                        <button type="submit">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
/* Add your styles here */
</style>
