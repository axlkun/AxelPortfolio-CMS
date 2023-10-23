<script setup>
import { usePage } from '@inertiajs/vue3';
import { onMounted,watch } from 'vue';

const page = usePage();

const hideFlashMessage = () => {
    page.props.flash.success = "";
    page.props.flash.failure = "";
};

//llama a la función para ocultar automáticamente el mensaje después de 5 segundos
const autoHideFlashMessage = () => {
    if (page.props.flash.success || page.props.flash.failure) {
        setTimeout(() => {
            hideFlashMessage();
        }, 5000); 
    }
};

//Llama a la función de ocultar automáticamente cuando el componente se monta
onMounted(() => {
    autoHideFlashMessage();
});

// Observa cambios en las props flash.success y flash.failure
watch([() => page.props.flash.success, () => page.props.flash.failure], ([success, failure]) => {
    if (success || failure) {
        autoHideFlashMessage();
    }
});

</script>

<template>
    <div v-if="page.props.flash.success || page.props.flash.failure"
        class="fixed bottom-4 right-4 flex items-center text-white rounded px-8 py-4"
        :class="{ 'bg-green-500': page.props.flash.success, 'bg-red-500': page.props.flash.failure }">
        <div v-if="page.props.flash.success">
            {{ page.props.flash.success }}
        </div>
        <div v-if="page.props.flash.failure">
            {{ page.props.flash.failure }}
        </div>

        <button class="ml-4" @click="hideFlashMessage()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
</div></template>