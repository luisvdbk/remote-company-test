<template>
    <h1 class="text-2xl font-semibold mb-10">Downloadables</h1>

    <section>
        <ul class="max-w-screen-lg">
            <li v-for="(downloadable, index) in downloadables.data" :key="downloadable.id" class="flex flex-col sm:flex-row justify-between mb-6 pb-2 border-b-2 border-slate-400">
                <a :href="downloadable.url" v-text="downloadable.title" class="text-blue-600 truncate" download></a>
            </li>

            <SimplePagination :paginated-object="downloadables" />
        </ul>
    </section>
</template>

<script setup>
import SimplePagination from "@/Components/SimplePagination";

const props = defineProps({
    downloadables: Object,
});
</script>