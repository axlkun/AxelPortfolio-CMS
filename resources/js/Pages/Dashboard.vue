<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import BreadCroumbs from '@/OwnComponents/BreadCroumbs.vue';

const props = defineProps({
    projectsCount: Number,
    categoriesCount: Number,
    articlesCount: Number,
    latestProject: String,
    latestCategory: String,
    latestArticle: String,
});

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

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">

                        <div
                            class="p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                              </svg>
                              

                            <h5 class="mb-2 mt-2 text-2xl font-semibold tracking-tight text-gray-900">
                                Projects</h5>

                            <p class="mb-3 font-normal text-gray-500">{{ projectsCount }} active projects</p>

                            <p class="inline-flex items-center text-black-600">
                                Last update: {{ latestProject }}
                            </p>
                        </div>
                        <div
                            class="p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                class="w-7 h-7 stroke-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>

                            <h5 class="mb-2 mt-2 text-2xl font-semibold tracking-tight text-gray-900">
                                Articles</h5>

                            <p class="mb-3 font-normal text-gray-500">{{ articlesCount }} active articles</p>

                            <p class="inline-flex items-center text-black-600">
                                Last update: {{ latestArticle }}
                            </p>
                        </div>
                        <div
                            class="p-6 bg-white border border-gray-200 rounded-lg shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                              </svg>
                              

                            <h5 class="mb-3 mt-3 text-2xl font-semibold tracking-tight text-gray-900">
                                Categories</h5>

                            <p class="mb-3 font-normal text-gray-500">{{ categoriesCount }} active categories</p>

                            <p class="inline-flex items-center text-black-600">
                                Last update: {{ latestCategory }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
