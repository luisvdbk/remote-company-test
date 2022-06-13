<template>
    <h1 class="text-2xl font-semibold mb-10">Downloadables</h1>

    <section>
        <div class="mb-4">
            <a :href="$route('admin.downloadables.create')" class="text-blue-600">Add new</a>
        </div>

        <ul class="max-w-screen-lg">
            <li v-for="(downloadable, index) in data" :key="downloadable.id" class="flex justify-between mb-2">
                <div class="flex flex-col md:flex-row">
                    <span v-text="downloadable.title" class="mr-2"></span>
                    <a :href="downloadable.url" v-text="downloadable.url" class="text-blue-600"></a>
                </div>

                <a :href="$route('admin.downloadables.edit', downloadable.id)" class="text-yellow-600">Edit</a>
            </li>
        </ul>
    </section>
</template>

<script setup>
const props = defineProps({
    downloadables: Object 
});

const { data, meta } = props.downloadables;
</script>