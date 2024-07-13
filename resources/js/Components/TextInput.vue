<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="text-white border-0 rounded-md shadow-sm bg-slate-900 focus:border-white focus:ring-white"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
