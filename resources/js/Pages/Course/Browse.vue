<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CoursePreview from "@/Components/CoursePreview.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Filter from "@/Pages/Course/Partials/Filter.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    courses: Object,
    subjects: Array,
});

const getCourses = (url) => {
    router.get(url);
};

const filterCourses = (event, filterSubject, filterGrade) => {
    if (filterSubject == null && filterGrade == null) {
        return;
    }
    if (filterSubject && filterGrade) {
        router.get(
            route("course.browse"),
            {
                subject: filterSubject,
                grade: filterGrade,
            },
            {
                replace: true,
                preserveState: true,
            }
        );
    } else if (filterSubject) {
        router.get(
            route("course.browse"),
            {
                subject: filterSubject,
            },
            {
                replace: true,
                preserveState: true,
            }
        );
    } else if (filterGrade) {
        router.get(
            route("course.browse"),
            {
                grade: filterGrade,
            },
            {
                replace: true,
                preserveState: true,
            }
        );
    }
};
</script>

<template>
    <AppLayout title="Browse Courses">
        <div class="mx-auto md:w-4/5">
            <Filter
                :subjects="subjects"
                class="mb-8"
                @filter="filterCourses"
            ></Filter>
            <div
                class="grid w-[95%] md:w-[100%] grid-cols-1 gap-6 mx-auto sm:grid-cols-2 md:grid-cols-3"
            >
                <div v-for="course in courses.data" :key="course.id">
                    <CoursePreview :course="course" />
                </div>
            </div>
            <div
                class="flex flex-col justify-center mx-auto mt-8 sm:flex-row gap-y-2 gap-x-4 md:w-1/4"
            >
                <SecondaryButton
                    @click="getCourses(courses.prev_page_url)"
                    :disabled="!courses.prev_page_url"
                    class="px-4 py-2 bg-gray-300 rounded"
                >
                    Previous
                </SecondaryButton>
                <div class="my-auto text-white">
                    Page
                    <span class="font-bold text-pink-500">{{
                        courses.current_page
                    }}</span>
                    of
                    <span class="font-bold text-pink-500">{{
                        courses.last_page
                    }}</span>
                </div>
                <SecondaryButton
                    @click="getCourses(courses.next_page_url)"
                    :disabled="!courses.next_page_url"
                    class="px-4 py-2 bg-gray-300 rounded"
                >
                    Next
                </SecondaryButton>
            </div>
        </div>
    </AppLayout>
</template>
