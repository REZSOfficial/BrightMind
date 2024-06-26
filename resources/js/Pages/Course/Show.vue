<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref } from "vue";

const props = defineProps({
    subject: Object,
    course: Object,
});

const pageNumber = ref(0);

const givenAnswers = ref([]);

const handlePage = (action) => {
    if (props.course.content[pageNumber.value].data.answers) {
        props.course.content[pageNumber.value].data.answers.forEach(
            (answer) => {
                const currentElement = document.querySelector(`#${answer}`);
                currentElement.disabled = true;
            }
        );
    }

    if (action === "next") {
        pageNumber.value++;
    }

    if (action === "results") {
        pageNumber.value = -1;
    }
};

const handleAnswer = (answer) => {
    const selectedElement = document.querySelector(`#${answer}`);
    selectedElement.classList.add("bg-pink-600");

    if (props.course.content[pageNumber.value].data.correct === answer) {
        givenAnswers.value.push({
            pageNumber: pageNumber.value,
            givenAnswer: answer,
            correct: true,
        });
    } else {
        givenAnswers.value.push({
            pageNumber: pageNumber.value,
            givenAnswer: answer,
            correct: false,
            correctAnswer: props.course.content[pageNumber.value].data.correct,
        });
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
                <div
                    v-if="
                        pageNumber !== -1 &&
                        course.content[pageNumber].type === 'text'
                    "
                >
                    <h1>Learn</h1>
                    <div class="my-3 border-t-2"></div>
                    <div class="text-lg leading-relaxed text-gray-400">
                        {{ course.content[pageNumber].data }}
                    </div>
                </div>
                <!--Question-->
                <div
                    v-else-if="
                        pageNumber !== -1 &&
                        course.content[pageNumber].type === 'question'
                    "
                >
                    <h1>
                        Question:
                        <span class="font-bold text-pink-500">{{
                            course.content[pageNumber].data.question
                        }}</span>
                    </h1>
                    <div class="my-3 border-t-2"></div>
                    <div id="answer-container" class="flex flex-wrap gap-4">
                        <button
                            @click="handleAnswer(answer)"
                            v-for="answer in course.content[pageNumber].data
                                .answers"
                            :id="answer"
                            class="w-full p-2 text-xl font-bold text-center duration-100 border rounded hover:cursor-pointer active:bg-pink-600 hover:bg-pink-500"
                        >
                            {{ answer }}
                        </button>
                    </div>
                </div>
                <!--Results-->
                <div v-if="pageNumber === -1">
                    <h1>Results:</h1>
                    <div class="my-3 border-t-2"></div>

                    <div v-for="answer in givenAnswers" class="flex flex-row">
                        <p
                            :class="
                                answer.correct
                                    ? 'text-green-500'
                                    : 'text-red-500'
                            "
                        >
                            {{ answer.pageNumber }}. {{ answer.givenAnswer }}
                        </p>
                        <p
                            class="text-green-500 duration-100 bg-green-500 ms-3 hover:bg-transparent"
                            v-if="!answer.correct"
                        >
                            Correct Answer:
                            {{ answer.correctAnswer }}
                        </p>
                    </div>
                </div>
                <!--Buttons-->
                <div
                    class="flex justify-end mt-3 text-3xl font-bold me-2 gap-x-2"
                >
                    <button
                        :id="`next-btn-${pageNumber}`"
                        @click="handlePage('next')"
                        v-if="pageNumber < course.content.length - 1"
                        class="px-3 text-pink-500 duration-100 rounded hover:bg-slate-700 active:bg-slate-600"
                    >
                        &gt;
                    </button>
                    <button
                        v-else
                        @click="handlePage('results')"
                        class="px-3 text-pink-500 duration-100 border-b-2 border-pink-600 text-md hover:bg-slate-700 active:bg-slate-600"
                    >
                        Results
                    </button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
