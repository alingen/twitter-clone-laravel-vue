<script setup>
import { ref } from "vue";

defineProps({
    numbers: Object,
});

defineEmits(["update:modelValue"]);

const selected = ref(null);
</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        v-model="selected"
        @change="$emit('update:modelValue', $event.target.value)"
    >
        <option v-for="number in numbers">{{ number }}</option>
    </select>
</template>
