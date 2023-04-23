<script setup>
import LeftMenuBar from "@/Components/Top/LeftMenuBar.vue";
import RightMenuBar from "@/Components/Top/RightMenuBar.vue";
import Middle from "@/Components/User/Middle.vue";
import Comment from "@/Components/Comment/Comment.vue";
import Tweet from "@/Components/Tweet.vue";

defineProps({ users: Array, tweet: Object, comments: Array });
</script>
<template>
    <Head title="Top" />
    <!-- component -->
    <div class="bg-white">
        <div class="flex">
            <div class="w-2/5 black h-12 pl-32 py-4 h-auto">
                <!--left menu-->
                <!-- <LeftMenuBar :user="user" /> -->
            </div>

            <div
                class="w-3/5 max-w-xl border border-gray-100 h-auto border-t-0"
            >
                <!-- <Middle :user="user" /> -->

                <Tweet
                    :user="users.find((user) => user.id === tweet.user_id)"
                    :tweet="tweet"
                    :tweet_or_comment="'tweet'"
                />

                <Comment
                    :user="users.find((user) => user.id === tweet.user_id)"
                    :tweet="tweet"
                />

                <tr v-for="comment in comments" :key="comment.id">
                    <td>
                        <Tweet
                            :tweet="comment"
                            :user="
                                users.find(
                                    (user) => user.id === comment.user_id
                                )
                            "
                            :tweet_or_comment="'comment'"
                        />
                    </td>
                </tr>

                <!-- <Tweet :user="user" :tweet="tweet" /> -->
            </div>

            <div class="w-2/5 h-12">
                <!-- <RightMenuBar /> -->
            </div>
        </div>
    </div>
</template>
