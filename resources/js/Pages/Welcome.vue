<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <main
        class="flex flex-col items-center justify-center min-h-screen bg-slate-900"
    >
        <div
            class="title text-[3rem] text-center leading-tight sm:text-[15rem] duration-100 font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-violet-400"
        >
            <h1>Bright</h1>

            <h1>Mind</h1>
        </div>
        <div class="text-3xl bg-pink-600">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="flex p-4 px-6 font-bold duration-150 text-slate-900 hover:text-pink-500 drop-shadow-2xl hover:bg-slate-900"
            >
                Dashboard
            </Link>

            <div v-else class="flex">
                <Link
                    :href="route('login')"
                    class="p-4 px-6 font-bold duration-150 text-slate-900 hover:text-pink-500 drop-shadow-2xl hover:bg-slate-900"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="p-4 px-6 font-bold duration-150 text-slate-900 hover:text-pink-500 drop-shadow-2xl hover:bg-slate-900"
                >
                    Register
                </Link>
            </div>
        </div>
    </main>
</template>
