<script setup>
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppImage from '@/OwnComponents/Image.vue';
import AppCkeditor from '@/OwnComponents/Ckeditor.vue';

const props = defineProps({
    settings: Object,
});


const form = useForm({
    about_description: props.settings.data.about_description || '',
    about_photo: null,
});

const updateHeroInformation = () => {
    
    form.post(route('settings.save-about'), {
        preserveScroll: true,
    });
};

</script>

<template>
    <FormSection @submitted="updateHeroInformation">
        <template #title>
            About us Information
        </template>

        <template #description>
            Update the about us data
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                
                <AppImage :imageUrl="settings.data.about_photo_url" :imageAlt="settings.data.alt_text" label="Photo" :errorMessage="form.errors.about_photo" v-model="form.about_photo"></AppImage>

            </div> 

            <!-- Description -->
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="description" value="Description" />

                <AppCkeditor v-model="form.about_description"></AppCkeditor>
                
                <InputError :message="form.errors.about_description" class="mt-2" />
            </div>

        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
