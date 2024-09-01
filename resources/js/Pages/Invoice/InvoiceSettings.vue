<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoice Settings</h2>
        </template>

        <div class="container">
            <aside class="sidebar">
                <SideNavbar />
            </aside>

            <main class="invoice-settings-container">
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="company_person_name">Company/Person Name</label>
                            <input type="text" v-model="form.company_person_name" required>
                        </div>
                        <div>
                            <label for="emails">Email</label>
                            <div v-for="(email, index) in form.emails" :key="index">
                                <input type="email" v-model="form.emails[index]" required>
                                <button type="button" @click="removeEmail(index)">Remove</button>
                            </div>
                            <button type="button" @click="addEmail">+ Add More Email</button>
                        </div>
                        <div>
                            <label for="phones">Phone</label>
                            <div v-for="(phone, index) in form.phones" :key="index">
                                <input type="text" v-model="form.phones[index]" required>
                                <button type="button" @click="removePhone(index)">Remove</button>
                            </div>
                            <button type="button" @click="addPhone">+ Add More Phone</button>
                        </div>
                        <div>
                            <label for="base_currency_id">Select Base Currency</label>
                            <select v-model="form.base_currency_id" required>
                                <option v-for="currency in currencies" :value="currency.id" :key="currency.id">
                                    {{ currency.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="address">Address</label>
                            <input type="text" v-model="form.address">
                        </div>
                        <div>
                            <label for="website">Website</label>
                            <input type="text" v-model="form.website">
                        </div>
                        <div>
                            <label for="social_media_links">Social Media Link</label>
                            <div v-for="(link, index) in form.social_media_links" :key="index">
                                <input type="url" v-model="form.social_media_links[index]">
                                <button type="button" @click="removeSocialMediaLink(index)">Remove</button>
                            </div>
                            <button type="button" @click="addSocialMediaLink">+ Add More Link</button>
                        </div>
                        <div>
                            <label for="invoice_created_by">Invoice Created By</label>
                            <input type="text" v-model="form.invoice_created_by" disabled>
                        </div>
                        <div>
                            <label for="logo">Upload Logo</label>
                            <input type="file" @change="onLogoChange">
                            <img v-if="form.logo_path" :src="form.logo_path" alt="Logo Preview" class="preview">
                        </div>
                        <div>
                            <label for="watermark_logo">Water Mark Logo</label>
                            <input type="file" @change="onWatermarkLogoChange">
                            <img v-if="form.watermark_logo_path" :src="form.watermark_logo_path" alt="Watermark Logo Preview" class="preview">
                        </div>
                        <div>
                            <label for="sender_references">Sender References</label>
                            <div v-for="(reference, index) in form.sender_references" :key="index">
                                <input type="text" v-model="reference.name" placeholder="Name">
                                <input type="email" v-model="reference.email" placeholder="Email">
                                <input type="text" v-model="reference.phone" placeholder="Phone">
                                <button type="button" @click="removeSenderReference(index)">Remove</button>
                            </div>
                            <button type="button" @click="addSenderReference">+ Add More Reference</button>
                        </div>
                    </div>
                    <button type="submit">Save</button>
                </form>
            </main>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SideNavbar from '@/Components/Customer/SideNavbar.vue';

const { props } = usePage();
const currencies = ref(props.currencies || []);

const form = reactive({
    company_person_name: '',
    emails: [],
    phones: [],
    base_currency_id: '',
    address: '',
    website: '',
    social_media_links: [],
    invoice_created_by: props.invoiceCreatedBy || '',
    logo: null,
    watermark_logo: null,
    sender_references: [],
    package_id: props.packageId
});

onMounted(() => {
    if (props.invoiceSetting) {
        Object.assign(form, {
            ...props.invoiceSetting,
            emails: props.invoiceSetting.emails || [],
            phones: props.invoiceSetting.phones || [],
            social_media_links: props.invoiceSetting.social_media_links || [],
            sender_references: props.invoiceSetting.sender_references || [],
            logo_path: props.invoiceSetting.logo_path || '',
            watermark_logo_path: props.invoiceSetting.watermark_logo_path || '',
            website: props.invoiceSetting.website || '',
            package_id: props.packageId
        });
    }
});

const addEmail = () => form.emails.push('');
const removeEmail = index => form.emails.splice(index, 1);

const addPhone = () => form.phones.push('');
const removePhone = index => form.phones.splice(index, 1);

const addSocialMediaLink = () => form.social_media_links.push('');
const removeSocialMediaLink = index => form.social_media_links.splice(index, 1);

const addSenderReference = () => form.sender_references.push({ name: '', email: '', phone: '' });
const removeSenderReference = index => form.sender_references.splice(index, 1);

const onLogoChange = e => {
    const file = e.target.files[0];
    form.logo = file;

    const reader = new FileReader();
    reader.onload = (e) => {
        form.logo_path = e.target.result;
    };
    reader.readAsDataURL(file);
};

const onWatermarkLogoChange = e => {
    const file = e.target.files[0];
    form.watermark_logo = file;

    const reader = new FileReader();
    reader.onload = (e) => {
        form.watermark_logo_path = e.target.result;
    };
    reader.readAsDataURL(file);
};

const submit = () => {
    const formData = new FormData();
    for (let key in form) {
        if (key === 'logo' || key === 'watermark_logo') {
            if (form[key]) {
                formData.append(key, form[key]);
            }
        } else if (Array.isArray(form[key])) {
            form[key].forEach((item, index) => {
                if (key === 'sender_references') {
                    formData.append(`${key}[${index}][name]`, item.name || '');
                    formData.append(`${key}[${index}][email]`, item.email || '');
                    formData.append(`${key}[${index}][phone]`, item.phone || '');
                } else {
                    formData.append(`${key}[${index}]`, item);
                }
            });
        } else {
            formData.append(key, form[key]);
        }
    }
    router.post(route('invoice.settings.update'), formData);
};
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

.sidebar .logo h2 {
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
    display: flex;
    align-items: center;
    padding: 15px 20px;
    cursor: pointer;
}

.sidebar ul li i {
    font-size: 18px;
    margin-right: 10px;
}

.sidebar ul li span {
    font-size: 16px;
    color: #333;
}

.invoice-settings-container {
    flex: 1;
    background-color: #b0c4de;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.grid {
    display: grid;
}

.grid-cols-2 {
    grid-template-columns: repeat(2, minmax(0, 1fr));
}

.gap-4 {
    gap: 1rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="url"],
select {
    width: 100%;
    padding: 0.5rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="file"] {
    margin-bottom: 1rem;
}

button {
    padding: 0.5rem 1rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 1rem; /* Added margin to buttons for spacing */
}

button[type="button"] {
    background-color: #dc3545; /* Red color for remove buttons */
    color: white; /* White text color for remove buttons */
}

img.preview {
    width: 100px;
    height: auto;
    margin-top: 10px;
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 4px;
}
</style>
