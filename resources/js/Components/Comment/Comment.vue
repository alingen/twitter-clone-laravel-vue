<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps({ user: Object, tweet: Object });

const form = useForm({
    text: null,
    user_id: null,
    tweet_id: null,
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

    form.tweet_id = props.tweet.id;

    form.post("/comments", {
        preserveScroll: true,
        onSuccess: () => clearInput(),
    });
};
const clearInput = () => {
    if (fileInput.value?.value) {
        fileInput.value.value = null;
    }
    form.text = null;
};
</script>

<template>
    <form @submit.prevent="submit">
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
                    class="bg-transparent font-medium text-lg w-full border-none resize-none"
                    placeholder="返信をツイート"
                    v-model="form.text"
                ></textarea>

                <!-- show preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block w-32 h-32 bg-cover bg-no-repeat bg-center"
                        :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        "
                    />
                </div>
                <div class="flex justify-between">
                    <div class="w-14 ml-1 px-2">
                        <div class="flex items-center">
                            <div class="flex-1 text-center">
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
                        </div>
                    </div>
                    <div>
                        <button
                            class="bg-blue-400 my-2 hover:bg-blue-600 text-white font-bold px-3 py-2 rounded-full float-right"
                            type="submit"
                            :disabled="form.processing"
                        >
                            返信
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
