<script setup>
import { useForm } from '@inertiajs/vue3';
import { watch, defineProps, onMounted, ref } from 'vue';
import { strSlug } from "@/helpers.js";

import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Container from '@/OwnComponents/Container.vue';
import Card from '@/OwnComponents/Card.vue';
import BreadCroumbs from '@/OwnComponents/BreadCroumbs.vue';
import AppImage from '@/OwnComponents/Image.vue';
import AppCkeditor from '@/OwnComponents/Ckeditor.vue';
import AppTexArea from '@/OwnComponents/TextArea.vue';

const props = defineProps({
    edit: Boolean,
    project: Object,
});

const form = useForm({
    "_method": props.edit ? 'PUT' : "",
    image: null,
    title: "",
    slug: "",
    technologies: "",
    company: "",
    repo_link: "",
    website_link: "",
    summary: "",
    description: ""
});

let imageUrl = ref("");

const breadcrumbs = [
    {
        label: "Projects",
        url: route('projects.index')
    },
    {
        label: `${props.edit ? 'Edit' : 'Add'} Project`
    }
];

watch(
    () => form.title,
    (title) => {
        form.slug = strSlug(title);
    }
)

onMounted(() => {
    if (props.edit) {
        form.title = props.project.data.title;
        form.slug = props.project.data.slug;
        form.technologies = props.project.data.technologies;
        form.company = props.project.data.company;
        form.repo_link = props.project.data.repo_link;
        form.website_link = props.project.data.website_link;
        form.summary = props.project.data.summary;
        form.description = props.project.data.description;
    }

    imageUrl.value = props.project.data.imageUrl;

});

const saveProject = () => {

    props.edit
        ? form.post(route('projects.update', { id: props.project.data.id }))
        : form.post(route('projects.store'));
};
</script>

<template>
    <AppLayout title="Project">
        <template #header>
            <BreadCroumbs :items="breadcrumbs"></BreadCroumbs>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="saveProject" enctype="multipart/form-data">
                    <div class="col-span-6 sm:col-span-4">

                        <AppImage :imageUrl="imageUrl" label="Image" v-model="form.image" :errorMessage="form.errors.image">
                        </AppImage>

                    </div>

                    <div class="mt-4">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                            autocomplete="title" />
                        <InputError :message="form.errors.title" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="slug" value="Slug" />
                        <TextInput disabled="disabled" id="slug" v-model="form.slug" type="text" class="mt-1 block w-full" required
                            autocomplete="slug" />
                        <InputError :message="form.errors.slug" class="mt-2" />
                    </div>

                    <div class="mt-4 card p-fluid">
                        <InputLabel for="technologies" value="Technologies" />
                        <Chips v-model="form.technologies" separator=","  />
                        <InputError :message="form.errors.technologies" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="company" value="For Company" />
                        <TextInput id="company" v-model="form.company" type="text" class="mt-1 block w-full" required
                            autocomplete="company" />
                        <InputError :message="form.errors.company" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="repo_link" value="Source code" />
                        <TextInput id="repo_link" v-model="form.repo_link" type="text" class="mt-1 block w-full"
                            autocomplete="repo_link" />
                        <InputError :message="form.errors.repo_link" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="website_link" value="Live website" />
                        <TextInput id="website_link" v-model="form.website_link" type="text" class="mt-1 block w-full"
                            autocomplete="website_link" />
                        <InputError :message="form.errors.website_link" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="summary" value="Summary" />

                        <AppTexArea id="summary" v-model="form.summary" type="text" class="mt-1 block w-full"
                            required autocomplete="summary"></AppTexArea>

                            <InputError :message="form.errors.summary" class="mt-2" />

                    </div>

                    <div class="mt-4 col-span-6 sm:col-span-6">
                        <InputLabel for="description" value="Description" />

                        <AppCkeditor v-model="form.description"></AppCkeditor>

                        <InputError :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </ActionMessage>

                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            <span v-if="edit">Update</span>
                            <span v-else>Save</span>
                        </PrimaryButton>
                    </div>
                </form>
            </Card>
        </Container>

    </AppLayout>
</template>
