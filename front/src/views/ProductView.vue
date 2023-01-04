<template>
    <div class="product-container">Product page</div>
</template>

<script setup>
import Product from "../components/Product.vue";
import { ref } from "vue";

const products = ref({
    name: "Addidas shoes",
    price: 100,
});
</script>

<style scoped>
.product-container {
    /* display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease-in-out; */
}
</style>
