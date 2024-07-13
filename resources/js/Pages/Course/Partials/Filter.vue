<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from "vue";
const props = defineProps({
    subjects: Array,
});

const filterSubject = ref(null);
const filterGrade = ref(null);
</script>

<template>
    <div
        class="flex flex-col w-full gap-4 p-2 text-pink-500 bg-pink-600 rounded md:flex-row drop-shadow-xl"
    >
        <select
            @change="filterSubject = $event.target.value"
            class="w-full rounded bg-slate-800 focus:border-pink-800 focus:ring-pink-800 active:border-pink-800 active:ring-pink-800"
        >
            <option disabled selected>Subject</option>
            <option
                v-for="subject in subjects"
                :key="subject.id"
                :value="subject.id"
            >
                {{ subject.title }}
            </option>
        </select>

        <select
            @change="filterGrade = $event.target.value"
            class="w-full rounded bg-slate-800 focus:border-pink-800 focus:ring-pink-800 active:border-pink-800 active:ring-pink-800"
        >
            <option selected disabled>Grade</option>
            <option v-for="i in 12" :key="i" :value="i">
                {{ i }}
            </option>
        </select>

        <PrimaryButton
            @click="$emit('filter', $event, filterSubject, filterGrade)"
            >Filter</PrimaryButton
        >
    </div>
</template>
