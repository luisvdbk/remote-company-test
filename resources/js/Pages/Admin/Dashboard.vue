<template>
    <h1 class="text-2xl font-semibold">Admin</h1>

    <section class="my-10 bg-white p-5 rounded">
        <Link :href="$route('admin.downloadables.index')">
            <h2 class="text-lg font-semibold">Downloadables</h2>
        </Link>
    </section>

    <section class="my-10 bg-white p-5 rounded">
        <Link :href="$route('admin.snippets.index')">
            <h2 class="text-lg font-semibold">Snippets</h2>
        </Link>
    </section>

    <section class="my-10 bg-white p-5 rounded">
        <h2 class="text-lg font-semibold">Links</h2>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>