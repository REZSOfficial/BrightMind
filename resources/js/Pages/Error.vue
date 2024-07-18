<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    message: {
        type: String,
        default: "Register as a teacher to create a course.",
    },
});
</script>

<template>
    <AppLayout title="Error">
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div
                        class="p-6 text-red-500 bg-white border-b border-gray-200"
                    >
                        {{ message }}
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
