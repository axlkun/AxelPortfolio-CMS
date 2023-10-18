<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import BreadCroumbs from '@/OwnComponents/BreadCroumbs.vue';

const breadcrumbs = [
    {
        label: "Dashboard"
    }
];
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <BreadCroumbs :items="breadcrumbs"></BreadCroumbs>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    Main content
                </div>
            </div>
        </div>
    </AppLayout>
</template>
