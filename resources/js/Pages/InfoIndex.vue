<script setup>
import LeftMenuBar from "@/Components/Top/LeftMenuBar.vue";
import MiddleMenu from "@/Components/Info/MiddleMenu.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "@vue/reactivity";
import Infomation from "@/Components/Info/Infomation.vue";
import RightMenuBar from "@/Components/Top/RightMenuBar.vue";
import { defineProps } from "vue";

// const page = usePage();
// const user = computed(() => page.props.auth.user);

const props = defineProps({ notifications: Object, users: Array });

// const user = computed(() => {
//     console.log(notifications)
//     return findUserById(props.notification.user_id_from);
// });

const findUserById = (id) => {
    return props.users.find((user) => user.id === id);
};
</script>
<template>
    <div class="flex">
        <div class="w-2/5 black h-12 pl-32 py-4 h-auto">
            <!-- <LeftMenuBar :user="user" /> -->
        </div>
        <div class="w-3/5 max-w-xl border border-gray-100 h-auto border-t-0">
            <MiddleMenu />
            <tr v-for="notification in notifications" :key="notification.id">
                <Infomation
                    :notification="notification"
                    :user="findUserById(Number(notification.user_id_from))"
                />
            </tr>
        </div>
        <div class="w-2/5 h-12">
            <!-- <RightMenuBar /> -->
        </div>
    </div>
</template>
