<script setup>
defineProps({
    on: Boolean,
});
</script>

<template>
    <div>
        <transition
            leave-active-class="transition duration-1000 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-show="on"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md"
            >
                <slot />
            </div>
        </transition>
    </div>
</template>
