<script setup>
import Navbar from "./components/Navbar.vue";
import Products from "./views/Products.vue";
</script>

<template>
    <div class="app">
        <Navbar />
        <Products class="products" />
    </div>
</template>

<style scoped>
.app {
    width: 100vw;
    min-height: 100vh;
    width: 100%;
    height: 100%;
    background-color: #f5f5f5;
}
.logo {
    height: 6em;
    padding: 1.5em;
    will-change: filter;
}
.logo:hover {
    filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
    filter: drop-shadow(0 0 2em #42b883aa);
}
.products {
    margin-top: 100px;
}
</style>
