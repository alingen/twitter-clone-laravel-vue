<script setup>
import LeftMenuBar from "@/Components/Top/LeftMenuBar.vue";
import RightMenuBar from "@/Components/Top/RightMenuBar.vue";
import Middle from "@/Components/User/Middle.vue";
import Tweet from "@/Components/Tweet.vue";

defineProps({ users: Array, tweets: Array });
</script>
<template>
    <Head title="Top" />
    <!-- component -->
    <div class="bg-white">
        <div class="flex">
            <div class="w-2/5 black h-12 pl-32 py-4 h-auto">
                <!--left menu-->
                <LeftMenuBar />
            </div>

            <div
                class="w-3/5 max-w-xl border border-gray-100 h-auto border-t-0"
            >
                <Middle :users="users" />
                <tr v-for="tweet in tweets" :key="tweet.id">
                    <!-- <td>
                        <Tweet
                            :tweet="tweet"
                            :user="
                                users.find((user) => user.id === tweet.user_id)
                            "
                        />
                    </td> -->
                </tr>
            </div>

            <div class="w-2/5 h-12">
                <!-- <RightMenuBar /> -->
            </div>
        </div>
    </div>
</template>
