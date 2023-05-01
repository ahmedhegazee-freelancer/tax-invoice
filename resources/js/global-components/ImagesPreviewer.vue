<template lang="">
    <div class="grid grid-cols-4 gap-2 mt-7">
        <div
            class="img-preview"
            v-for="(image, key) in previewImages"
            :key="key"
        >
            <img
                alt="image"
                class="rounded-lg border-white shadow-md"
                :src="image"
            />
        </div>
    </div>
</template>
<script setup>
import { computed } from "@vue/runtime-core";

const props = defineProps({
    imagesList: Array,
});

const previewImages = computed(() => {
    let formattedLinks = [];
    props.imagesList.forEach((image) =>
        formattedLinks.push(URL.createObjectURL(image))
    );
    return formattedLinks;
});
</script>
<style scoped>
.img-preview {
    border-radius: 20px;
    overflow: hidden;
    width: 120px;
    height: 120px;
    position: relative;
    display: block;
    z-index: 10;
}
</style>
