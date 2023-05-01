<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { onMounted } from "@vue/runtime-core";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});
onMounted(() => {
    document.querySelector("body").classList.add("login");
});
const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="container sm:px-10">
                <div class="block xl:grid grid-cols-2 gap-4">
                    <!-- BEGIN: Login Info -->
                    <div class="hidden xl:flex flex-col min-h-screen">
                        <a href="" class="-intro-x flex items-center pt-5">
                            <img
                                alt="Matchbox"
                                class="w-12"
                                src="/assets/logo.png"
                            />
                            <span class="text-white text-lg ml-3">
                                Matchbox
                            </span>
                        </a>
                        <div class="my-auto">
                            <img
                                alt="Midone Tailwind HTML Admin Template"
                                class="-intro-x w-1/2 -mt-16"
                                src="/assets/images/illustration.svg"
                            />
                            <div
                                class="-intro-x text-white font-medium text-4xl leading-tight mt-10"
                            >
                                A few more clicks to <br />
                                sign in to your account.
                            </div>
                        </div>
                    </div>
                    <!-- END: Login Info -->
                    <!-- BEGIN: Login Form -->
                    <div
                        class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0"
                    >
                        <div
                            class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto"
                        >
                            <h2
                                class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left"
                            >
                                Sign In
                            </h2>
                            <div
                                class="intro-x mt-2 text-slate-400 xl:hidden text-center"
                            >
                                A few more clicks to sign in to your account.
                            </div>
                            <div class="intro-x mt-8">
                                <input
                                    type="email"
                                    class="intro-x login__input form-control py-3 px-4 block"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Email"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                                <input
                                    type="password"
                                    class="intro-x login__input form-control py-3 px-4 block mt-4"
                                    placeholder="Password"
                                    v-model="form.password"
                                    required
                                    autocomplete="current-password"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.password.email"
                                />
                            </div>
                            <div
                                class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4"
                            >
                                <div class="flex items-center mr-auto">
                                    <input
                                        id="remember-me"
                                        type="checkbox"
                                        class="form-check-input border mr-2"
                                    />
                                    <label
                                        class="cursor-pointer select-none"
                                        for="remember-me"
                                        >Remember me</label
                                    >
                                </div>
                                <a href="">Forgot Password?</a>
                            </div>
                            <div
                                class="intro-x mt-5 xl:mt-8 text-center xl:text-left"
                            >
                                <PrimaryButton
                                    class="ml-4 btn btn-primary py-3 px-4 w-full"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Log in
                                </PrimaryButton>
                            </div>
                        </div>
                    </div>
                    <!-- END: Login Form -->
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
