<script setup>
import { ref, watch } from 'vue';
// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import ClassicEditor from 'ckeditor5-custom-build';
import UploadAdapter from './uploadadapter.js'

const props = defineProps({
    modelValue: String
})

function uploader(editor) {
  editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
    return new UploadAdapter(loader);
  };
};

// const emit = defineEmits(['update:value']);
const emit = defineEmits(['update:modelValue']);

const editor = ref(ClassicEditor);
const editorConfig = ref({
    // The configuration of the editor.
    extraPlugins: [uploader],
});
const text = ref(props.modelValue);

// Observa cambios en la prop "modelValue" (v-model) del componente padre
watch(() => props.modelValue, (newValue) => {
    
  text.value = newValue;
});

// Observa cambios en la variable local "text"
watch(text, (newText) => {
  // Emitir el evento "update:modelValue" para sincronizar con v-model en el componente padre
  emit('update:modelValue', newText);

});
</script>

<template>

    <ckeditor :editor="editor" v-model="text" :config="editorConfig"></ckeditor>
</template>