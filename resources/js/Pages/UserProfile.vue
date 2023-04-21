<script setup>
import LeftMenuBar from "@/Components/Top/LeftMenuBar.vue";
import RightMenuBar from "@/Components/Top/RightMenuBar.vue";
import Middle from "@/Components/User/Middle.vue";
import Tweet from "@/Components/Tweet.vue";
// import { computed } from "vue";
// import { usePage } from "@inertiajs/vue3";

// const page = usePage();
// const user = computed(() => page.props.auth.user);

defineProps({ user: Object, tweets: Array });
</script>
<template>
    <Head title="Top" />
    <!-- component -->
    <div class="bg-white">
        <div class="flex">
            <div class="w-2/5 black h-12 pl-32 py-4 h-auto">
                <!--left menu-->
                <LeftMenuBar :user="user" />
            </div>

            <div
                class="w-3/5 max-w-xl border border-gray-100 h-auto border-t-0"
            >
                <Middle :user="user" />
                <tr v-for="tweet in tweets" :key="tweet.id">
                    <td>
                        <Tweet :user="user" :tweet="tweet" />
                    </td>
                </tr>
            </div>

            <div class="w-2/5 h-12">
                <!-- <RightMenuBar /> -->
            </div>
        </div>
    </div>
</template>
