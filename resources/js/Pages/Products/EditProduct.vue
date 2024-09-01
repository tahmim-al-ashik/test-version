<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Product</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="edit-product-container">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="name">Product Name</label>
                            <input type="text" v-model="form.name" required>
                        </div>
                        <div>
                            <label for="category">Category</label>
                            <div class="input-with-button">
                                <select v-model="form.category_id" @change="fetchSubcategories">
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                                <button type="button" @click="showCategoryModal = true">+</button>
                            </div>
                        </div>
                        <div>
                            <label for="subcategory">Subcategory</label>
                            <div class="input-with-button">
                                <select v-model="form.subcategory_id">
                                    <option v-for="subcategory in subcategories" :key="subcategory.id"
                                            :value="subcategory.id">
                                        {{ subcategory.name }}
                                    </option>
                                </select>
                                <button type="button" @click="showSubcategoryModal = true">+</button>
                            </div>
                        </div>
                        <div>
                            <label for="price_including_vat">Price Including VAT</label>
                            <input type="number" v-model="form.price_including_vat" step="0.01">
                        </div>
                        <div>
                            <label for="price_excluding_vat">Price Excluding VAT</label>
                            <input type="number" v-model="form.price_excluding_vat" step="0.01">
                        </div>
                        <div>
                            <label for="instock">In Stock</label>
                            <input type="number" v-model="form.instock">
                        </div>
                    </div>
                    <button type="submit">Update</button>
                </form>
            </main>
        </div>

        <CategoryModal v-if="showCategoryModal" @categoryAdded="handleCategoryAdded"
                       @close="showCategoryModal = false"/>
        <SubcategoryModal v-if="showSubcategoryModal" @subcategoryAdded="handleSubcategoryAdded"
                          @close="showSubcategoryModal = false"/>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {ref, onMounted} from 'vue';
import {usePage, router} from '@inertiajs/vue3';
import axios from 'axios';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';
import CategoryModal from '@/Components/Product/CategoryModal.vue';
import SubcategoryModal from '@/Components/Product/SubcategoryModal.vue';

const {props} = usePage();
const product = props.product;

const form = ref({
    name: product.name,
    category_id: product.category_id,
    subcategory_id: product.subcategory_id,
    price_including_vat: product.price_including_vat,
    price_excluding_vat: product.price_excluding_vat,
    instock: product.instock,
});

const categories = ref([]);
const subcategories = ref([]);
const showCategoryModal = ref(false);
const showSubcategoryModal = ref(false);

const handleCategoryAdded = (category) => {
    categories.value.push(category);
    form.value.category_id = category.id; // Update category_id
    fetchSubcategories(); // Fetch subcategories for the newly added category
};

const handleSubcategoryAdded = ({categoryId, subcategory}) => {
    if (form.value.category_id === categoryId) {
        subcategories.value.push(subcategory);
    }
    form.value.subcategory_id = subcategory.id; // Update subcategory_id
};

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
        if (form.value.category_id) {
            const response = await axios.get(`/subcategories?category_id=${form.value.category_id}`);
            subcategories.value = response.data;
        } else {
            subcategories.value = [];
        }
    } catch (error) {
        console.error('Error fetching subcategories:', error);
    }
};

onMounted(() => {
    fetchCategories();
    fetchSubcategories();
});

function submit() {
    router.put(route('products.update', {product: product.id}), form.value).then(() => {
        router.visit(route('products.index'));
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

.edit-product-container {
    flex: 1;
    background-color: #b0c4de;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.grid {
    display: grid;
    gap: 10px;
}

label {
    font-weight: bold;
}

.input-with-button {
    display: flex;
    align-items: center;
}

.input-with-button select,
.input-with-button input {
    flex: 1;
}

.input-with-button button {
    margin-left: 5px;
}

input,
select,
button {
    padding: 10px;
    font-size: 16px;

    box-sizing: border-box;
}

button {
    background-color: #87ceeb;
    border: none;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
}

button[type="submit"] {
    background-color: #007bff;
    color: white;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    width: 300px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.modal-content h3 {
    margin-top: 0;
}

.modal-content input,
.modal-content select,
.modal-content button {
    width: 100%;
    margin-bottom: 10px;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}
</style>
