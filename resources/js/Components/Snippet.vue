<template>
    <CodeEditor 
        v-model="code"
        :value="code"
        :languages="[['HTML', 'HTML']]"
        :language_selector="false"
        :read_only="!editEnabled"
        :copy_code="copyEnabled"
        :width="width"
        :max_width="maxWidth"
    />
</template>

<script setup>
import { computed, ref } from '@vue/reactivity';
import CodeEditor from 'simple-code-editor';
import { watch } from 'vue';

const defaultHtml = '<!DOCTYPE HTML><html></html>';

const props = defineProps({
    modelValue: {
        type: String,
        deftault: '',
    },

    editEnabled: {
        type: Boolean,
        default: true,
    },

    copyEnabled: {
        type: Boolean,
        default: false,
    },

    width: {
        type: String,
        default: '100%',
    },

    maxWidth: {
        type: String,
        default: '1000px',
    }
});

const emit = defineEmits(['update:modelValue']);
const code = ref(props.modelValue || defaultHtml);
emit('update:modelValue', code);

watch(code, (code) => emit('update:modelValue', code));
</script>
