<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from "vue";

const props = defineProps({
    subject: Object,
    course: Object,
});

const pageNumber = ref(0);

const handlePage = (action) => {
    if (action === "next") {
        pageNumber.value++;
    } else if (action === "back") {
        pageNumber.value--;
    }
};

const handleAnswer = (answer) => {
    props.course.content[pageNumber.value].data.answer.forEach((answer) => {
        const selectedElement = document.querySelector(`#${answer}`);
        selectedElement.classList.remove("bg-green-500", "hover:bg-green-600");
        selectedElement.classList.remove("bg-red-500", "hover:bg-red-600");
    });
    const selectedElement = document.querySelector(`#${answer}`);
    if (props.course.content[pageNumber.value].data.correct === answer) {
        selectedElement.classList.add("bg-green-500", "hover:bg-green-600");
    } else {
        selectedElement.classList.add("bg-red-500", "hover:bg-red-600");
    }
};
</script>

<template>
    <AppLayout :title="subject.title">
        <div>
            <div
                class="flex flex-col w-full mx-auto text-white bg-gray-800 border border-gray-700 rounded-t-lg shadow-md md:w-1/2 sm:p-4"
            >
                <h1>
                    <span class="font-extrabold text-pink-500">{{
                        subject.title
                    }}</span>
                    by:
                    {{ subject.user.name }}
                </h1>
                <h1 class="text-pink-500">
                    {{ course.title }}
                </h1>
            </div>

            <div
                class="flex flex-col w-full mx-auto text-white bg-gray-800 border border-gray-700 rounded-b-lg shadow-md md:w-1/2 sm:p-4"
            >
                <!--Learn-->
                <div v-if="course.content[pageNumber].type === 'text'">
                    <h1>Learn</h1>
                    <div class="my-3 border-t-2"></div>
                    <div class="text-lg leading-relaxed text-gray-400">
                        {{ course.content[pageNumber].data }}
                    </div>
                </div>
                <!--Question-->
                <div v-else>
                    <h1>
                        Question:
                        <span class="font-bold text-pink-500">{{
                            course.content[pageNumber].data.question
                        }}</span>
                    </h1>
                    <div class="my-3 border-t-2"></div>
                    <div id="answer-container" class="flex flex-wrap gap-4">
                        <p
                            @click="handleAnswer(answer)"
                            v-for="answer in course.content[pageNumber].data
                                .answers"
                            :id="answer"
                            class="w-full p-2 text-xl font-bold text-center duration-100 border rounded hover:cursor-pointer focus:bg-pink-600 hover:bg-pink-500"
                        >
                            {{ answer }}
                        </p>
                    </div>
                </div>
                <!--Buttons-->
                <div
                    class="flex justify-end mt-3 text-3xl font-bold me-2 gap-x-2"
                >
                    <button
                        v-if="pageNumber > 0"
                        @click="handlePage('back')"
                        class="px-3 text-pink-500 duration-100 rounded hover:bg-slate-700 active:bg-slate-600"
                    >
                        &lt;
                    </button>
                    <button
                        @click="handlePage('next')"
                        v-if="pageNumber < course.content.length - 1"
                        class="px-3 text-pink-500 duration-100 rounded hover:bg-slate-700 active:bg-slate-600"
                    >
                        &gt;
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
