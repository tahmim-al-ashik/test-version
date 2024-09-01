<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Product List</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="product-list-container">
                <div class="search-container">
                    <i class="fa fa-calendar"></i>
                    <input type="text" placeholder="Search product by Name, Category" v-model="searchQuery" />
                    <button @click="searchProducts">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th>Product Added Date</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Price Inc. VAT</th>
                        <th>Price Ex. VAT</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.created_at }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.category }}</td>
                        <td>{{ product.subcategory }}</td>
                        <td>{{ product.price_including_vat }}</td>
                        <td>{{ product.price_excluding_vat }}</td>
                        <td>{{ product.instock }}</td>
                        <td>
                            <button @click="editProduct(product.id)">Edit</button>
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
const products = ref(props.products);

const searchProducts = async () => {
    try {
        const response = await axios.get('/products/search', {
            params: { query: searchQuery.value }
        });
        products.value = response.data;
    } catch (error) {
        console.error('Error fetching search results:', error);
    }
};

const editProduct = (id) => {
    router.visit(`/products/${id}/edit`);
};

watch(searchQuery, searchProducts);
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

.product-list-container {
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
