<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoices</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="main-content">
                <div v-if="loading" class="loading">
                    Loading invoices...
                </div>
                <div v-else>
                    <h3>Invoices</h3>
                    <table>
                        <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Customer Name</th>
                            <th>Invoice Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="invoice in invoices" :key="invoice.id">
                            <td>{{ invoice.invoice_id }}</td>
                            <td>{{ invoice.customer ? invoice.customer.customer_name : 'No Customer' }}</td>
                            <td>{{ invoice.invoice_date }}</td>
                            <td>{{ invoice.status }}</td>
                            <td>
                                <button v-if="invoice.status.toLowerCase() === 'draft'" @click="editInvoice(invoice)">Edit</button>
                                <button v-if="invoice.status.toLowerCase() === 'draft'" @click="deleteInvoice(invoice.id)">Delete</button>
                                <button v-if="invoice.status.toLowerCase() === 'draft'" @click="downloadPdf(invoice)">Download PDF</button>
                                <button v-if="invoice.status.toLowerCase() === 'complete'" @click="rejectInvoice(invoice)">Reject</button>
                                <button v-if="invoice.status.toLowerCase() === 'complete'" @click="downloadPdf(invoice)">Download PDF</button>
                                <button v-if="invoice.status.toLowerCase() === 'rejected'" @click="completeInvoice(invoice)">Complete</button>
                                <button v-if="invoice.status.toLowerCase() === 'rejected'" @click="downloadPdf(invoice)">Download PDF</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div v-if="showPdfModal" class="modal">
                    <div class="modal-content">
                        <span class="close" @click="showPdfModal = false">&times;</span>
                        <iframe :src="pdfUrl" width="100%" height="600px"></iframe>
                    </div>
                </div>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SideNavbar from "@/Components/Customer/SideNavbar.vue";

const loading = ref(true);
const invoices = ref([]);
const showPdfModal = ref(false);
const pdfUrl = ref('');

const fetchInvoices = async () => {
    try {
        const response = await axios.get('/api/invoices/all');
        invoices.value = response.data;
    } catch (error) {
        console.error('Error fetching invoices:', error);
    } finally {
        loading.value = false;
    }
};

const editInvoice = (invoice) => {
    router.visit(route('invoices.edit', { id: invoice.id }));
};

const deleteInvoice = async (invoiceId) => {
    try {
        await axios.delete(`/api/invoices/${invoiceId}`);
        invoices.value = invoices.value.filter(invoice => invoice.id !== invoiceId);
    } catch (error) {
        console.error('Error deleting invoice:', error);
    }
};

const downloadPdf = async (invoice) => {
    try {
        const response = await axios.post('/api/invoices/generate-pdf', {
            invoice_id: invoice.invoice_id,
            invoice_category_id: invoice.invoice_category_id,
            invoice_date: invoice.invoice_date,
            delivery_date: invoice.delivery_date,
            due_date: invoice.due_date,
            products: invoice.products,
            selectedCustomer: JSON.stringify(invoice.customer),
            status: invoice.status,
            total_price_excluding_vat: invoice.total_price_excluding_vat,
            total_price_including_vat: invoice.total_price_including_vat,
            received_money: invoice.received_money,
            due_amount: invoice.due_amount,
            transaction_type: invoice.transaction_type,
            sender_reference: invoice.sender_reference,
            receiver_reference: invoice.receiver_reference,
            file_path: invoice.file_path
        }, { responseType: 'blob' });

        pdfUrl.value = URL.createObjectURL(new Blob([response.data], { type: 'application/pdf' }));
        showPdfModal.value = true;
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Error generating PDF');
    }
};

const rejectInvoice = async (invoice) => {
    try {
        await axios.post(`/api/invoices/reject/${invoice.id}`);
        invoice.status = 'rejected';
    } catch (error) {
        console.error('Error rejecting invoice:', error);
    }
};

const completeInvoice = async (invoice) => {
    try {
        await axios.post(`/api/invoices/complete/${invoice.id}`);
        invoice.status = 'complete';
    } catch (error) {
        console.error('Error completing invoice:', error);
    }
};

onMounted(() => {
    fetchInvoices();
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

.main-content {
    flex: 1;
    background-color: #b0c4de;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.loading {
    text-align: center;
    font-size: 20px;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th,
table td {
    border: 1px solid #ddd;
    padding: 8px;
}

table th {
    background-color: #f2f2f2;
    text-align: left;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #ddd;
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
}

.modal-content h2 {
    margin-bottom: 20px;
}

.modal-content button {
    background-color: #87ceeb;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    margin: 5px;
}

.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 30px;
    cursor: pointer;
}
</style>
