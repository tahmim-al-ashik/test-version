<template>
    <Head title="Invoice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ isEditMode ? 'Edit Invoice' : 'Create Invoice' }}</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="invoice-container">
                <div class="header">
                    <button class="settings-btn" @click="router.visit(route('invoice.settings.edit'))">
                        <i class="fa fa-cog"></i> Invoice Settings
                    </button>
                    <div class="search-container">
                        <input type="text" placeholder="Search product" v-model="searchProductQuery" />
                        <button class="add-btn" @click="openAddProductPage">+</button>
                        <div v-if="searchProductResults.length" class="search-results">
                            <ul>
                                <li v-for="product in searchProductResults" :key="product.id" @click="selectProduct(product)">
                                    {{ product.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
<!--                    <div class="currency-selector">-->
<!--                        <label for="currency">Base Currency:</label>-->
<!--                        <select v-model="selectedCurrency" @change="updateCurrency">-->
<!--                            <option v-for="currency in currencies" :value="currency.id" :key="currency.id">-->
<!--                                {{ currency.name }}-->
<!--                            </option>-->
<!--                        </select>-->
<!--                        <span v-if="invoiceSettings" class="base-currency">-->
<!--                            Current: {{ getCurrencyName(invoiceSettings.base_currency_id) }}-->
<!--                        </span>-->
<!--                    </div>-->
                    <div class="search-container">
                        <input type="text" placeholder="Search Customer" v-model="searchCustomerQuery" />
                        <button class="add-btn" @click="openAddCustomerPage">+</button>
                        <div v-if="searchCustomerResults.length" class="search-results">
                            <ul>
                                <li v-for="customer in searchCustomerResults" :key="customer.id" @click="selectCustomer(customer)">
                                    {{ customer.customer_name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="main-content" v-if="invoiceSettings">
                    <div class="row header-row">
                        <h6>Invoice Date:<span><input type="date" class="btn" v-model="invoiceDate" /></span></h6>
                        <h6>Delivery Date:<span><input type="date" class="btn" v-model="deliveryDate" /></span></h6>
                        <select class="footer-btn" v-model="selectedInvoiceCategory">
                            <option v-for="category in categories" :value="category.id" :key="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <button class="btn" @click="clearData">Clear Data</button>
                        <button class="btn" @click="viewInvoice">View Invoice</button>
                    </div>

                    <div class="row header-row">
                        <h6> Customer Name: <span class="design-clr"> {{ selectedCustomer.customer_name }}</span></h6>
                        <h6> Phone Number: <span class="design-clr">{{ selectedCustomer.phone_no }}</span></h6>
                        <h6> Address: <span class="design-clr">{{ selectedCustomer.address }}</span> </h6>
                        <h6> Email: <span class="design-clr">{{ selectedCustomer.email_invoice }}</span></h6>
                        <h6> Receiver Reference:
                            <span class="design-clr">
                                <div class="form-group dropdown-container">
                                    <input type="text" v-model="receiverReferenceInput" @focus="showReceiverDropdown = true" @blur="hideReceiverDropdown" @input="filterReceiverOptions" @keypress.enter.prevent="addReceiverReference">
                                    <select v-show="showReceiverDropdown" @change="updateSelectedReceiverReferences" multiple>
                                        <option v-for="reference in filteredReceiverReferences" :value="reference" :key="reference">{{ reference }}</option>
                                    </select>
                                </div>
                            </span>
                        </h6>
                        <h6> Sender References:
                            <span class="design-clr">
                                <div class="form-group dropdown-container">
                                    <input type="text" v-model="senderReferenceInput" @focus="showSenderDropdown = true" @blur="hideSenderDropdown" @input="filterSenderOptions" @keypress.enter.prevent="addSenderReference">
                                    <select v-show="showSenderDropdown" @change="updateSelectedSenderReferences" multiple>
                                        <option v-for="reference in filteredSenderReferences" :value="reference" :key="reference">{{ reference }}</option>
                                    </select>
                                </div>
                            </span>
                        </h6>
                    </div>

                    <div class="row header-row">
                        <button class="btn">Product Name</button>
                        <button class="btn">Category</button>
                        <button class="btn">Unit</button>
                        <button class="btn">Qty</button>
                        <button class="btn">Price ex Vat</button>
                        <button class="btn">Price inc Vat</button>
                    </div>
                    <div v-for="(product, index) in products" :key="index" class="product-row">
                        <input type="text" v-model="product.name" placeholder="Product Name" class="input-field" />
                        <input type="text" v-model="product.category" placeholder="Category" class="input-field" />
                        <input type="text" v-model="product.unit" placeholder="Unit" class="input-field" />
                        <input type="number" v-model="product.qty" placeholder="Qty" class="input-field" />
                        <input type="number" v-model="product.priceExVat" placeholder="Price ex Vat" class="input-field" />
                        <input type="number" v-model="product.priceIncVat" placeholder="Price inc Vat" class="input-field" />
                        <button @click="removeProductRow(index)" class="remove-btn">
                            <i class="fas fa-minus-circle"></i>
                        </button>
                    </div>
                    <button @click="addProductRow" class="add-product-btn">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
                <div v-else class="loading">
                    Loading invoice settings...
                </div>

                <div class="calculation-invoice">
                    <h6>Total Products: {{ totalProducts }}</h6>
                    <h6>Total Price excluding VAT: {{ totalPriceExcludingVAT }}</h6>
                    <h6>Total Price including VAT: {{ totalPriceIncludingVAT }}</h6>
                    <div class="form-group">
                        <label for="receivedMoney">Received Money:</label>
                        <input type="number" v-model="receivedMoney" placeholder="Enter received money" />
                    </div>
                    <h6>Due Amount: {{ dueAmount }}</h6>
                    <div class="form-group">
                        <label for="dueDate">Due Date:</label>
                        <input type="date" v-model="dueDate" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes">Notes:</label>
                    <textarea v-model="notes" placeholder="Enter notes here" rows="4"></textarea>
                </div>

                <div class="footer">
                    <button class="footer-btn" @click="generateQr">Generate QR</button>
                    <select class="footer-btn" v-model="transactionType">
                        <option value="in">In</option>
                        <option value="out">Out</option>
                    </select>
                    <!-- Payment received/ Send by -->
                    <select class="footer-btn" v-model="selectedPaymentGateway">
                        <option v-if="paymentGateways.length === 0" disabled>No Payment Gateways</option>
                        <option v-for="gateway in paymentGateways" :value="gateway.id" :key="gateway.id">
                            {{ gateway.name }} - {{ gateway.account_name }}
                        </option>
                    </select>
                    <button class="footer-btn" @click="showCompleteInvoiceOptions">{{ isEditMode ? 'Update' : 'Complete' }}</button>
                </div>
<!--add a text field here for writes notes-->
                <!-- Modal for completing invoice -->
                <div v-if="showCompleteInvoiceModal" class="modal">
                    <div class="modal-content">
                        <span class="close" @click="showCompleteInvoiceModal = false">&times;</span>
                        <h2>{{ isEditMode ? 'Update Invoice' : 'Complete Invoice' }}</h2>
                        <button @click="saveAsDraft">Save as Draft</button>
                        <button @click="saveAsComplete">Save as Complete</button>
                        <button @click="shareInvoice">Share</button>
                        <button @click="downloadInvoice">Download</button>
                    </div>
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
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, router } from '@inertiajs/vue3';
import { ref, watch, onMounted, computed } from 'vue';
import axios from 'axios';
import { debounce } from 'lodash';
import SideNavbar from "@/Components/Customer/SideNavbar.vue";




const { props } = usePage();
const currencies = ref(props.currencies || []);
const paymentGateways = ref([]);
const searchCustomerQuery = ref('');
const searchCustomerResults = ref([]);
const searchProductQuery = ref('');
const searchProductResults = ref([]);
const selectedCustomer = ref({
    customer_name: '',
    phone_no: '',
    address: '',
    email_invoice: '',
    references: []
});
const products = ref([
    { name: '', category: '', unit: '', qty: '', priceExVat: '', priceIncVat: '', totalPrice: '' }
]);
const selectedInvoiceCategory = ref(null);
const invoiceSettings = ref(null);
const categories = ref([]);
const selectedCurrency = ref('');
const invoiceDate = ref(new Date().toISOString().slice(0, 10));
const deliveryDate = ref(new Date().toISOString().slice(0, 10));
const dueDate = ref(new Date().toISOString().slice(0, 10));
const receiverReferenceInput = ref('');
const senderReferenceInput = ref('');
const selectedReceiverReferences = ref([]);
const selectedSenderReferences = ref([]);
const showReceiverDropdown = ref(false);
const showSenderDropdown = ref(false);
const transactionType = ref('in');
const showPdfModal = ref(false);
const pdfUrl = ref('');
const showCompleteInvoiceModal = ref(false);
const filteredReceiverReferences = ref([]);
const filteredSenderReferences = ref([]);
const receivedMoney = ref(0);
const notes = ref('');
const totalProducts = computed(() => products.value.length);
const invoiceId = ref(props.invoiceId || null);
const isEditMode = computed(() => !!invoiceId.value);

const totalPriceExcludingVAT = computed(() => {
    return products.value.reduce((acc, product) => {
        const price = parseFloat(product.priceExVat) || 0;
        return acc + price * (parseFloat(product.qty) || 1);
    }, 0).toFixed(2);
});

const totalPriceIncludingVAT = computed(() => {
    return products.value.reduce((acc, product) => {
        const price = parseFloat(product.priceIncVat) || 0;
        return acc + price * (parseFloat(product.qty) || 1);
    }, 0).toFixed(2);
});

const dueAmount = computed(() => {
    return (parseFloat(totalPriceIncludingVAT.value) - parseFloat(receivedMoney.value)).toFixed(2);
});

const selectedPaymentGateway = ref(null);

onMounted(async () => {
    await fetchInvoiceSettings();
    await fetchPaymentGateways();
    await fetchCategories();
    if (invoiceSettings.value) {
        selectedCurrency.value = invoiceSettings.value.base_currency_id;
        filteredSenderReferences.value = invoiceSettings.value.sender_references.map(ref => ref.name) || [];
    }
    if (selectedCustomer.value) {
        filteredReceiverReferences.value = selectedCustomer.value.references.map(ref => ref.name) || [];
    }
    if (isEditMode.value) {
        await loadDraftInvoice(invoiceId.value);
    }
});

const fetchInvoiceSettings = async () => {
    try {
        const response = await axios.get('/api/invoice-settings');
        invoiceSettings.value = response.data;
    } catch (error) {
        console.error('Error fetching invoice settings:', error);
    }
};

const fetchCategories = async () => {
    try {
        const response = await axios.get('/api/invoice-categories');
        categories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
};

const fetchPaymentGateways = async () => {
    try {
        const response = await axios.get('/api/payment-gateways');
        paymentGateways.value = response.data.map(gateway => ({
            ...gateway,
            account_name: gateway.payments.length > 0 ? gateway.payments[0].account_name : 'No Accounts'
        }));
    } catch (error) {
        console.error('Error fetching payment gateways:', error);
    }
};

const getCurrencyName = (currencyId) => {
    const currency = currencies.value.find(c => c.id === currencyId);
    return currency ? currency.name : 'Unknown';
};

const updateCurrency = () => {
    if (invoiceSettings.value) {
        invoiceSettings.value.base_currency_id = selectedCurrency.value;
    }
};

function openAddCustomerPage() {
    router.visit('/customers/create');
}

function openAddProductPage() {
    router.visit('/products/create');
}

watch(searchCustomerQuery, debounce(async (newQuery) => {
    if (newQuery) {
        try {
            const response = await axios.get('/customers/search', { params: { query: newQuery } });
            searchCustomerResults.value = response.data;
        } catch (error) {
            console.error('Error fetching search results:', error);
        }
    } else {
        searchCustomerResults.value = [];
    }
}, 300));

watch(searchProductQuery, debounce(async (newQuery) => {
    if (newQuery) {
        try {
            const response = await axios.get('/products/search', { params: { query: newQuery } });
            searchProductResults.value = response.data;
        } catch (error) {
            console.error('Error fetching search results:', error);
        }
    } else {
        searchProductResults.value = [];
    }
}, 300));

function addProductRow() {
    products.value.push({ name: '', category: '', unit: '', qty: '', priceExVat: '', priceIncVat: '', totalPrice: '' });
}

function removeProductRow(index) {
    if (products.value.length > 1) {
        products.value.splice(index, 1);
    }
}

function selectProduct(product) {
    let emptyRowFound = false;

    for (const productRow of products.value) {
        if (
            !productRow.name &&
            !productRow.category &&
            !productRow.unit &&
            !productRow.qty &&
            !productRow.priceExVat &&
            !productRow.priceIncVat &&
            !productRow.totalPrice
        ) {
            productRow.name = product.name;
            productRow.category = getCategoryName(product.category_id);
            productRow.unit = product.unit;
            productRow.qty = product.qty;
            productRow.priceExVat = product.price_excluding_vat;
            productRow.priceIncVat = product.price_including_vat;
            productRow.totalPrice = product.total_price;
            emptyRowFound = true;
            break;
        }
    }

    if (!emptyRowFound) {
        products.value.push({
            name: product.name,
            category: getCategoryName(product.category_id),
            unit: product.unit,
            qty: product.qty,
            priceExVat: product.price_excluding_vat,
            priceIncVat: product.price_including_vat,
            totalPrice: product.total_price
        });
    }

    searchProductQuery.value = '';
    searchProductResults.value = [];
}

function selectCustomer(customer) {
    selectedCustomer.value = {
        customer_name: customer.customer_name,
        phone_no: customer.phone_no || '',
        address: customer.address || '',
        email_invoice: customer.email_invoice || '',
        references: customer.references || []
    };
    searchCustomerQuery.value = '';
    searchCustomerResults.value = [];
    filteredReceiverReferences.value = selectedCustomer.value.references.map(ref => ref.name) || [];
}

const getCategoryName = (categoryId) => {
    const category = categories.value.find(c => c.id === categoryId);
    return category ? category.name : 'Unknown';
};

function showCompleteInvoiceOptions() {
    showCompleteInvoiceModal.value = true;
}

function clearData() {
    selectedCustomer.value = {
        customer_name: '',
        phone_no: '',
        address: '',
        email_invoice: '',
        references: []
    };
    products.value = [
        { name: '', category: '', unit: '', qty: '', priceExVat: '', priceIncVat: '', totalPrice: '' }
    ];
    invoiceDate.value = new Date().toISOString().slice(0, 10);
    deliveryDate.value = new Date().toISOString().slice(0, 10);
    dueDate.value = new Date().toISOString().slice(0, 10);
    receiverReferenceInput.value = '';
    senderReferenceInput.value = '';
    selectedReceiverReferences.value = [];
    selectedSenderReferences.value = [];
}

async function viewInvoice() {
    try {
        const invoiceId = await generateInvoiceId();
        const response = await axios.post('/generate-invoice-pdf', {
            invoice_id: invoiceId,
            invoiceSettings: invoiceSettings.value,
            selectedCustomer: selectedCustomer.value,
            products: products.value,
            invoice_date: invoiceDate.value,
            delivery_date: deliveryDate.value,
            due_date: dueDate.value,
            transaction_type: transactionType.value,
            received_money: receivedMoney.value,
            total_price_excluding_vat: totalPriceExcludingVAT.value,
            total_price_including_vat: totalPriceIncludingVAT.value,
            due_amount: dueAmount.value,
            selected_payment_gateway: selectedPaymentGateway.value,
            invoice_category_id: selectedInvoiceCategory.value || null,
            sender_reference: selectedSenderReferences.value.length > 0 ? selectedSenderReferences.value : [senderReferenceInput.value, ''],
            receiver_reference: selectedReceiverReferences.value.length > 0 ? selectedReceiverReferences.value : [receiverReferenceInput.value, ''],
            notes: notes.value,
            qr_link: 'https://example.com'
        }, {
            responseType: 'blob'
        });
        pdfUrl.value = URL.createObjectURL([response.data],{ type: 'application/pdf' });
        showPdfModal.value = true;
    } catch (error) {
        console.error('Error generating PDF:', error);
        alert('Error generating PDF');
    }
}
async function downloadInvoice() {
    try {
        const invoiceId = await generateInvoiceId();
        const response = await axios.post('/generate-invoice-pdf', {
            invoice_id: invoiceId,
            invoiceSettings: invoiceSettings.value,
            selectedCustomer: selectedCustomer.value,
            products: products.value,
            invoice_date: invoiceDate.value,
            delivery_date: deliveryDate.value,
            due_date: dueDate.value,
            transaction_type: transactionType.value,
            received_money: receivedMoney.value,
            total_price_excluding_vat: totalPriceExcludingVAT.value,
            total_price_including_vat: totalPriceIncludingVAT.value,
            due_amount: dueAmount.value,
            selected_payment_gateway: selectedPaymentGateway.value,
            invoice_category_id: selectedInvoiceCategory.value || null,
            sender_reference: selectedSenderReferences.value.length > 0 ? selectedSenderReferences.value : [senderReferenceInput.value, ''],
            receiver_reference: selectedReceiverReferences.value.length > 0 ? selectedReceiverReferences.value : [receiverReferenceInput.value, ''],
            notes: notes.value,
            qr_link: 'https://example.com'
        }, {
            responseType: 'blob'
        });

        const blob = new Blob([response.data], { type: 'application/pdf' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'invoice.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } catch (error) {
        console.error('Error downloading PDF:', error);
        alert('Error downloading PDF');
    }
}

async function saveAsDraft() {
    await saveInvoice('draft');
}

async function saveAsComplete() {
    await saveInvoice('complete');
}

async function saveInvoice(status) {
    try {

        if (!selectedCustomer.value.customer_name || !selectedCustomer.value.phone_no) {
            alert('Customer name and phone number are required.');
            return;
        }
        const invoiceId = await generateInvoiceId();
        const userId = props.auth.user.id;

        // Prepare the invoice data to be sent
        const invoiceData = {
            invoice_id: invoiceId,
            user_id: userId,
            selectedCustomer: selectedCustomer.value,
            invoice_category_id: selectedInvoiceCategory.value,
            invoice_date: invoiceDate.value,
            delivery_date: deliveryDate.value,
            due_date: dueDate.value,
            products: products.value,
            notes: notes.value,
            payment_details: null,
            qr_link: null,
            status: status,
            total_price_excluding_vat: totalPriceExcludingVAT.value,
            total_price_including_vat: totalPriceIncludingVAT.value,
            received_money: receivedMoney.value,
            due_amount: dueAmount.value,
            transaction_type: transactionType.value,
            sender_reference: selectedSenderReferences.value,
            receiver_reference: selectedReceiverReferences.value,
            file_path: `invoices/${invoiceId}.pdf`
        };

        const response = await axios.post('/api/invoices', invoiceData);

        if (response.status === 201) {
            const pdfResponse = await axios.post('/api/invoices/generate-pdf', invoiceData);

            if (pdfResponse.status === 200) {
                alert('Invoice and PDF saved successfully.');
            } else {
                alert('Error generating PDF: ' + pdfResponse.data.error);
            }
        } else {
            alert('Error saving invoice: ' + response.data.error);
        }
    } catch (error) {
        console.error(error);
        alert('An error occurred while saving the invoice: ' + error.message);
    }
}

async function generateInvoiceId() {
    try {
        const response = await axios.get('/api/invoices/generate-id');
        return response.data.invoiceId;
    } catch (error) {
        console.error('Error generating invoice ID:', error);
        throw new Error('Error generating invoice ID');
    }
}

function filterReceiverOptions() {
    const filter = receiverReferenceInput.value.toLowerCase();
    filteredReceiverReferences.value = selectedCustomer.value.references.filter(reference =>
        reference.name.toLowerCase().includes(filter)
    ).map(ref => ref.name);
}

function filterSenderOptions() {
    const filter = senderReferenceInput.value.toLowerCase();
    filteredSenderReferences.value = (invoiceSettings.value.sender_references || []).filter(reference =>
        reference.name.toLowerCase().includes(filter)
    ).map(ref => ref.name);
}

function addReceiverReference() {
    const customOption = receiverReferenceInput.value.trim();
    if (customOption && !selectedReceiverReferences.value.includes(customOption)) {
        selectedReceiverReferences.value.push(customOption);
        receiverReferenceInput.value = '';
        filterReceiverOptions();
    }
}

function addSenderReference() {
    const customOption = senderReferenceInput.value.trim();
    if (customOption && !selectedSenderReferences.value.includes(customOption)) {
        selectedSenderReferences.value.push(customOption);
        senderReferenceInput.value = '';
        filterSenderOptions();
    }
}

function hideReceiverDropdown() {
    setTimeout(() => {
        showReceiverDropdown.value = false;
    }, 200);
}

function hideSenderDropdown() {
    setTimeout(() => {
        showSenderDropdown.value = false;
    }, 200);
}

function updateSelectedReceiverReferences(event) {
    const options = event.target.options;
    selectedReceiverReferences.value = Array.from(options).filter(option => option.selected).map(option => option.value);
    receiverReferenceInput.value = selectedReceiverReferences.value.join(', ') + (selectedReceiverReferences.value.length ? ', ' : '');
}

function updateSelectedSenderReferences(event) {
    const options = event.target.options;
    selectedSenderReferences.value = Array.from(options).filter(option => option.selected).map(option => option.value);
    senderReferenceInput.value = selectedSenderReferences.value.join(', ') + (selectedSenderReferences.value.length ? ', ' : '');
}

async function generateQr() {
    try {
        const response = await axios.post('/generate-qr-code', {
            data: {
                invoice_id: await generateInvoiceId(),
                user_id: props.auth.user.id,
                customer_id: selectedCustomer.value.id,
                total_amount: totalPriceIncludingVAT.value,
            }
        });
        console.log('QR code generated:', response.data.qr_link);
    } catch (error) {
        console.error('Error generating QR code:', error);
    }
}

async function loadDraftInvoice(id) {
    try {
        const response = await axios.get(`/api/invoices/drafts/${id}`);
        const draft = response.data;
        selectedCustomer.value = draft.selectedCustomer;
        products.value = JSON.parse(draft.products);
        selectedInvoiceCategory.value = draft.invoice_category_id;
        invoiceDate.value = draft.invoice_date;
        deliveryDate.value = draft.delivery_date;
        dueDate.value = draft.due_date;
        transactionType.value = draft.transaction_type;
        receivedMoney.value = draft.received_money;
        selectedSenderReferences.value = JSON.parse(draft.sender_reference);
        selectedReceiverReferences.value = JSON.parse(draft.receiver_reference);
    } catch (error) {
        console.error('Error loading draft invoice:', error);
        alert('Error loading draft invoice');
    }
}
async function shareInvoice() {
    try {
        if (!selectedCustomer.value.email_invoice) {
            showEmailErrorModal.value = true;
            return;
        }

    const invoiceId = await generateInvoiceId();

    const invoiceData = {
        invoice_id: invoiceId,
        invoiceSettings: invoiceSettings.value,
        selectedCustomer: selectedCustomer.value,
        products: products.value,
        invoice_date: invoiceDate.value,
        delivery_date: deliveryDate.value,
        due_date: dueDate.value,
        transaction_type: transactionType.value,
        received_money: receivedMoney.value,
        total_price_excluding_vat: totalPriceExcludingVAT.value,
        total_price_including_vat: totalPriceIncludingVAT.value,
        due_amount: dueAmount.value,
        selected_payment_gateway: selectedPaymentGateway.value,
        invoice_category_id: selectedInvoiceCategory.value || null,
        sender_reference: selectedSenderReferences.value.length > 0 ? selectedSenderReferences.value : [senderReferenceInput.value, ''],
        receiver_reference: selectedReceiverReferences.value.length > 0 ? selectedReceiverReferences.value : [receiverReferenceInput.value, ''],
        notes: notes.value, // Include notes
        qr_link: 'https://example.com'
    };

    const response = await axios.post('/api/invoices/generate-pdf', invoiceData, { responseType: 'blob' });

    if (response.status === 200) {
        const formData = new FormData();
        formData.append('email', selectedCustomer.value.email_invoice);
        formData.append('pdf', new Blob([response.data], { type: 'application/pdf' }));
        formData.append('subject', 'Your Invoice');
        formData.append('body', 'Please find your invoice attached.');

        const emailResponse = await axios.post('/api/send-email', formData);

        if (emailResponse.status === 200) {
            alert('Invoice sent successfully.');
        } else {
            alert('Error sending email: ' + emailResponse.data.error);
        }
    } else {
        alert('Error generating PDF: ' + response.data.error);
    }
} catch (error) {
    console.error('Error sharing invoice:', error);
    alert('Error sharing invoice');
}
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

.invoice-container {
    flex: 1;
    background-color: #b0c4de;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.header,
.footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.settings-btn {
    background-color: #87ceeb;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.settings-btn i {
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

.add-btn {
    background-color: #87ceeb;
    border: none;
    padding: 10px 20px;
    font-size: 20px;
    cursor: pointer;
    margin-left: 10px;
}
.search-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    border-top: none;
    z-index: 10;
    max-height: 200px;
    overflow-y: auto;
}

.search-results ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.search-results li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.search-results li:last-child {
    border-bottom: none;
}

.search-results li:hover {
    background-color: #f0f0f0;
    cursor: pointer;
}

.main-content {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
    max-width: 100%;
    overflow-x: auto;
}

.row {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.header-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.product-row {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    width: 100%;
}

.input-field {
    padding: 10px;
    margin-right: 10px;
    max-width: 150px;
    flex: 1;
}

.add-product-btn,
.remove-btn {
    background-color: transparent;
    border: none;
    cursor: pointer;
    margin-left: 5px;
    font-size: 24px;
}

.add-product-btn {
    color: green;
}

.remove-btn {
    color: red;
}

.btn {
    background-color: #87ceeb;
    border: none;
    font-size: 16px;
    cursor: pointer;
    flex: 1;
    text-align: center;
    margin: 4px;
}

.footer-btn {
    background-color: #87ceeb;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    flex: 1;
    margin-right: 10px;
    text-align: center;
}

.footer-btn:last-child {
    margin-right: 0;
}

.design-clr {
    color: red;
}

.currency-selector {
    display: flex;
    align-items: center;
    gap: 10px;
}

.currency-selector label {
    font-weight: bold;
}

.currency-selector select {
    padding: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

.base-currency {
    font-weight: bold;
    color: green;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

.form-group label {
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input {
    padding: 10px;
    margin-bottom: 10px;
}

.dropdown-container {
    position: relative;
}

.dropdown-container select {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    max-height: 150px;
    overflow-y: auto;
    display: none;
    z-index: 10;
}

.dropdown-container select[multiple] {
    display: block;
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

@media (max-width: 768px) {
    .sidebar {
        display: none;
    }

    .invoice-container {
        padding: 10px;
    }

    .product-row {
        flex-direction: column;
        align-items: flex-start;
    }

    .input-field {
        max-width: 100%;
        margin-bottom: 10px;
    }

    .btn,
    .footer-btn {
        flex: none;
        width: 100%;
        margin-bottom: 10px;
    }

    .modal-content {
        width: 90%;
    }
}
</style>
