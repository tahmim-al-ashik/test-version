<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Payment Settings</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="payment-settings-container">
                <div class="header">
                    <button class="add-btn" @click="showGatewayModal = true">
                        <i class="icon-plus"></i> Add Payment Gateway Name
                    </button>



                    <div class="search-container">
                        <input type="text" placeholder="Search by Name with date filter" v-model="searchQuery" />
                        <i class="icon-search"></i>
                    </div>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th>Created Date</th>
                        <th>Gateway Name</th>
                        <th>Total Transaction</th>
                        <th>Total Sending Amount</th>
                        <th>Total Received Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="gateway in paymentGateways" :key="gateway.id">
                        <td>{{ gateway.created_at }}</td>
                        <td>{{ gateway.name }}</td>
                        <td>{{ gateway.total_transactions }}</td>
                        <td>{{ gateway.total_sending_amount }}</td>
                        <td>{{ gateway.total_received_amount }}</td>
                        <td>
                            <button @click="editGateway(gateway)">Edit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
<br> <br>
                <button class="add-btn" @click="showModal = true">
                    <i class="icon-plus"></i> Add New Payment Gateway
                </button>
                <br>
                <table>
                    <thead>
                    <tr>
                        <th>Created Date</th>
                        <th>Payment Gateway Name</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>Total Received Amount</th>
                        <th>Total Sending Amount</th>
                        <th>Total Number of Transactions</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="payment in filteredPayments" :key="payment.id">
                        <td>{{ payment.created_at }}</td>
                        <td>{{ payment.payment_gateway.name }}</td>
                        <td>{{ payment.account_name }}</td>
                        <td>{{ payment.account_number }}</td>
                        <td>{{ payment.total_received }}</td>
                        <td>{{ payment.total_sent }}</td>
                        <td>{{ payment.transactions ? payment.transactions.length : 0 }}</td>
                        <td>
                            <button @click="editPayment(payment)">Edit</button>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <!-- Modal for adding/editing payment gateway -->
                <div v-if="showGatewayModal" class="modal">
                    <div class="modal-content">
                        <span class="close" @click="showGatewayModal = false">&times;</span>
                        <h2>{{ editGatewayMode ? 'Edit Gateway' : 'Add Gateway' }}</h2>
                        <form @submit.prevent="editGatewayMode ? updateGateway() : createGateway()">
                            <input type="text" v-model="gatewayName" placeholder="Gateway Name" required />
                            <button type="submit">{{ editGatewayMode ? 'Update' : 'Create' }}</button>
                        </form>
                    </div>
                </div>

                <!-- Modal for adding/editing payment -->
                <div v-if="showModal" class="modal">
                    <div class="modal-content">
                        <span class="close" @click="showModal = false">&times;</span>
                        <h2>{{ editMode ? 'Edit Payment' : 'Add Payment' }}</h2>
                        <form @submit.prevent="editMode ? updatePayment() : createPayment()">
                            <select v-model="selectedGatewayId" required>
                                <option v-for="gateway in paymentGateways" :value="gateway.id" :key="gateway.id">
                                    {{ gateway.name }}
                                </option>
                            </select>
                            <input type="text" v-model="accountName" placeholder="Account Name" required />
                            <input type="text" v-model="accountNumber" placeholder="Account Number" required />
                            <button type="submit">{{ editMode ? 'Update' : 'Create' }}</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';

const { props } = usePage();
const payments = ref(props.payments);
const paymentGateways = ref([]);
const searchQuery = ref('');
const showModal = ref(false);
const showGatewayModal = ref(false);
const editMode = ref(false);
const editGatewayMode = ref(false);
const gatewayName = ref('');
const accountName = ref('');
const accountNumber = ref('');
const paymentId = ref(null);
const gatewayId = ref(null);
const selectedGatewayId = ref(null);

const filteredPayments = computed(() => {
    if (!searchQuery.value) return payments.value;
    return payments.value.filter(payment =>
        payment.gateway_name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const fetchPaymentGateways = async () => {
    try {
        const response = await axios.get('/api/payment-gateways');
        paymentGateways.value = response.data;
    } catch (error) {
        console.error('Error fetching payment gateways:', error);
    }
};

const createGateway = async () => {
    try {
        await axios.post(route('payment-gateways.store'), { name: gatewayName.value });
        fetchPaymentGateways();
        showGatewayModal.value = false;
    } catch (error) {
        console.error('Error creating gateway:', error);
    }
};

const editGateway = (gateway) => {
    gatewayId.value = gateway.id;
    gatewayName.value = gateway.name;
    editGatewayMode.value = true;
    showGatewayModal.value = true;
};

const updateGateway = async () => {
    try {
        await axios.put(route('payment-gateways.update', { id: gatewayId.value }), { name: gatewayName.value });
        fetchPaymentGateways();
        showGatewayModal.value = false;
    } catch (error) {
        console.error('Error updating gateway:', error);
    }
};

const createPayment = async () => {
    try {
        await axios.post(route('payment-settings.store'), {
            payment_gateway_id: selectedGatewayId.value,
            account_name: accountName.value,
            account_number: accountNumber.value
        });
        location.reload();
    } catch (error) {
        console.error('Error creating payment:', error);
    }
};

const editPayment = (payment) => {
    paymentId.value = payment.id;
    selectedGatewayId.value = payment.payment_gateway_id;
    accountName.value = payment.account_name;
    accountNumber.value = payment.account_number;
    editMode.value = true;
    showModal.value = true;
};

const updatePayment = async () => {
    try {
        await axios.put(route('payment-settings.update', { id: paymentId.value }), {
            payment_gateway_id: selectedGatewayId.value,
            account_name: accountName.value,
            account_number: accountNumber.value
        });
        location.reload();
    } catch (error) {
        console.error('Error updating payment:', error);
    }
};

onMounted(() => {
    fetchPaymentGateways();
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

.payment-settings-container {
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

.modal-content form input,
.modal-content form select {
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

    .payment-settings-container {
        padding: 10px;
    }

    .modal-content {
        width: 90%;
    }
}
</style>

