<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Category</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="edit-category-container">
                <form @submit.prevent="submit">
                    <div>
                        <label for="name">Category Name</label>
                        <input type="text" v-model="form.name" required>
                    </div>
                    <button type="submit">Update Category</button>
                </form>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';

const page = usePage();
const form = ref({
    name: page.props.category.name,
});

function submit() {
    router.put(route('categories.update', { id: page.props.category.id }), form.value);
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

.edit-category-container {
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
