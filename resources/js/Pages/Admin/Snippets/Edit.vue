<template>
    <h1 class="text-2xl font-semibold mb-10">Edit Snippet</h1>

    <form @submit.prevent="form.post($route('admin.snippets.update', snippet.id))" class="max-w-screen-sm">
        <div class="flex flex-col mb-6">
            <label for="title">Title</label>
            <input type="text" id="title" v-model="form.title">
            <span v-if="form.errors.title" class="text-red-600">{{ form.errors.title }}</span>
        </div>

         <div class="flex flex-col mb-6">
            <label for="description">Description</label>
            <textarea id="description" v-model="form.description"></textarea>
            <span v-if="form.errors.description" class="text-red-600">{{ form.errors.description }}</span>
        </div>

        <div class="flex flex-col mb-6">
            <label for="contents">Contents</label>

           <Snippet v-model="form.contents" id="contents" />

            <span v-if="form.errors.contents" class="text-red-600">{{ form.errors.contents }}</span>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white rounded p-2">Update</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Snippet from "@/Components/Snippet.vue";

const props = defineProps({
    snippet: Object,
});

const form = useForm({
    _method: 'put',
    title: props.snippet.title,
    description: props.snippet.description,
    contents: props.snippet.contents,
});
</script>