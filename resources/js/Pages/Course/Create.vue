<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import InputErrorVue from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { watch } from "vue";

let questionIdCounter = 0;

const props = defineProps({
    subjects: Array,
    errors: Object,
});

const inputs = ref([]);

const correctAnswers = ref([]);

const showAdd = ref(false);

const form = useForm({
    subject_id: "1",
    title: "",
    grade: 0,
    content: inputs.value,
    correctAnswers: correctAnswers.value,
});

watch(
    [inputs, correctAnswers],
    ([newInputs, newCorrectAnswers]) => {
        form.content = newInputs;
        form.correctAnswers = newCorrectAnswers;
    },
    { deep: true }
);

const handleSubmit = () => {
    form.post(route("course.store"), {
        onSuccess: () => {
            form.reset();
        },
    });
};

const addInput = (type) => {
    if (type === "text") {
        inputs.value.push({
            type: "text",
            data: "",
        });
    } else if (type === "question") {
        const newQuestionId = questionIdCounter++;
        inputs.value.push({
            type: "question",
            id: newQuestionId,
            data: {
                question: "",
                answers: ["", "", "", ""],
            },
        });
        correctAnswers.value.push({
            questionId: newQuestionId,
            answer: "",
        });
    }
};

const setCorrectAnswer = (questionId, answer) => {
    const correctAnswer = correctAnswers.value.find(
        (ans) => ans.questionId === questionId
    );
    if (correctAnswer) {
        correctAnswer.answer = answer;
    } else {
        correctAnswers.value.push({ questionId, answer });
    }
};
</script>

<template>
    <AppLayout title="Create Course">
        <div
            class="flex flex-row justify-between w-full mx-auto bg-gray-800 border border-gray-700 rounded-t-lg shadow-md md:w-2/3 sm:p-4"
        >
            <h1 class="my-auto text-2xl text-pink-500">Create a Course</h1>
        </div>
        <div
            class="flex flex-col w-full mx-auto text-white bg-gray-800 border border-gray-700 rounded-b-lg shadow-md md:w-2/3 sm:p-4"
        >
            <form
                class="flex flex-col w-full gap-y-4"
                @submit.prevent="handleSubmit"
                id="course-form"
            >
                <div>
                    <h1 class="text-pink-500">Subject</h1>
                    <select
                        v-model="form.subject_id"
                        class="w-full border-2 border-pink-500 rounded drop-shadow-xl bg-slate-700 focus:border-slate-600 focus:ring-0"
                    >
                        <option
                            v-for="subject in subjects"
                            :key="subject.id"
                            :value="subject.id"
                        >
                            {{ subject.title }}
                        </option>
                    </select>
                    <InputErrorVue
                        :message="
                            errors.subject_id
                                ? 'The subject field is required.'
                                : ''
                        "
                    />
                </div>
                <div>
                    <h1 class="text-pink-500">Course Title</h1>
                    <input
                        v-model="form.title"
                        type="text"
                        class="w-full border-2 border-pink-500 rounded drop-shadow-xl bg-slate-700 focus:border-slate-600 focus:ring-0"
                        placeholder="Course Title"
                        maxlength="64"
                    />
                    <InputErrorVue :message="errors.title" />
                </div>
                <div>
                    <h1 class="text-pink-500">Grade</h1>
                    <div class="flex flex-wrap">
                        <div class="w-1/7 sm:w-1/12" v-for="i in 12">
                            <p class="font-bold text-pink-500">{{ i }}.</p>
                            <input
                                class="p-4 duration-100 border-2 border-pink-500 rounded hover:cursor-pointer drop-shadow-xl bg-slate-700 focus:border-slate-600 focus:ring-0 checked:bg-pink-500 focus:bg-pink-500 active:bg-pink-500 hover:bg-pink-500 active:ring-0"
                                v-model="form.grade"
                                type="radio"
                                name="grade"
                                :value="i"
                            />
                        </div>
                    </div>
                    <InputErrorVue
                        :message="
                            errors.grade ? 'The grade field is required.' : ''
                        "
                    />
                </div>
                <div v-for="(input, index) in inputs" :key="index">
                    <div
                        v-if="input.type === 'text'"
                        class="flex flex-col justify-between p-2 border-2 border-gray-700 rounded gap-x-2 drop-shadow-xl bg-slate-700"
                    >
                        <label class="text-xl font-bold text-pink-500"
                            >{{ index + 1 }}. Text</label
                        >
                        <textarea
                            class="w-full border-2 border-pink-500 rounded drop-shadow-xl bg-slate-700 focus:border-slate-600 focus:ring-0"
                            type="text"
                            v-model="input.data"
                        />
                    </div>
                    <div
                        v-else
                        class="flex flex-col justify-between p-2 border-2 border-gray-700 rounded gap-x-2 drop-shadow-xl bg-slate-700"
                    >
                        <label class="text-xl font-bold text-pink-500"
                            >{{ index + 1 }}. Question</label
                        >
                        <input
                            maxlength="128"
                            class="w-full border-2 border-pink-500 rounded drop-shadow-xl bg-slate-700 focus:border-slate-600 focus:ring-0"
                            type="text"
                            v-model="input.data.question"
                        />
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div
                                class="flex flex-row"
                                v-for="(answer, ansIndex) in input.data.answers"
                                :key="ansIndex"
                            >
                                <input
                                    class="w-full border-2 border-pink-500 rounded drop-shadow-xl bg-slate-700 focus:border-slate-600 focus:ring-0"
                                    type="text"
                                    v-model="input.data.answers[ansIndex]"
                                    :placeholder="'Answer ' + (ansIndex + 1)"
                                    maxlength="64"
                                />
                                <input
                                    class="duration-100 border-2 border-pink-500 rounded custom-radio hover:cursor-pointer drop-shadow-xl bg-slate-700 focus:border-slate-600 focus:ring-0 checked:bg-pink-500 focus:bg-pink-500 active:bg-pink-500 hover:bg-pink-500 active:ring-0 size-11 ms-2"
                                    type="radio"
                                    :name="'question-' + input.id"
                                    :value="answer"
                                    @change="setCorrectAnswer(input.id, answer)"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <button
                    type="submit"
                    class="w-full p-2 text-xl font-bold duration-100 bg-pink-500 rounded hover:bg-pink-600"
                >
                    Create Course
                </button>
            </form>
        </div>
        <div
            class="flex flex-row justify-end w-full mx-auto mt-4 text-white pe-2 gap-x-2 md:w-2/3"
        >
            <div
                class="flex flex-row w-fit gap-x-2"
                @mouseover="showAdd = true"
                @mouseleave="showAdd = false"
            >
                <button
                    @click="addInput('text')"
                    v-if="showAdd"
                    class="p-1 px-4 my-auto text-2xl font-bold duration-150 bg-pink-500 border-gray-900 rounded drop-shadow-lg hover:bg-pink-600"
                >
                    Text
                </button>
                <button
                    @click="addInput('question')"
                    v-if="showAdd"
                    class="p-1 px-4 my-auto text-2xl font-bold duration-150 bg-pink-500 border-gray-900 rounded drop-shadow-lg hover:bg-pink-600"
                >
                    Question
                </button>
                <button
                    class="px-4 py-2 text-2xl font-bold duration-150 bg-pink-500 rounded-full w-fit drop-shadow-lg hover:bg-pink-600"
                >
                    &plus;
                </button>
            </div>
        </div>
    </AppLayout>
</template>
