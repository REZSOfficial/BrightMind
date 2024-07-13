<script setup>
const props = defineProps({
    course: Object,
});
</script>

<template>
    <div
        class="flex flex-col justify-between overflow-hidden text-center bg-gray-800 border border-gray-700 rounded-lg shadow-md drop-shadow-xl"
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
                            course.title
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
        <p
            @click="$inertia.get(`/course/${course.id}`)"
            class="p-1 text-lg font-extrabold text-white bg-pink-600 hover:cursor-pointer"
        >
            View
        </p>
    </div>
</template>
