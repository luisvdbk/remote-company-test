<template>
    <h1 class="text-2xl font-semibold mb-10">Snippets</h1>

    <section>
        <ul>
            <li v-for="(snippet, index) in snippets.data" :key="snippet.id" class="flex flex-col sm:flex-row justify-between mb-6 pb-2 border-b-2 border-slate-400">
                <div class="sm:max-w-[80%] mb-2 sm:mb-0">
                    <span v-text="snippet.title" class="mr-2"></span>
                </div>

                <div class="flex justify-end items-center">
                    <Link :href="$route('snippets.show', snippet.id)" class="text-yellow-600 mr-4">View</Link>
                </div>
            </li>

            <SimplePagination :paginated-object="snippets" />
        </ul>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import SimplePagination from "@/Components/SimplePagination";

const props = defineProps({
    snippets: Object,
});
</script>