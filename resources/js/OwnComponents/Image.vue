<script setup>
import { ref } from 'vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    imageUrl: {},
    imageAlt: {},
    label: {},
    errorMessage: {},
});

const emit = defineEmits(['update:modelValue']);

const photoPreview = ref(null);
const photoInput = ref(null);

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);

    emit('update:modelValue', photo);

};

const selectNewPhoto = () => {
    photoInput.value.click();
};

</script>

<template>
    <div>
        <input ref="photoInput" type="file" class="hidden" @change="updatePhotoPreview" accept="image/*">

        <InputLabel for="photo" :value="label" />

        <!-- Current Profile Photo -->
        <div v-show="!photoPreview" class="mt-2">
            <img :src="imageUrl" :alt="imageAlt" class="object-cover">
        </div>

        <!-- New Profile Photo Preview -->
        <div v-show="photoPreview" class="mt-2">
            <!-- <span class="block w-120 h-80 bg-cover bg-no-repeat bg-center"
                :style="'background-image: url(\'' + photoPreview + '\');'" /> -->
                <img :src="photoPreview" :alt="imageAlt" class="object-cover">
        </div>

        <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
            Select A New Photo
        </SecondaryButton>

        <InputError :message="errorMessage" class="mt-2" />
    </div>
</template>
