<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    subjects: Array,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex flex-col items-center justify-center text-white">
            <div
                class="title text-[3rem] sm:text-[15rem] duration-100 font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-400"
            >
                <h1>Bright</h1>

                <h1>Mind</h1>
            </div>
            <div class="w-1/2 text-lg leading-relaxed text-center">
                Welcome to
                <span class="font-bold text-pink-600">BrightMind</span> Unlock
                Your Potential with BrightMind Discover a world of knowledge at
                your fingertips. Whether you want to develop new skills, advance
                your career, or explore new interests, BrightMind is your
                gateway to a brighter future. Join a community of learners and
                experts, access high-quality courses, and embark on your
                learning journey today.
            </div>

            <div class="w-full px-0 mt-24 sm:px-8">
                <h1 class="mb-4 text-2xl font-bold">Explore Courses</h1>
                <div
                    class="grid grid-cols-1 gap-4 overflow-hidden sm:grid-cols-2 md:grid-cols-3 align-center"
                >
                    <div
                        class="flex flex-col justify-between overflow-hidden text-center bg-gray-800 border border-gray-700 rounded-lg shadow-md"
                        v-for="subject in props.subjects"
                    >
                        <div class="flex flex-col justify-between h-full p-4">
                            <div>
                                <img
                                    :src="`/storage/images/${subject.cover_image}`"
                                    alt=""
                                    class="w-20 h-20 mx-auto"
                                />
                            </div>
                            <div>
                                <p class="mt-7">{{ subject.description }}</p>
                                <div class="flex justify-between mt-4">
                                    <p class="text-lg text-slate-400">
                                        Subject:
                                        <span
                                            class="font-extrabold text-pink-400"
                                            >{{ subject.title }}</span
                                        >
                                    </p>
                                    <p class="text-lg text-slate-400">
                                        Grade:
                                        <span
                                            class="font-extrabold text-pink-400"
                                            >{{ subject.grade + 1 }}</span
                                        >
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p
                            @click="$inertia.get(`/courses/${subject.id}`)"
                            class="p-1 text-lg font-extrabold text-white bg-pink-600 hover:cursor-pointer"
                        >
                            View
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
