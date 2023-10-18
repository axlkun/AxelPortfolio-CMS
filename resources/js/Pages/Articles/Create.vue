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

const props = defineProps({
    edit: Boolean,
    article: Object,
    categories: {
        type: Object,
        default: function () {
            return {
                data: [],
            };
        },
    },
});

const form = useForm({
    "_method": props.edit ? 'PUT' : "",
    category_id: "",
    title: "",
    slug: "",
    description: "",
    image: null
});

let imageUrl = ref("");

const breadcrumbs = [
    {
        label: "Articles",
        url: route('articles.index')
    },
    {
        label: `${props.edit ? 'Edit' : 'Add'} Article`
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
        form.category_id = props.article.data.category_id;
        form.title = props.article.data.title;
        form.slug = props.article.data.slug;
        form.description = props.article.data.description
    }

    imageUrl.value = props.article.data.imageUrl;

});

const saveArticle = () => {

    props.edit
        ? form.post(route('articles.update', { id: props.article.data.id }))
        : form.post(route('articles.store'));
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <BreadCroumbs :items="breadcrumbs"></BreadCroumbs>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="saveArticle" enctype="multipart/form-data">
                    <div class="col-span-6 sm:col-span-4">

                        <AppImage :imageUrl="imageUrl" label="Image" v-model="form.image" :errorMessage="form.errors.image">
                        </AppImage>

                    </div>

                    <div class="mt-4">
                        <InputLabel for="category" value="Category" />
                        <select name="category" id="category" class="block w-full form-input" v-model="form.category_id">
                            <option value="" disabled selected>Select a category</option>
                            <option v-for="category in categories.data" :key="category.id" :value="category.id">{{
                                category.name }}</option>
                        </select>
                        <InputError :message="form.errors.category" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="title" value="Title" />
                        <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                            autocomplete="title" />
                        <InputError :message="form.errors.title" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="slug" value="Slug" />
                        <TextInput id="slug" v-model="form.slug" type="text" class="mt-1 block w-full" required
                            autocomplete="slug" />
                        <InputError :message="form.errors.slug" class="mt-2" />
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
