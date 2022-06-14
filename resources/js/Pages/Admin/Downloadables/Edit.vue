<template>
    <h1 class="text-2xl font-semibold mb-10">Edit Downloadable</h1>

    <form @submit.prevent="form.post($route('admin.downloadables.update', downloadable.id))" class="max-w-screen-sm">
        <div class="flex flex-col mb-6">
            <label for="title">Title</label>
            <input type="text" name="title" v-model="form.title">
            <span v-if="form.errors.title" class="text-red-600">{{ form.errors.title }}</span>
        </div>

        <div class="flex flex-col mb-6">
            <label for="file">File</label>
            <input type="file" name="file" accept="application/pdf" @input="form.file = $event.target.files[0]">
            <span v-if="! form.file" class="mt-1"><a :href="downloadable.url" class="text-blue-600" target="_blank">Current file</a></span>
            <span v-if="form.errors.file" class="text-red-600">{{ form.errors.file }}</span>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 rounded p-2">Update</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    downloadable: Object,
});

const form = useForm({
    _method: 'put',
    title: props.downloadable.title,
    file: null,
});
</script>