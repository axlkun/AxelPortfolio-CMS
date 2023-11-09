<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import EditBtn from '@/OwnComponents/EditBtn.vue';
import DeleteBtn from '@/OwnComponents/DeleteBtn.vue';
import AppTable from '@/OwnComponents/Table.vue';
import Container from '@/OwnComponents/Container.vue';
import Card from '@/OwnComponents/Card.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import BreadCroumbs from '@/OwnComponents/BreadCroumbs.vue';

const props = defineProps({
    categories: Object,
});

const headers = [
    { name: "Name" },
    { name: "Slug" },
    { name: "Created date" },
    {
        name: "Actions",
        class: "text-right"
    }
];

const breadcrumbs = [
    {
        label: "Categories"
    }
];

</script>

<template>
    <AppLayout title="Categories">
        <template #header>
            <BreadCroumbs :items="breadcrumbs"></BreadCroumbs>
        </template>

        <Container>
            <PrimaryButton :href="route('categories.create')">Add new</PrimaryButton>

            <Card class="mt-4">
                <AppTable :headers="headers" :items="categories">
                    <tr v-for="category in categories.data" :key="category.id">
                        <td>{{ category.name }}</td>
                        <td>{{ category.slug }}</td>
                        <td>{{ category.created_at_formated }}</td>
                        <td>
                            <div class="flex items-center justify-end space-x-2">
                                <EditBtn :url="route('categories.edit', { category: category.id })"></EditBtn>

                                <DeleteBtn :url="route('categories.destroy', { category: category.id })"
                                    module-name="category"></DeleteBtn>
                            </div>
                        </td>
                    </tr>
                </AppTable>
            </Card>
        </Container>

    </AppLayout>
</template>
