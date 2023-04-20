<script setup>
defineProps({ users: Array, tweets: Array });

const readmore = (text, length, suffix) => {
    return text.substring(0, length) + suffix;
};
</script>
<template>
    <div class="w-auto">
        <div>
            <img
                src="https://pbs.twimg.com/media/Eo7MRD-UwAAztmk?format=jpg&name=large"
                alt=""
            />
        </div>
        <div class="p-4">
            <div class="flex">
                <div class="-mt-16 ml-2 w-32 mb-2">
                    <img
                        class="bg-white w-28 h-28 rounded-full border white"
                        :src="'/storage/avatars/' + users.avatar"
                        alt=""
                    />
                </div>
                <div class="ml-auto mr-0">
                    <a
                        href="#"
                        class="flex items-center justify-center w-48 px-2 py-2 leading-6 font-semibold rounded-full border gray-200 hover:bg-gray-100"
                    >
                        プロフィールを編集
                    </a>
                </div>
            </div>
            <div class="font-semibold">{{ users.name }}</div>
            <div class="mt-3">{{ users.introduction }}</div>
            <div class="mt-3">
                <ul class="text-gray-500">
                    <li class="flex">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"
                            />
                        </svg>
                        {{ users.place }}
                    </li>
                    <li class="flex">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="inline-block w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"
                            />
                        </svg>

                        <a>{{ readmore(users.website, 20, "...") }}</a>
                    </li>
                    <li class="flex">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z"
                            />
                        </svg>
                        誕生日{{ users.year }}年{{ users.month }}月{{
                            users.day
                        }}日
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav class="flex">
        <div
            class="h-12 w-1/2 hover:bg-gray-100 flex items-center justify-center"
        >
            <p>ツイート</p>
        </div>
        <div
            class="h-12 w-1/2 hover:bg-gray-100 flex items-center justify-center"
        >
            <p>返信</p>
        </div>
        <div
            class="h-12 w-1/2 hover:bg-gray-100 flex items-center justify-center"
        >
            <p>メディア</p>
        </div>
        <div
            class="h-12 w-1/2 hover:bg-gray-100 flex items-center justify-center"
        >
            <p>いいね</p>
        </div>
    </nav>
    <section></section>
</template>
