<script setup>
import { ref } from "vue";
import { useForm } from "@Inertiajs/vue3";
defineProps({ user: Object });

const form = useForm({
    text: null,
    user_id: null,
    image: null,
});

const fileInput = ref(null);
const photoPreview = ref(null);
const openFilePicker = () => {
    fileInput.value.click();
};
const updateFilePreview = () => {
    const file = fileInput.value.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
};

const submit = () => {
    if (fileInput.value) {
        form.image = fileInput.value.files[0];
    }

    form.post("/tweets", {
        preserveScroll: true,
        // onSuccess: () => clearPhotoFileInput(),
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <div>
            <div class="m-1">
                <h2 class="px-4 py-2 text-xl font-semibold text-black">
                    ホーム
                </h2>
            </div>
            <div class="flex">
                <div
                    class="h-12 w-1/2 hover:bg-gray-100 flex items-center justify-center"
                >
                    <p>おすすめ</p>
                </div>
                <div
                    class="h-12 w-1/2 hover:bg-gray-100 flex items-center justify-center"
                >
                    <p>フォロー中</p>
                </div>
            </div>
        </div>

        <hr class="border-gray-100" />
        <!--middle creat tweet-->
        <div class="flex">
            <div class="m-2 w-10 py-1">
                <a :href="'/user/' + user.id"
                    ><img
                        class="inline-block h-10 w-10 rounded-full"
                        :src="'/storage/avatars/' + user.avatar"
                        alt=""
                /></a>
            </div>
            <div class="flex-1 px-2 pt-2 mt-2">
                <textarea
                    id="text"
                    class="bg-transparent text-gray-400 font-medium text-lg w-full"
                    rows="2"
                    cols="50"
                    placeholder="いまどうしてる?"
                    v-model="form.text"
                ></textarea>
            </div>
        </div>
        <!-- Current Profile Photo -->
        <!-- <div v-show="!photoPreview" class="mt-2">
            <img
                :src="user.profile_photo_url"
                :alt="user.name"
                class="rounded-full h-20 w-20 object-cover"
            />
        </div> -->
        <!-- show phpto preview -->
        <div v-show="photoPreview" class="mt-2">
            <span
                class="block w-32 h-32 bg-cover bg-no-repeat bg-center"
                :style="'background-image: url(\'' + photoPreview + '\');'"
            />
        </div>
        <!--middle creat tweet below icons-->
        <div class="flex">
            <div class="w-10"></div>

            <div class="w-64 px-2">
                <div class="flex items-center">
                    <div class="flex-1 text-center px-1 py-1 m-2">
                        <a
                            href="#"
                            class="mt-1 group flex items-center text-blue-400 px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
                        >
                            <input
                                id="file"
                                type="file"
                                ref="fileInput"
                                name="file"
                                style="display: none"
                                @change="updateFilePreview"
                            />
                            <svg
                                class="text-center h-7 w-6"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                @click="openFilePicker"
                            >
                                <path
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                ></path>
                            </svg>
                        </a>
                    </div>

                    <div class="flex-1 text-center py-2 m-2">
                        <a
                            href="#"
                            class="mt-1 group flex items-center text-blue-400 px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
                        >
                            <svg
                                class="text-center h-7 w-6"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"
                                ></path>
                                <path
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                        </a>
                    </div>

                    <div class="flex-1 text-center py-2 m-2">
                        <a
                            href="#"
                            class="mt-1 group flex items-center text-blue-400 px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
                        >
                            <svg
                                class="text-center h-7 w-6"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                ></path>
                            </svg>
                        </a>
                    </div>

                    <div class="flex-1 text-center py-2 m-2">
                        <a
                            href="#"
                            class="mt-1 group flex items-center text-blue-400 px-2 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
                        >
                            <svg
                                class="text-center h-7 w-6"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                ></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex-1">
                <button
                    class="bg-blue-400 mt-5 hover:bg-blue-600 text-white font-bold py-2 px-8 rounded-full mr-8 float-right"
                    type="submit"
                    :disabled="form.processing"
                >
                    Tweet
                </button>
            </div>
        </div>

        <hr class="border-gray-100 border-1" />
    </form>
</template>
