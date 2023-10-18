<script setup>
import { ref, watch } from 'vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const props = defineProps({
    modelValue: String
})
// const emit = defineEmits(['update:value']);
const emit = defineEmits(['update:modelValue']);

const editor = ref(ClassicEditor);
const editorConfig = ref({
    // The configuration of the editor.
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