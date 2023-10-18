<script setup>
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppImage from '@/OwnComponents/Image.vue';
import AppTexArea from '@/OwnComponents/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    settings: Object,
});

const form = useForm({
    google_map_url: props.settings.data.google_map_url,
    contact_photo: props.settings.data.contact_photo_url,
    email: props.settings.data.email,
    phone: props.settings.data.phone,
    address: props.settings.data.address
});

const updateContactInformation = () => {
    
    form.post(route('settings.save-contact'), {
        preserveScroll: true,
    });
};

</script>

<template>
    <FormSection @submitted="updateContactInformation">
        <template #title>
            Contact us Information
        </template>

        <template #description>
            Update the contact us section data
        </template>

        <template #form>
            <!-- Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                
                <AppImage :imageUrl="settings.data.contact_photo_url" :imageAlt="settings.data.alt_text" label="Photo" :errorMessage="form.errors.contact_photo" v-model="form.contact_photo"></AppImage>

            </div> 

            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="email"
                />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="phone" value="Phone" />
                <TextInput
                    id="phone"
                    v-model="form.phone"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="phone"
                />
                <InputError :message="form.errors.phone" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="address" value="Address" />
                <TextInput
                    id="address"
                    v-model="form.address"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="address"
                />
                <InputError :message="form.errors.address" class="mt-2" />
            </div>

            <!-- Google map url -->
            <div class="col-span-6 sm:col-span-6">
                <InputLabel for="google_map_url" value="Google map url" />

                <AppTexArea
                    id="google_map_url"
                    v-model="form.google_map_url"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="google_map_url"
                ></AppTexArea>

                <InputError :message="form.errors.google_map_url" class="mt-2" />
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
