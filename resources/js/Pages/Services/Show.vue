<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/service/Modal.vue';

const { props } = usePage();
const service = props.service;
const packages = props.packages;
const userPackage = props.userPackage;
const registrationType = props.registrationType;

const showModal = ref(false);
const registerType = ref(null);
const selectedPackageId = ref(null);

function openModal(type, packageId) {
    registerType.value = type;
    selectedPackageId.value = packageId;
    showModal.value = true;
}

function registerService() {
    if (registerType.value === 'personal') {
        router.visit(route('services.register.personal', { service: service.id, package_id: selectedPackageId.value }));
    } else if (registerType.value === 'corporate') {
        router.visit(route('services.register.corporate', { service: service.id, package_id: selectedPackageId.value }));
    }
    showModal.value = false;
}

function redirectToInvoice(packageId) {
    if (userPackage && userPackage.pivot.package_id === packageId) {
        if (service.id === 1) {
            router.visit(route('package.invoice', { service: service.id, package: packageId }));
        } else {
            router.visit(route('package.details', { service: service.id, package: packageId }));
        }
    }
}
</script>

<template>
    <Head title="Service Details"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Service Details</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div v-if="userPackage">
                        <p v-if="registrationType === 'personal'">
                            You have registered as personal for <strong>{{ userPackage.pivot.package_name }}</strong> package
                        </p>
                        <p v-else-if="registrationType === 'corporate'">
                            You have registered as corporate for <strong>{{ userPackage.pivot.package_name }}</strong> package
                        </p>
                    </div>
                    <div v-else>
                        <p>You have not registered for any package</p>
                    </div>
                    <div class="service-packages">
                        <div v-for="pkg in packages" :key="pkg.id" class="package-card">
                            <img :src="pkg.image ? '/storage/' + pkg.image : '/images/placeholder.png'" alt="Package Image" />
                            <h3>{{ pkg.name }}</h3>
                            <p>{{ pkg.description }}</p>
                            <p>Price: {{ pkg.price }}</p>
                            <button v-if="!userPackage || userPackage.pivot.package_id !== pkg.id" @click="openModal('personal', pkg.id)">Register Personal</button>
                            <button v-if="!userPackage || userPackage.pivot.package_id !== pkg.id" @click="openModal('corporate', pkg.id)">Register Corporate</button>
                            <button v-if="userPackage && userPackage.pivot.package_id === pkg.id" @click="redirectToInvoice(pkg.id)">Go to Package</button>
                        </div>
                    </div>
                    <h3 class="mt-4">Description of the service</h3>
                    <p>{{ service.description }}</p>
                </div>
            </div>
        </div>

        <!-- Modal for Registering Service -->
        <Modal v-if="showModal" @close="showModal = false">
            <template #header>
                Register Service
            </template>
            <template #body>
                <button @click="registerService('personal')">Personal Use</button>
                <button @click="registerService('corporate')">Corporate Use</button>
            </template>
        </Modal>
    </AuthenticatedLayout>
</template>

<style>
.service-packages {
    display: flex;
    gap: 16px;
}

.package-card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 16px;
    text-align: center;
    width: 200px;
    background-color: #e0f7fa;
}

.package-card img {
    max-width: 100%;
    border-radius: 8px;
}

.modal {
    display: block;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
