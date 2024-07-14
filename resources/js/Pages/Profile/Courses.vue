<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CoursePreview from "@/Components/CoursePreview.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    courses: Object,
    favourites: Object,
});
</script>

<template>
    <AppLayout title="My Courses">
        <div class="flex flex-col mx-auto align-middle gap-y-8 md:w-2/3">
            <div
                class="flex flex-col justify-between font-bold sm:flex-row text-slate-800 drop-shadow-xl"
            >
                <Link
                    :href="route('profile.courses')"
                    :class="
                        route().current('profile.courses')
                            ? 'bg-pink-500'
                            : 'bg-slate-800 text-white'
                    "
                    class="w-full p-2 overflow-hidden text-2xl duration-150 sm:rounded-s-xl ps-4"
                >
                    <h1 class="text-start">My Courses</h1>
                </Link>
                <Link
                    :href="route('profile.favourites')"
                    :class="
                        route().current('profile.favourites')
                            ? 'bg-pink-500'
                            : 'bg-slate-800 text-white'
                    "
                    class="w-full p-2 overflow-hidden text-2xl pe-4 sm:rounded-e-xl"
                >
                    <h1 class="sm:text-end">Favourite courses</h1>
                </Link>
            </div>
            <div v-if="route().current('profile.courses')">
                <div
                    class="flex flex-col mb-4"
                    v-if="props.courses.length"
                    v-for="course in props.courses"
                >
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
            <div v-if="route().current('profile.favourites')">
                <div
                    class="flex flex-col mb-4"
                    v-if="props.favourites"
                    v-for="favourite in props.favourites"
                >
                    <CoursePreview :course="favourite.course" />
                </div>
                <div class="text-3xl font-bold text-center text-white" v-else>
                    <p class="drop-shadow-xl">
                        You have no favourite courses yet. <br /><br />
                        Click
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
