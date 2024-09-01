<!--js->Pages->Auth->Login.vue-->

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-7 order-1">
                    <img class="bg-img-cover bg-center" src="/template/assets/images/login/1.jpg" alt="login page" />
                </div>
                <div class="col-xl-5 p-0">
                    <div class="login-card login-dark custom-margin">
                        <div>
                            <div>
                                <a class="logo text-start" href="/">
                                    <img class="img-fluid for-light" src="/template/assets/images/logo/logo.png" alt="login page" />
                                </a>
                            </div>
                            <div class="login-main">
                                <form @submit.prevent="submit">
                                    <h4>Sign in to account</h4>
                                    <p>Enter your email & password to login</p>
                                    <div class="form-group">
                                        <label class="col-form-label">Email Address</label>
                                        <TextInput
                                            id="email"
                                            type="email"
                                            class="mt-1 block w-full input-field"
                                            v-model="form.email"
                                            required
                                            autofocus
                                            autocomplete="username"
                                        />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <div class="position-relative">
                                            <TextInput
                                                id="password"
                                                type="password"
                                                class="mt-1 block w-full input-field"
                                                v-model="form.password"
                                                required
                                                autocomplete="current-password"
                                            />
                                            <div class="show-hide"><span class="show"></span></div>
                                        </div>
                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox p-0">
                                            <label class="flex items-center">
                                                <Checkbox name="remember" v-model:checked="form.remember" class="custom-checkbox" />
                                                <span class="ms-2 text-sm text-gray-600">Remember password</span>
                                            </label>
                                        </div>
                                        <Link
                                            v-if="canResetPassword"
                                            :href="route('password.request')"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        >
                                            Forgot your password?
                                        </Link>
                                        <div class="text-end mt-3">
                                            <PrimaryButton class="btn btn-primary btn-block w-100" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Sign in
                                            </PrimaryButton>
                                        </div>
                                    </div>
                                    <p class="mt-4 mb-0 text-center">
                                        Don't have account?
                                        <Link class="ms-2" :href="route('register')">Create Account</Link>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Checkbox from '@/Components/Checkbox.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { defineProps } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
    login_type: 'user', // Ensure this line is included
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
            if (form.hasErrors) {
                // Handle errors
            } else {
                // Redirect to dashboard
                window.location.href = '/dashboard';
            }
        },
    });
};

// Dynamically load landing-slick.js
if (typeof window !== 'undefined') {
    const script = document.createElement('script');
    script.src = '/template/assets/js/landing-slick.js';
    script.defer = true;
    document.head.appendChild(script);
}
</script>

<style scoped>
/* Add your custom styles here */

/* Input fields custom styles */
.input-field {
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
    box-sizing: border-box;
    width: 100%;
}

.input-field:focus {
    outline: none;
    border-color: #4A90E2; /* Blue border on focus */
}

/* Remove padding and background color from form-input class */
.form-input {
    padding: 0 !important;
    background-color: transparent !important;
}

/* Add margin around login-card login-dark */
.custom-margin {
    margin: 20px; /* Adjust the margin value as needed */
}

/* Reset default checkbox styling */
.checkbox input[type="checkbox"] {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 16px;
    height: 16px;
    border: 1px solid #ccc;
    border-radius: 2px;
    outline: none;
    cursor: pointer;
    position: relative;
    margin-right: 8px;
}

.checkbox input[type="checkbox"]:checked {
    background-color: #4A90E2;
    border-color: #4A90E2;
}

.checkbox input[type="checkbox"]:checked::before {
    content: '✔';
    color: #fff;
    font-size: 12px;
    position: absolute;
    top: 1px;
    left: 2px;
}
</style>
