<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { nextTick, ref } from "vue";
import axios from "axios";

const props = defineProps({
    course: Object,
    courseJson: Object,
});

const pageNumber = ref(0);

const givenAnswers = ref([]);

const answered = ref(false);

const correctAnswers = ref();

const blurred = ref(true);

const correctAmount = ref(0);

// Check if the content of the current page is a question
const checkContent = () => {
    answered.value = props.courseJson.content[pageNumber.value].type === "text";
};

checkContent();

// Handle the next and previous buttons
const handlePage = (action) => {
    if (action === "next") {
        pageNumber.value++;
        checkContent();
        nextTick(removeBackgroundColor);
    }

    /** Get the correct answers from the API
     *  {
     *    id: 1,
     *    correctAnswer: 'c',
     *    givenAnswer: 'g',
     *   }
     **/
    if (action === "results") {
        axios
            .post("/course/" + props.course.id + "/answers", givenAnswers.value)
            .then((response) => {
                correctAnswers.value = response.data;
            })
            .then(() => {
                getCorrectAmount();
            });

        pageNumber.value = -1;
    }
};

const handleAnswer = (answer) => {
    answered.value = true;

    // Check if an answer for the current page already exists
    const existingAnswerIndex = givenAnswers.value.findIndex(
        (item) => item.id === props.courseJson.content[pageNumber.value].id
    );

    removeBackgroundColor();

    // Add the background color to the selected answer
    const selectedElement = document.querySelector(`#answer-${answer}`);
    selectedElement.classList.add("bg-pink-600");

    // If the answer already exists, update it
    if (existingAnswerIndex !== -1) {
        givenAnswers.value[existingAnswerIndex] = {
            ...givenAnswers.value[existingAnswerIndex],
            givenAnswer: answer,
        };
    } else {
        // Otherwise, add a new answer
        givenAnswers.value = [
            ...givenAnswers.value,
            {
                id: props.courseJson.content[pageNumber.value].id,
                givenAnswer: answer,
            },
        ];
    }
};

// Remove the background color from the previous answer
const removeBackgroundColor = () => {
    if (props.courseJson.content[pageNumber.value].type === "question") {
        props.courseJson.content[pageNumber.value].data.answers.forEach(
            (answer) => {
                const currentElement = document.querySelector(
                    `#answer-${answer}`
                );
                currentElement.classList.remove("bg-pink-600");
            }
        );
    }
};

// Get correct answer amount
const getCorrectAmount = () => {
    correctAmount.value = correctAnswers.value.filter(
        (answer) => answer.givenAnswer === answer.correctAnswer
    ).length;
};
</script>

<template>
    <AppLayout :title="course.subject.title">
        <div
            class="flex flex-row justify-between w-full mx-auto text-white bg-gray-800 border border-gray-700 rounded-t-lg shadow-md md:w-2/3 sm:p-4"
        >
            <h1>
                <span class="text-gray-500">Creator:</span>
                {{ course.user.name }}
            </h1>
            <h1 class="text-pink-500">
                {{ courseJson.title }}
            </h1>
        </div>

        <div
            class="flex flex-col w-full mx-auto text-white bg-gray-800 border border-gray-700 rounded-b-lg shadow-md md:w-2/3 sm:p-4"
        >
            <!--Learn-->
            <div
                v-if="
                    pageNumber !== -1 &&
                    courseJson.content[pageNumber].type === 'text'
                "
            >
                <h1>Learn</h1>
                <div class="my-3 border-t-2"></div>
                <div class="text-lg leading-relaxed text-gray-400">
                    {{ courseJson.content[pageNumber].data }}
                </div>
            </div>
            <!--Question-->
            <div
                v-else-if="
                    pageNumber !== -1 &&
                    courseJson.content[pageNumber].type === 'question'
                "
            >
                <h1>
                    Question:
                    <span class="font-bold text-pink-500">{{
                        courseJson.content[pageNumber].data.question
                    }}</span>
                </h1>
                <div class="my-3 border-t-2"></div>
                <div id="answer-container" class="flex flex-wrap gap-4">
                    <button
                        @click="handleAnswer(answer)"
                        v-for="(answer, index) in courseJson.content[pageNumber]
                            .data.answers"
                        :id="'answer-' + answer"
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
                <div class="flex flex-col w-1/2 text-xl gap-y-4">
                    <div
                        v-for="answer in correctAnswers"
                        class="flex flex-row flex-wrap justify-between mt-2 gap-x-4"
                    >
                        <p
                            :class="
                                answer.correct
                                    ? 'text-green-500'
                                    : 'text-red-500'
                            "
                        >
                            {{ answer.id }}. {{ answer.givenAnswer }}
                        </p>

                        <p
                            :class="
                                blurred
                                    ? 'blurred duration-200'
                                    : 'text-green-500 duration-200'
                            "
                            v-if="!answer.correct"
                        >
                            {{ answer.correctAnswer }}
                        </p>
                    </div>
                </div>
                <div class="mt-4">
                    <div>
                        Result:
                        <span class="text-lg font-bold text-green-500">{{
                            correctAmount
                        }}</span>
                        out of
                        <span class="text-lg font-bold text-pink-500">{{
                            givenAnswers.length
                        }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-lg font-bold text-pink-500"
                            >{{
                                Math.round(
                                    correctAmount / givenAnswers.length
                                ) * 100
                            }}%</span
                        >
                        <div>
                            <button
                                class="px-3 text-lg text-pink-500 duration-100 border-b-2 border-pink-600 text-md hover:bg-slate-700 active:bg-slate-600"
                                @click="blurred = !blurred"
                            >
                                Show / Hide
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Buttons-->
            <div class="flex justify-end mt-3 text-3xl font-bold me-2 gap-x-2">
                <button
                    :disabled="!answered"
                    :id="`next-btn-${pageNumber}`"
                    @click="handlePage('next')"
                    v-if="
                        pageNumber < courseJson.content.length - 1 &&
                        pageNumber !== -1
                    "
                    class="px-3 text-pink-500 duration-100 rounded hover:bg-slate-700 active:bg-slate-600"
                >
                    &gt;
                </button>
                <button
                    :disabled="!answered"
                    v-else-if="pageNumber !== -1"
                    @click="handlePage('results')"
                    class="px-3 text-pink-500 duration-100 border-b-2 border-pink-600 text-md hover:bg-slate-700 active:bg-slate-600"
                >
                    Results
                </button>
            </div>
        </div>
    </AppLayout>
</template>
