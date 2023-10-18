<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    href: {}
});


const visitPage  = (event) => {
    if (!props.href) {
        return;
    }
    event.preventDefault();

    router.visit(props.href);
};
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" @click="visitPage">
        <slot />
    </button>
</template>
