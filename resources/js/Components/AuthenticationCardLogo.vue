<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <Link class="mx-auto w-fit" :href="'/'">
        <img
            class="mb-2 drop-shadow-2xl"
            width="200"
            height="200"
            src="/favicon.png"
            alt=""
        />
    </Link>
</template>
