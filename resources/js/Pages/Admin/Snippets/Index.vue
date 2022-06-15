<template>
    <h1 class="text-2xl font-semibold mb-10">Snippets</h1>

    <section>
        <div class="mb-6">
            <Link :href="$route('admin.snippets.create')" class="text-blue-600">Add new</Link>
        </div>

        <ul>
            <li v-for="(snippet, index) in snippets.data" :key="snippet.id" class="flex flex-col sm:flex-row justify-between mb-6 pb-2 border-b-2 border-slate-400">
                <div class="sm:max-w-[80%] mb-2 sm:mb-0">
                    <span v-text="snippet.title" class="mr-2"></span>
                </div>

                <div class="flex justify-end items-center">
                    <Link :href="$route('admin.snippets.edit', snippet.id)" class="text-yellow-600 mr-4">Edit</Link>
                    <button @click="deleteSnippet(snippet)" href="" class="text-red-600">Delete</button>
                </div>
            </li>

            <SimplePagination :paginated-object="snippets" />
        </ul>
    </section>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import SimplePagination from "@/Components/SimplePagination";

const props = defineProps({
    snippets: Object,
});

const deleteSnippet = (snippet) => {
    if (! confirm('Are you sure?')) {
        return;
    }
    
    Inertia.delete(route('admin.snippets.destroy', snippet.id));
}
</script>