<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import UpdateHeroData from './UpdateHeroData.vue';
import UpdateAboutData from './UpdateAboutData.vue';
import UpdateContactData from './UpdateContactData.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import BreadCroumbs from '@/OwnComponents/BreadCroumbs.vue';

defineProps({
    settings: Object,
});

const breadcrumbs = [
    {
        label: "Settings"
    }
];
</script>

<template>
    <AppLayout title="Settings">
        <template #header>
            <BreadCroumbs :items="breadcrumbs"></BreadCroumbs>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <UpdateHeroData :settings="settings"></UpdateHeroData>

                <SectionBorder />

                <UpdateAboutData :settings="settings"></UpdateAboutData>

                <SectionBorder />

                <UpdateContactData :settings="settings"></UpdateContactData>

            </div>
        </div>
    </AppLayout>
</template>
