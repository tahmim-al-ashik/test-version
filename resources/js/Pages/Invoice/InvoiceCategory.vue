<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoice Categories</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="invoice-category-container">
                <div class="header">
                    <button class="add-btn" @click="showModal = true">
                        <i class="icon-plus"></i> Add New Invoice Category
                    </button>
                    <div class="search-container">
                        <input type="text" placeholder="Search Category" v-model="searchQuery" />
                        <i class="icon-search"></i>
                    </div>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th>Created Date</th>
                        <th>Invoice Category Name</th>
                        <th>Number of Invoice in each Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in filteredCategories" :key="category.id">
                        <td>{{ category.created_at }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.invoices_count }}</td>
                        <td>
                            <button @click="editCategory(category)">Edit</button>
                            <button @click="deleteCategory(category.id)">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div v-if="showModal" class="modal">
                    <div class="modal-content">
                        <span class="close" @click="closeModal">&times;</span>
                        <h2>{{ editMode ? 'Edit Category' : 'Add Category' }}</h2>
                        <form @submit.prevent="editMode ? updateCategory() : createCategory()">
                            <input type="text" v-model="categoryName" placeholder="Category Name" required />
                            <button type="submit">{{ editMode ? 'Update' : 'Create' }}</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';

const { props } = usePage();
const categories = ref(props.categories);
const searchQuery = ref('');
const showModal = ref(false);
const editMode = ref(false);
const categoryName = ref('');
const categoryId = ref(null);

const filteredCategories = computed(() => {
    if (!searchQuery.value) return categories.value;
    return categories.value.filter(category =>
        category.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const closeModal = () => {
    showModal.value = false;
    editMode.value = false;
    categoryName.value = '';
    categoryId.value = null;
};

const fetchCategories = async () => {
    try {
        const response = await axios.get(route('invoice-categories.index'));
        categories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

const createCategory = async () => {
    try {
        await axios.post(route('invoice-categories.store'), {
            name: categoryName.value
        });
        closeModal();
        await fetchCategories();
    } catch (error) {
        console.error('Error creating category:', error);
    }
};

const editCategory = (category) => {
    categoryId.value = category.id;
    categoryName.value = category.name;
    editMode.value = true;
    showModal.value = true;
};

const updateCategory = async () => {
    try {
        await axios.put(route('invoice-categories.update', categoryId.value), {
            name: categoryName.value
        });
        closeModal();
        await fetchCategories();
    } catch (error) {
        console.error('Error updating category:', error);
    }
};

const deleteCategory = async (id) => {
    try {
        await axios.delete(route('invoice-categories.destroy', id));
        await fetchCategories();
    } catch (error) {
        console.error('Error deleting category:', error);
    }
};
</script>

<style scoped>
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

.invoice-category-container {
    flex: 1;
    background-color: #b0c4de;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.add-btn {
    background-color: #87ceeb;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.add-btn i {
    margin-right: 10px;
}

.search-container {
    display: flex;
    align-items: center;
    position: relative;
}

.search-container input {
    padding: 10px;
    font-size: 16px;
}

.search-container i {
    position: absolute;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #333;
}

th, td {
    padding: 10px;
    text-align: left;
}

.modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 100;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    text-align: center;
    position: relative;
}

.modal-content .close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 30px;
    cursor: pointer;
}

.modal-content h2 {
    margin-bottom: 20px;
}

.modal-content form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.modal-content form input {
    padding: 10px;
    font-size: 16px;
    width: 100%;
}

.modal-content form button {
    background-color: #87ceeb;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    align-self: center;
}

@media (max-width: 768px) {
    .sidebar {
        display: none;
    }

    .invoice-category-container {
        padding: 10px;
    }

    .modal-content {
        width: 90%;
    }
}
</style>
