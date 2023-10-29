<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

</script>

<template>
    <textarea 
    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
     name="" 
     id="" 
     cols="30" 
     rows="3" 
     style="resize: none;"
     :value="modelValue"
     @input="$emit('update:modelValue', $event.target.value)">
    </textarea>
</template>
