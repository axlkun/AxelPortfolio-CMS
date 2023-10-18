<script setup>
import SimplePagination from '@/OwnComponents/SimplePagination.vue';

const props = defineProps({
    headers: {
        type: Array,
        required: true
    },
    items: {
        type: Object,
        required: true
    }
});
</script>

<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th v-for="(header,index) in headers" :key="`header-${index}`" :class="header.class || 'text-left'">{{header.name}}</th>
                </tr>
            </thead>
            <tbody>
                <slot></slot>
    
                <tr v-if="items.data.length === 0"><td colspan="headers.length" class="p-4">No data available</td></tr>
            </tbody>
        </table>

        <div v-if="items.data.length > 0" class="mt-10">

            <SimplePagination :prevUrl="items.links.prev" :nextUrl="items.links.next">
            </SimplePagination>
        </div>
    </div>
</template>