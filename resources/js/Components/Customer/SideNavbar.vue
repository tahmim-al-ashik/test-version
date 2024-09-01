<template>
    <div class="sidebar">
        <div class="logo">
            <img src="/template/assets/images/logo/logo-icon.png" alt="Logo">
            <h2>CUBA</h2>
        </div>
        <ul>
            <li v-for="pkg in packages" :key="pkg.id">
                <i class="icon-user"></i>
                <Link :href="route('package.invoice', { service: 1, package: pkg.id })">
                    <span>Invoice Dashboard</span>
                </Link>
            </li>
            <li>
                <i class="icon-user"></i>
                <Link :href="route('customers.index')">
                    <span>Customer List</span>
                </Link>
            </li>
            <li>
                <i class="icon-cog"></i>
                <Link :href="route('invoice.settings.edit')">
                    <span>Invoice Settings</span>
                </Link>
            </li>
            <li>
                <i class="icon-box"></i>
                <Link :href="route('products.index')">
                    <span>Product List</span>
                </Link>
            </li>
            <li>
                <i class="icon-box"></i>
                <Link :href="route('manage.categories')">
                    <span>Manage Categories</span>
                </Link>
            </li>
            <li>
                <i class="icon-folder"></i>
                <Link :href="route('invoice-categories.index')">
                    <span>Invoice Categories</span>
                </Link>
            </li>
            <li>
                <i class="icon-box"></i>
                <Link :href="route('payment-settings.index')">
                    <span>Payment Settings</span>
                </Link>
            </li>
            <li>
                <i class="icon-docs"></i>
                <Link :href="route('invoices.drafts')">
                    <span>Draft Invoices</span>
                </Link>
            </li>

        </ul>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const packages = ref([]);

onMounted(async () => {
    try {
        const response = await axios.get('/api/packages?service_id=1');
        packages.value = response.data;
    } catch (error) {
        console.error('Error fetching packages:', error);
    }
});
</script>

<style scoped>
.sidebar {
    width: 250px;
    height: 100vh;
    background-color: #fff;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

.logo {
    display: flex;
    align-items: center;
    padding: 20px;
}

.logo img {
    width: 40px;
    margin-right: 10px;
}

.logo h2 {
    font-size: 20px;
    color: #333;
}

ul {
    list-style: none;
    padding: 0;
}

ul li {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    cursor: pointer;
}

ul li i {
    font-size: 18px;
    margin-right: 10px;
}

ul li span {
    font-size: 16px;
    color: #333;
}
</style>
