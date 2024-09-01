<template>
    <div class="modal" @click.self="close">
        <div class="modal-content">
            <span class="close" @click="close">&times;</span>
            <h3>Add Subcategory</h3>
            <select v-model="selectedCategory">
                <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                </option>
            </select>
            <input type="text" v-model="subcategoryName" placeholder="Enter subcategory name">
            <button @click="addSubcategory">Add Subcategory</button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { defineEmits } from 'vue';
import axios from 'axios';

const emit = defineEmits(['subcategoryAdded', 'close']);
const categories = ref([]);
const selectedCategory = ref(null);
const subcategoryName = ref('');

const addSubcategory = async () => {
    try    {
        const response = await axios.post('/subcategories', { category_id: selectedCategory.value, name: subcategoryName.value });
        emit('subcategoryAdded', { categoryId: selectedCategory.value, subcategory: response.data.subcategory });
        emit('close');
        setTimeout(() => {
            window.location.reload(); // Force page reload after a short delay
        }, 500); // You can adjust the delay as needed
    } catch (error) {
        console.error('Error adding subcategory:', error);
    }
};

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

const close = () => {
    emit('close');
};
</script>

<style scoped>
/* Modal styles */
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

