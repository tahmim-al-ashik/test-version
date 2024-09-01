<template>
    <div class="modal">
        <div class="modal-content">
            <span class="close" @click="$emit('close')">&times;</span>
            <h3>Add Category</h3>
            <form @submit.prevent="submit">
                <input type="text" v-model="name" placeholder="Category Name" required>
                <button type="submit">Create</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const name = ref('');

const submit = async () => {
    try {
        const response = await axios.post('/categories', { name: name.value });
        $emit('categoryAdded', response.data);
        $emit('close'); // Emit close event after successfully adding the category
    } catch (error) {
        console.error('Error creating category:', error);
    }
};
</script>

<style scoped>
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

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
}
</style>
