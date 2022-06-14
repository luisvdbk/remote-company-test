<template>
    <h1 class="text-2xl font-semibold mb-10">Downloadables</h1>

    <section>
        <div class="mb-6">
            <Link :href="$route('admin.downloadables.create')">Add new</Link>
        </div>

        <ul class="max-w-screen-lg">
            <li v-for="(downloadable, index) in downloadables.data" :key="downloadable.id" class="flex flex-col sm:flex-row justify-between mb-6 pb-2 border-b-2 border-slate-400">
                <div class="sm:max-w-[80%] flex flex-col lg:flex-row mb-2 sm:mb-0">
                    <span v-text="downloadable.title" class="mr-2"></span>
                    <a :href="downloadable.url" v-text="downloadable.url" target="_blank" class="text-blue-600 truncate"></a>
                </div>

                <div class="flex justify-end items-center">
                    <Link :href="$route('admin.downloadables.edit', downloadable.id)" class="text-yellow-600 mr-4">Edit</Link>
                    <button @click="deleteDownloadable(downloadable)" href="" class="text-red-600">Delete</button>
                </div>
            </li>

            <SimplePagination :paginated-object="downloadables" />
        </ul>
    </section>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import SimplePagination from "@/Components/SimplePagination";

const props = defineProps({
    downloadables: Object,
});

const deleteDownloadable = (downloadable) => {
    if (! confirm('Are you sure?')) {
        return;
    }
    
    Inertia.delete(route('admin.downloadables.destroy', downloadable.id));
}
</script>