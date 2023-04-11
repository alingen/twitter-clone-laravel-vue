<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import dayjs from "dayjs";
import Select from "@/Components/Select.vue";

const form = useForm({
    name: "",
    email: "",
    introduction: "",
    password: "",
    password_confirmation: "",
    year: "",
    month: "",
    day: "",
    phone: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};

const years = [...Array(120)].map((_, i) => String(dayjs().year() - i)); // 120年前まで入力可能
const months = [...Array(12)].map((_, i) => String(i + 1));
const days = [...Array(31)].map((_, i) => String(i + 1));
// const intl = new Intl.DateTimeFormat("ja-JP-u-ca-japanese", {
//     era: "long",
// });
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="名前" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="メール" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="introduction" value="紹介" />

                <TextInput
                    id="introduction"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.introduction"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.introduction" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="パスワード" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="パスワード（確認用）"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="電話番号(ハイフンなし)" />

                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    required
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 flex space-x-3">
                <div class="">
                    <InputLabel for="year" value="年" />

                    <Select
                        id="year"
                        type="select"
                        class="mt-1 w-full"
                        v-model="form.year"
                        :numbers="years"
                    />
                </div>

                <div>
                    <InputLabel for="month" value="月" />

                    <Select
                        id="month"
                        type="select"
                        class="mt-1 w-full"
                        v-model="form.month"
                        :numbers="months"
                    />
                </div>
                <div>
                    <InputLabel for="day" value="日" />

                    <Select
                        id="day"
                        type="select"
                        class="mt-1 w-full"
                        v-model="form.day"
                        :numbers="days"
                    />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
