<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CoursePreview from "@/Components/CoursePreview.vue";

const props = defineProps({
    courses: Object,
});
</script>

<template>
    <AppLayout title="My Courses">
        <div class="flex flex-col mx-auto align-middle gap-y-8 md:w-2/3">
            <div v-for="course in props.courses">
                <CoursePreview :course="course" />
            </div>
        </div>
    </AppLayout>
</template>
