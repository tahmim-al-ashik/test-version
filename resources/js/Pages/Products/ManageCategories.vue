<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Categories</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="manage-categories-container">
                <h3>Categories</h3>
                <table>
                    <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in categories" :key="category.id">
                        <td>{{ category.name }}</td>
                        <td>
                            <button @click="editCategory(category.id)">Edit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <h3>Subcategories</h3>
                <table>
                    <thead>
                    <tr>
                        <th>Subcategory Name</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="subcategory in subcategories" :key="subcategory.id">
                        <td>{{ subcategory.name }}</td>
                        <td>{{ subcategory.category.name }}</td>
                        <td>
                            <button @click="editSubcategory(subcategory.id)">Edit</button>
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
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';
import axios from 'axios';

const categories = ref([]);
const subcategories = ref([]);

const fetchCategories = async () => {
    try {
        const response = await axios.get('/categories');
        categories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

const fetchSubcategories = async () => {
    try {
        const response = await axios.get('/subcategories');
        subcategories.value = response.data;
    } catch (error) {
        console.error('Error fetching subcategories:', error);
    }
};

const editCategory = (id) => {
    router.visit(route('categories.edit', { id }));
};

const editSubcategory = (id) => {
    router.visit(route('subcategories.edit', { id }));
};

onMounted(() => {
    fetchCategories();
    fetchSubcategories();
});
</script>

<style scoped>
.container {
    display: flex;
}

.sidebar {
    width: 250px;
    background-color: #f4f4f4;
    padding: 20px;
}

.manage-categories-container {
    flex: 1;
    background-color: #fff;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

h3 {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
}

th {
    background-color: #f4f4f4;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #0056b3;
}
</style>
