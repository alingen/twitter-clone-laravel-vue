<script setup>
const props = defineProps({ notification: Object, user: Object });
</script>
<template>
    <div class="flex flex-shrink-0 p-4 pb-0">
        <a href="#" class="flex-shrink-0 group block">
            <div class="flex items-center">
                <div>
                    <!-- ハート -->
                    <svg
                        v-if="notification.infomation_type === 'Like'"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                        class="inline-block h-8 w-8 fill-pink-500"
                    >
                        <g>
                            <path
                                d="M20.884 13.19c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z"
                            ></path>
                        </g>
                    </svg>
                    <!-- 人 -->
                    <svg
                        v-if="notification.infomation_type === 'Comment'"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                        class="inline-block h-8 w-8 fill-blue-500"
                    >
                        <g>
                            <path
                                d="M17.863 13.44c1.477 1.58 2.366 3.8 2.632 6.46l.11 1.1H3.395l.11-1.1c.266-2.66 1.155-4.88 2.632-6.46C7.627 11.85 9.648 11 12 11s4.373.85 5.863 2.44zM12 2C9.791 2 8 3.79 8 6s1.791 4 4 4 4-1.79 4-4-1.791-4-4-4z"
                            ></path>
                        </g>
                    </svg>
                    <!-- リツイート -->
                    <svg
                        v-if="notification.infomation_type === 'Retweet'"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                        class="inline-block h-8 w-8 fill-green-500"
                    >
                        <g>
                            <path
                                d="M4.75 3.79l4.603 4.3-1.706 1.82L6 8.38v7.37c0 .97.784 1.75 1.75 1.75H13V20H7.75c-2.347 0-4.25-1.9-4.25-4.25V8.38L1.853 9.91.147 8.09l4.603-4.3zm11.5 2.71H11V4h5.25c2.347 0 4.25 1.9 4.25 4.25v7.37l1.647-1.53 1.706 1.82-4.603 4.3-4.603-4.3 1.706-1.82L18 15.62V8.25c0-.97-.784-1.75-1.75-1.75z"
                            ></path>
                        </g>
                    </svg>
                </div>
                <div class="ml-3">
                    <img
                        class="bg-white inline-block h-8 w-8 rounded-full border white"
                        :src="'/storage/avatars/' + user.avatar"
                    />
                </div>
            </div>
        </a>
    </div>
    <!-- いいね -->
    <a href="#" v-if="notification.infomation_type === 'Like'">
        <div class="pl-16">
            <p class="text-base width-auto font-medium text-black flex-shrink">
                {{ user.name }} さんがあなたのツイートをいいねしました
            </p>
            <p class="text-base width-auto font-medium text-black flex-shrink">
                {{ notification.text }}
            </p>
        </div></a
    >
    <!-- リツイート -->
    <a href="#" v-if="notification.infomation_type === 'Retweet'">
        <div class="pl-16">
            <p class="text-base width-auto font-medium text-black flex-shrink">
                {{ user.name }} さんがあなたのツイートをリツートしました
            </p>
            <p class="text-base width-auto font-medium text-black flex-shrink">
                {{ notification.text }}
            </p>
        </div></a
    >
    <!-- コメント -->
    <a href="#" v-if="notification.infomation_type === 'Comment'">
        <div class="pl-16">
            <p class="text-base width-auto font-medium text-black flex-shrink">
                {{ user.name }} さんがあなたのツイートにコメントしました
            </p>
            <p class="text-base width-auto font-medium text-black flex-shrink">
                {{ notification.text }}
            </p>
        </div></a
    >

    <hr class="border-gray-100" />
</template>
