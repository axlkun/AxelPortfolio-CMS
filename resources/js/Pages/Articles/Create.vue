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
    categories: [],
    title: "",
    alt_image: null,
    slug: "",
    summary: "",
    meta_description: null,
    keywords: null,
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
        form.categories = props.article.data.categories.map(category => category.id);
        form.title = props.article.data.title;
        form.alt_image = props.article.data.alt_image;
        form.slug = props.article.data.slug;
        form.summary = props.article.data.summary;
        form.meta_description = props.article.data.meta_description;
        form.keywords = props.article.data.keywords;
        form.description = props.article.data.description;
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
    <AppLayout title="Article">
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
                        <InputLabel for="alt_image" value="Alternative Text Image" />
                        <TextInput id="alt_image" v-model="form.alt_image" type="text" class="mt-1 block w-full"
                            autocomplete="alt_image" />
                        <InputError :message="form.errors.alt_image" class="mt-2" />
                    </div>

                    <div class="mt-4" style="border: 1px solid grey;">
                        <InputLabel for="category" value="Category" />
                        <MultiSelect v-model="form.categories" display="chip" :options="categories.data" optionLabel="name"
                            optionValue="id" placeholder="Select categories" :maxSelectedLabels="5"
                            class="w-full md:w-20rem" />
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
                        <TextInput disabled="disabled" id="slug" v-model="form.slug" type="text" class="mt-1 block w-full"
                            required autocomplete="slug" />
                        <InputError :message="form.errors.slug" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="meta_description" value="Meta description" />

                        <AppTexArea id="meta_description" v-model="form.meta_description" type="text" class="mt-1 block w-full" 
                            autocomplete="meta_description"></AppTexArea>

                        <InputError :message="form.errors.meta_description" class="mt-2" />

                    </div>

                    <div class="mt-4">
                        <InputLabel for="keywords" value="Keywords" />

                        <AppTexArea id="Keywords" v-model="form.keywords" type="text" class="mt-1 block w-full"
                            autocomplete="keywords"></AppTexArea>

                        <InputError :message="form.errors.keywords" class="mt-2" />

                    </div>

                    <div class="mt-4">
                        <InputLabel for="summary" value="Summary" />

                        <AppTexArea id="summary" v-model="form.summary" type="text" class="mt-1 block w-full" required
                            autocomplete="summary"></AppTexArea>

                        <InputError :message="form.errors.summary" class="mt-2" />

                    </div>

                    <div class="mt-4">
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
