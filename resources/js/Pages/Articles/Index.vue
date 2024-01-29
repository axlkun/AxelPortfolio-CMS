<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import EditBtn from '@/OwnComponents/EditBtn.vue';
import DeleteBtn from '@/OwnComponents/DeleteBtn.vue';
import SimplePagination from '@/OwnComponents/SimplePagination.vue';
import AppTable from '@/OwnComponents/Table.vue';
import Container from '@/OwnComponents/Container.vue';
import Card from '@/OwnComponents/Card.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import BreadCroumbs from '@/OwnComponents/BreadCroumbs.vue';

const props = defineProps({
    articles: Object,
});

const headers = [
    { name: "Title" },
    { name: "Categories" },
    { name: "Created date" },
    { name: "Last update" },
    {
        name: "Actions",
        class: "text-right"
    }
];

const breadcrumbs = [
    {
        label: "Articles"
    }
];

const formatCategories = (categories) => {
    return categories.map(category => category.name).join(', ');
}

</script>

<template>
    <AppLayout title="Articles">
        <template #header>
            <BreadCroumbs :items="breadcrumbs"></BreadCroumbs>
        </template>

        <Container>
            <PrimaryButton :href="route('articles.create')">Add new</PrimaryButton>

            <Card class="mt-4">
                <AppTable :headers="headers" :items="articles">
                    <tr v-for="article in articles.data" :key="article.id">
                        <td>{{ article.title }}</td>
                        <td>{{formatCategories(article.categories)}}</td>
                        <td>{{ article.created_date }}</td>
                        <td>{{ article.updated_date }}</td>
                        <td>
                            <div class="flex items-center justify-end space-x-2">
                                <EditBtn :url="route('articles.edit', { article: article.id })"></EditBtn>

                                <DeleteBtn :url="route('articles.destroy', { article: article.id })"
                                    module-name="article"></DeleteBtn>
                            </div>
                        </td>
                    </tr>
                </AppTable>
            </Card>
        </Container>

    </AppLayout>
</template>
