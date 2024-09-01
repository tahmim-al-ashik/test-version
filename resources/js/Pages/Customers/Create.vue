<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Customer</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="create-customer-container">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="customer_no">Customer No</label>
                            <input type="text" v-model="currentCustomerNo" disabled>
                        </div>
                        <div>
                            <label for="customer_name">Customer Name</label>
                            <input type="text" v-model="form.customer_name" required>
                        </div>
                        <div>
                            <label for="customer_type">Customer Type</label>
                            <input type="text" v-model="form.customer_type" required>
                        </div>
                        <div>
                            <label for="personal_id">Personal/Corporate ID No</label>
                            <input type="text" v-model="form.personal_id" required>
                        </div>
                        <div>
                            <label for="address">Address</label>
                            <input type="text" v-model="form.address" required>
                        </div>
                        <div>
                            <label for="postcode">Postcode</label>
                            <input type="text" v-model="form.postcode" required>
                        </div>
                        <div>
                            <label for="city">City</label>
                            <input type="text" v-model="form.city" required>
                        </div>
                        <div>
                            <label for="gln">GLN</label>
                            <input type="text" v-model="form.gln">
                        </div>
                        <div>
                            <label for="vat_no">VAT No</label>
                            <input type="text" v-model="form.vat_no">
                        </div>
                        <div>
                            <label for="phone_no">Phone No</label>
                            <input type="text" v-model="form.phone_no">
                        </div>
                        <div>
                            <label for="mobile_no">Mobile No</label>
                            <input type="text" v-model="form.mobile_no">
                        </div>
                        <div>
                            <label for="email_invoice">E-mail Invoice</label>
                            <input type="text" v-model="form.email_invoice">
                        </div>
                        <div>
                            <label for="email_cc">E-mail CC</label>
                            <input type="text" v-model="form.email_cc">
                        </div>
                        <div>
                            <label for="website">Website</label>
                            <input type="text" v-model="form.website">
                        </div>
                        <div>
                            <label for="country_id">Country</label>
                            <select v-model="form.country_id" required>
                                <option v-for="country in countries" :value="country.id" :key="country.id">
                                    {{ country.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="language_id">Sales Document Language</label>
                            <select v-model="form.language_id" required>
                                <option v-for="language in languages" :value="language.id" :key="language.id">
                                    {{ language.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="currency_id">Currency</label>
                            <select v-model="form.currency_id" required>
                                <option v-for="currency in currencies" :value="currency.id" :key="currency.id">
                                    {{ currency.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="references">References</label>
                            <div v-for="(reference, index) in form.references" :key="index" class="mb-2">
                                <input type="text" v-model="reference.name" placeholder="Name" required>
                                <input type="email" v-model="reference.email" placeholder="Email" required>
                                <input type="text" v-model="reference.phone_no" placeholder="Phone No" required>
                                <input type="text" v-model="reference.mobile_no" placeholder="Mobile No" required>
                                <button type="button" @click="removeReference(index)">Remove</button>
                            </div>
                            <button type="button" @click="addReference">Add Reference</button>
                        </div>
                        <div>
                            <label for="delivery_requirements">Delivery Requirements</label>
                            <div v-for="(requirement, index) in form.delivery_requirements" :key="index" class="mb-2">
                                <input type="text" v-model="requirement.terms_of_delivery" placeholder="Terms of Delivery" required>
                                <input type="text" v-model="requirement.delivery_method" placeholder="Delivery Method" required>
                                <button type="button" @click="removeDeliveryRequirement(index)">Remove</button>
                            </div>
                            <button type="button" @click="addDeliveryRequirement">Add Delivery Requirement</button>
                        </div>
                        <div>
                            <label for="payment_requirements">Payment Requirements</label>
                            <div v-for="(requirement, index) in form.payment_requirements" :key="index" class="mb-2">
                                <input type="text" v-model="requirement.terms_of_payment" placeholder="Terms of Payment" required>
                                <input type="text" v-model="requirement.currency" placeholder="Currency" required>
                                <input type="text" v-model="requirement.pay_to_account" placeholder="Pay to Account" required>
                                <input type="text" v-model="requirement.customer_discount" placeholder="Customer Discount" required>
                                <button type="button" @click="removePaymentRequirement(index)">Remove</button>
                            </div>
                            <button type="button" @click="addPaymentRequirement">Add Payment Requirement</button>
                        </div>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';

const { props } = usePage();
const countries = props.countries;
const languages = props.languages;
const currencies = props.currencies;
const currentCustomerNo = props.currentCustomerNo; // Added to display current customer number

const form = ref({
    customer_name: '',
    customer_type: '',
    personal_id: '',
    address: '',
    postcode: '',
    city: '',
    gln: '',
    vat_no: '',
    phone_no: '',
    mobile_no: '',
    email_invoice: '',
    email_cc: '',
    website: '',
    country_id: '',
    language_id: '',
    currency_id: '',
    references: [],
    delivery_requirements: [],
    payment_requirements: []
});

function addReference() {
    form.value.references.push({
        name: '',
        email: '',
        phone_no: '',
        mobile_no: ''
    });
}

function removeReference(index) {
    form.value.references.splice(index, 1);
}

function addDeliveryRequirement() {
    form.value.delivery_requirements.push({
        terms_of_delivery: '',
        delivery_method: ''
    });
}

function removeDeliveryRequirement(index) {
    form.value.delivery_requirements.splice(index, 1);
}

function addPaymentRequirement() {
    form.value.payment_requirements.push({
        terms_of_payment: '',
        currency: '',
        pay_to_account: '',
        customer_discount: ''
    });
}

function removePaymentRequirement(index) {
    form.value.payment_requirements.splice(index, 1);
}

function submit() {
    router.post(route('customers.store'), form.value).then(() => {
        router.visit(route('services.show', { service: 1 }));
    });
}
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

.container {
    display: flex;
}

.sidebar {
    width: 250px;
    background-color: #f4f4f4;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.sidebar .logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
}

.sidebar .logo img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
}

.sidebar .logo h1 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    width: 100%;
}

.sidebar ul li {
    margin-bottom: 20px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    display: flex;
    align-items: center;
}

.sidebar ul li a i {
    margin-right: 10px;
    font-size: 18px;
}

.sidebar ul li a:hover {
    color: #007bff;
}
.create-customer-container {
    flex: 1;
    background-color: #b0c4de;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

label {
    font-weight: bold;
}

input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.mb-2 {
    margin-bottom: 10px;
}

button {
    background-color: #0221bf;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 20px;
    border-radius: 4px;
    color: white;
}

button[type="button"] {
    background-color: #f44336;
    margin-top: 10px;
}

button[type="button"]:hover, button:hover {
    opacity: 0.8;
}
</style>
