<template>
<div class="flex justify-end">
    <Link 
        :href="links.prev" 
        class="mr-2"
        :class="{'pointer-events-none opacity-50': !links.prev}"
    >
        Prev
    </Link>

    <Link 
        :href="links.next" 
        :class="{'pointer-events-none opacity-50': !links.next}"
    >
        Next
    </Link>
</div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    paginatedObject: Object
});

const { meta, links } = props.paginatedObject;
</script>