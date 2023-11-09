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
    projects: Object,
});

const headers = [
    { name: "Title" },
    { name: "Client" },
    { name: "Created date" },
    {
        name: "Actions",
        class: "text-right"
    }
];

const breadcrumbs = [
    {
        label: "Projects"
    }
];

</script>

<template>
    <AppLayout title="Projects">
        <template #header>
            <BreadCroumbs :items="breadcrumbs"></BreadCroumbs>
        </template>

        <Container>
            <PrimaryButton :href="route('projects.create')">Add new</PrimaryButton>

            <Card class="mt-4">
                <AppTable :headers="headers" :items="projects">
                    <tr v-for="project in projects.data" :key="project.id">
                        <td>{{ project.title }}</td>
                        <td>{{ project.company }}</td>
                        <td>{{ project.created_at_formated }}</td>
                        <td>
                            <div class="flex items-center justify-end space-x-2">
                                <EditBtn :url="route('projects.edit', { project: project.id })"></EditBtn>

                                <DeleteBtn :url="route('projects.destroy', { project: project.id })"
                                    module-name="project"></DeleteBtn>
                            </div>
                        </td>
                    </tr>
                </AppTable>
            </Card>
        </Container>

    </AppLayout>
</template>
