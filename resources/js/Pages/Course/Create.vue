<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { watch } from "vue";
const props = defineProps({
    subjects: Array,
});

const inputs = ref([]);

const showAdd = ref(false);

const form = useForm({
    subject_id: "1",
    title: "",
    inputs: inputs.value,
});

watch(
    inputs,
    (newInputs) => {
        form.inputs = newInputs;
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
            value: "",
        });
    } else if (type === "question") {
        inputs.value.push({
            type: "question",
            value: "",
            answers: [
                { value: "" },
                { value: "" },
                { value: "" },
                { value: "" },
            ],
        });
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
                            v-model="input.value"
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
                            v-model="input.value"
                        />
                        <div class="flex flex-row w-full mt-2 gap-x-2">
                            <input
                                v-for="(answer, ansIndex) in input.answers"
                                :key="ansIndex"
                                class="w-1/4 border-2 border-pink-500 rounded drop-shadow-xl bg-slate-700 focus:border-slate-600 focus:ring-0"
                                type="text"
                                v-model="answer.value"
                                :placeholder="'Answer ' + (ansIndex + 1)"
                                maxlength="64"
                            />
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
