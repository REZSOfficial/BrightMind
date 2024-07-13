<script setup>
const props = defineProps({
    course: Object,
});
</script>

<template>
    <div
        @click="$inertia.get(`/course/${course.id}`)"
        class="flex flex-col justify-between overflow-hidden text-center duration-100 border border-gray-700 rounded-lg shadow-md hover:cursor-pointer sm:hover:transform sm:hover:scale-105 bg-gradient-to-r from-gray-800 to-gray-700 drop-shadow-xl"
    >
        <div class="flex flex-col justify-between h-full p-4">
            <div>
                <img
                    :src="`/storage/images/${course.cover_image}`"
                    alt=""
                    class="w-20 h-20 mx-auto"
                />
            </div>
            <div>
                <p class="mt-7">{{ course.description }}</p>
                <div class="flex flex-col justify-between mt-4 sm:flex-row">
                    <p class="text-lg text-slate-400">
                        Subject:
                        <span class="font-extrabold text-pink-400">{{
                            course.subject.title
                        }}</span>
                    </p>
                    <p class="text-lg text-slate-400">
                        Grade:
                        <span class="font-extrabold text-pink-400">{{
                            course.grade + 1
                        }}</span>
                    </p>
                </div>
            </div>
        </div>
        <p class="p-1 text-lg font-extrabold text-white bg-pink-600">View</p>
    </div>
</template>
