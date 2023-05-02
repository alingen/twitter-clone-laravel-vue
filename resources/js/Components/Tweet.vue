<script setup>
import { router } from "@inertiajs/vue3";
import axios from "axios";
import { onMounted, onUpdated, ref } from "vue";

const props = defineProps({
    user: Object,
    tweet: Object,
    tweet_or_comment: String,
});

const isLike = ref(false);

onMounted(() => {
    like_check();
});

async function like_check() {
    const path = `/tweets/${props.tweet.id}/liked`;

    try {
        const res = await axios.get(path);
        isLike.value = res.data === 1;
    } catch (err) {
        console.log(err);
    }
}

const likeTweet = () => {
    router.post(route("tweets.likes.store", { tweet: props.tweet.id }));
    isLike.value = !isLike.value;
};

const deleteLike = () => {
    router.delete(
        route("tweets.likes.destroy", { tweet: props.tweet.id, like: 1 })
    );
    isLike.value = !isLike.value;
};
</script>

<template>
    <div class="flex flex-shrink-0 p-4 pb-0">
        <a href="#" class="flex-shrink-0 group block">
            <div class="flex items-center">
                <div>
                    <img
                        class="inline-block h-10 w-10 rounded-full"
                        :src="'/storage/avatars/' + user.avatar"
                    />
                </div>
                <div class="ml-3">
                    <p class="text-base leading-6 font-medium text-black">
                        {{ user.name }}
                        <span
                            class="text-sm leading-5 font-medium text-gray-400 group-hover:text-gray-300 transition ease-in-out duration-150"
                        >
                            {{ user.id }}
                            {{ tweet.created_at }}
                        </span>
                    </p>
                </div>
            </div>
        </a>
    </div>
    <div class="pl-16">
        <a
            v-if="tweet_or_comment === 'tweet'"
            :href="route('tweets.show', { tweet: tweet.id })"
            ><p class="text-base width-auto font-medium text-black flex-shrink">
                {{ tweet.text }}
            </p></a
        >
        <a v-else-if="tweet_or_comment === 'comment'" href="#"
            ><p class="text-base width-auto font-medium text-black flex-shrink">
                {{ tweet.text }}
            </p></a
        >

        <img
            v-if="tweet.image"
            class="block w-32 h-32 bg-cover bg-no-repeat bg-center"
            :src="'/storage/images/' + tweet.image"
        />
        <div class="flex">
            <div class="w-full">
                <div class="flex items-center">
                    <div class="flex-1 text-center">
                        <a
                            href="#"
                            class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
                        >
                            <svg
                                class="text-center h-6 w-6"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                                ></path>
                            </svg>
                        </a>
                    </div>

                    <div class="flex-1 text-center py-2 m-2">
                        <a
                            href="#"
                            class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
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
                                    d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"
                                ></path>
                            </svg>
                        </a>
                    </div>

                    <!-- ハート -->
                    <div class="flex-1 text-center py-2 m-2">
                        <button
                            v-if="isLike === true"
                            @click="deleteLike"
                            class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
                        >
                            <svg
                                class="stroke-red-300 fill-red-300 text-center h-7 w-6"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                ></path>
                            </svg>
                        </button>
                        <button
                            v-else
                            @click="likeTweet"
                            class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
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
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex-1 text-center py-2 m-2">
                        <a
                            href="#"
                            class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
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
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                                ></path>
                            </svg>
                        </a>
                    </div>
                    <div class="flex-1 text-center py-2 m-2">
                        <a
                            href="#"
                            class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
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
                                    d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"
                                ></path>
                            </svg>
                        </a>
                    </div>
                    <div class="flex-1 text-center py-2 m-2">
                        <a
                            href="#"
                            class="w-12 mt-1 group flex items-center text-gray-500 px-3 py-2 text-base leading-6 font-medium rounded-full hover:bg-gray-200 hover:text-blue-300"
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
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                ></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-gray-100" />
</template>
