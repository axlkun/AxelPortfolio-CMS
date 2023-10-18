<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    prevUrl: String,
    nextUrl: String,
});
</script>

<template>

    <div class="flex items-center justify-between">
        <PrimaryButton :href="prevUrl" :disable="!prevUrl" :class="{'opacity-25': !prevUrl}">Previous</PrimaryButton>
        <PrimaryButton :href="nextUrl" :disable="!nextUrl" :class="{'opacity-25': !nextUrl}">Next</PrimaryButton>
    </div>

</template>