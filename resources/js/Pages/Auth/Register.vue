<!--js->Pages->Auth->Register.vue-->

<template>
    <GuestLayout>
        <Head title="Register" />
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-xl-7 p-0">
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
                                    <h4>Create your account</h4>
                                    <p>Enter your personal details to create account</p>
                                    <div class="form-group">
                                        <label class="col-form-label pt-0">Your Name</label>
                                        <TextInput
                                            type="text"
                                            class="form-control"
                                            v-model="form.name"
                                            required
                                            placeholder="Your name"
                                        />
                                        <InputError :message="form.errors.name" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Email Address</label>
                                        <TextInput
                                            type="email"
                                            class="form-control"
                                            v-model="form.email"
                                            required
                                            placeholder="Test@gmail.com"
                                        />
                                        <InputError :message="form.errors.email" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Phone Number</label>
                                        <TextInput
                                            type="text"
                                            class="form-control"
                                            v-model="form.phone"
                                            required
                                            placeholder="123-456-7890"
                                        />
                                        <InputError :message="form.errors.phone" class="mt-2" />
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <div class="position-relative">
                                            <TextInput
                                                type="password"
                                                class="form-control"
                                                v-model="form.password"
                                                required
                                                placeholder="*********"
                                            />
                                            <div class="show-hide"><span class="show"></span></div>
                                            <InputError :message="form.errors.password" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Confirm Password</label>
                                        <div class="position-relative">
                                            <TextInput
                                                type="password"
                                                class="form-control"
                                                v-model="form.password_confirmation"
                                                required
                                                placeholder="*********"
                                            />
                                            <div class="show-hide"><span class="show"></span></div>
                                            <InputError :message="form.errors.password_confirmation" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox p-0">
                                            <label class="flex items-center">
                                                <Checkbox v-model:checked="form.agree" class="custom-checkbox" />
                                                <span class="ms-2 text-sm text-gray-600">Agree with</span>
                                                <Link class="ms-2" href="#">Privacy Policy</Link>
                                            </label>
                                        </div>
                                        <PrimaryButton class="btn btn-primary btn-block w-100" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Create Account
                                        </PrimaryButton>
                                    </div>
                                    <p class="mt-4 mb-0 text-center">
                                        Already have an account?
                                        <Link class="ms-2" href="/login">Sign in</Link>
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

const form = useForm({
    name: '',
    email: '',
    phone: '', // Added phone field
    password: '',
    password_confirmation: '',
    agree: false,
});

const submit = () => {
    console.log('Submitting form:', form);
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
