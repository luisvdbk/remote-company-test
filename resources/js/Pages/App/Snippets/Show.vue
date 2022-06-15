<template>
    <h1 class="text-2xl font-semibold mb-10" v-text="snippet.title"></h1>

    <p v-text="snippet.description" class="mb-10"></p>

    <Snippet 
        v-model="snippet.contents"
        :edit-enabled="false"
        :copy-enabled="true"
    />
</template>

<script setup>
import Snippet from "@/Components/Snippet.vue";

const props = defineProps({
    snippet: Object,
});
</script>