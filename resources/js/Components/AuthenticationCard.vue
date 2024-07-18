<template>
    <div
        class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0 bg-slate-900"
    >
        <h1
            class="font-bold text-transparent text-md sm:text-3xl bg-clip-text bg-gradient-to-r from-pink-500 to-violet-400"
        >
            BrightMind
        </h1>
        <div
            class="flex flex-col w-full px-6 py-4 mt-6 overflow-hidden bg-gradient-to-t from-pink-500 to-violet-400 sm:max-w-md drop-shadow-2xl"
        >
            <slot name="logo" />
            <slot />
        </div>
    </div>
</template>
