<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Subcategory</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="edit-subcategory-container">
                <form @submit.prevent="submit">
                    <div>
                        <label for="name">Subcategory Name</label>
                        <input type="text" v-model="form.name" required>
                    </div>
                    <div>
                        <label for="category">Category</label>
                        <select v-model="form.category_id">
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <button type="submit">Update Subcategory</button>
                </form>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';
import axios from 'axios';

const page = usePage();
const form = ref({
    name: page.props.subcategory.name,
    category_id: page.props.subcategory.category_id,
});

const categories = ref([]);

const fetchCategories = async () => {
    try {
        const response = await axios.get('/categories');
        categories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

onMounted(() => {
    fetchCategories();
});

function submit() {
    router.put(route('subcategories.update', { id: page.props.subcategory.id }), form.value);
}
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

.edit-subcategory-container {
    flex: 1;
    background-color: #fff;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    font-weight: bold;
}

input,
select,
button {
    padding: 10px;
    font-size: 16px;
    box-sizing: border-box;
}

button {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

button:hover {
    background-color: #0056b3;
}
</style>
