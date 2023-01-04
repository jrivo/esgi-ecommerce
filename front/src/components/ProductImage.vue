<template>
    <img :src="images && images[0]" alt="product image" class="image" />
</template>

<script setup>
import { ref } from "vue";
defineProps({
    images: {
        type: Array,
        // required: true,
    },
});
</script>

<style scoped>
.image {
    height: 70vh;
    border-radius: 0px;
    object-fit: cover;
}
</style>
