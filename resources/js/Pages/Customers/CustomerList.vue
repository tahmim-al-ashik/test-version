<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customer List</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="customer-list-container">
                <div class="search-container">
                    <i class="fa fa-calendar"></i>
                    <input type="text" placeholder="Search customer by Name, Email, Phone" v-model="searchQuery" />
                    <button @click="searchCustomers">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th>Customer Added Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="customer in customers" :key="customer.id">
                        <td>{{ customer.created_at }}</td>
                        <td>{{ customer.customer_name }}</td>
                        <td>{{ customer.email_invoice }}</td>
                        <td>{{ customer.phone_no }}</td>
                        <td>{{ customer.address }}</td>
                        <td v-if="customer.user_id === authUserId">
                            <button @click="editCustomer(customer.id)">Edit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';
import { ref, watch } from 'vue';
import axios from 'axios';
import { usePage, router } from '@inertiajs/vue3';

const { props } = usePage();
const searchQuery = ref('');
const customers = ref(props.customers);
const authUserId = props.auth.user.id; // Assuming the auth user data is passed to the component

// Function to fetch customers based on the search query
const searchCustomers = async () => {
    try {
        const response = await axios.get('/customers/search', {
            params: { query: searchQuery.value }
        });
        customers.value = response.data;
    } catch (error) {
        console.error('Error fetching search results:', error);
    }
};

// Watch the searchQuery and fetch search results
watch(searchQuery, searchCustomers);

// Function to redirect to the edit customer page
const editCustomer = (customerId) => {
    router.visit(`/customers/${customerId}/edit`);
};
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

.customer-list-container {
    flex: 1;
    background-color: #b0c4de;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.search-container {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.search-container input {
    padding: 10px;
    margin-left: 10px;
    font-size: 16px;
    flex: 1;
}

.search-container button {
    padding: 10px;
    font-size: 16px;
    cursor: pointer;
    margin-left: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid black;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}
</style>
