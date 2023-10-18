<script setup>
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppImage from '@/OwnComponents/Image.vue';
import AppTexArea from '@/OwnComponents/TextArea.vue';

const props = defineProps({
    settings: Object,
});

const form = useForm({
    description: props.settings.data.description,
    photo: null,
});

const updateHeroInformation = () => {
    
    form.post(route('settings.save-hero'), {
        preserveScroll: true,
    });
};

</script>

<template>
    <FormSection @submitted="updateHeroInformation">
        <template #title>
            Hero Information
        </template>

        <template #description>
            Update the hero section data
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                
                <AppImage :imageUrl="settings.data.photo_url" :imageAlt="settings.data.alt_text" label="Photo" :errorMessage="form.errors.photo" v-model="form.photo"></AppImage>

            </div> 

            <!-- Description -->
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="description" value="Description" />

                <AppTexArea
                    id="description"
                    v-model="form.description"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="description"
                ></AppTexArea>

                <InputError :message="form.errors.description" class="mt-2" />
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
