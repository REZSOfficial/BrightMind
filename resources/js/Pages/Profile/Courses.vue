<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CoursePreview from "@/Components/CoursePreview.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    courses: Object,
});
</script>

<template>
    <AppLayout title="My Courses">
        <div class="flex flex-col mx-auto align-middle gap-y-8 md:w-2/3">
            <div v-if="props.courses.length" v-for="course in props.courses">
                <CoursePreview :course="course" />
            </div>
            <div class="text-3xl font-bold text-center text-white" v-else>
                <p class="drop-shadow-xl">
                    You have not created any courses yet. <br /><br />
                    Click
                    <Link
                        class="text-pink-500 underline"
                        :href="route('course.create')"
                        >here</Link
                    >
                    to create one now!
                </p>
            </div>
        </div>
    </AppLayout>
</template>
