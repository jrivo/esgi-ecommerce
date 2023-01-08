<template>
    <div class="navbar">
        <div class="navbar-container">
            <span class="navbar-logo">EASY SHOP</span>
            <div class="navbar-links">
                <router-link class="menu-item" to="/">Home</router-link>
                <router-link class="menu-item" to="/products"
                    >Products</router-link
                >
                <router-link class="menu-item" to="/sell-product"
                    >Sell a product</router-link
                >
                <router-link class="menu-item" to="/contact"
                    >Contact</router-link
                >
            </div>

            <div class="auth-links-container" v-if="!isAuthenticated">
                <router-link class="menu-item" to="/login">Login</router-link>
                <router-link class="menu-item" to="/signup">Signup</router-link>
            </div>
            <div class="auth-links-container" v-else>
                <router-link class="menu-item" to="/login">Logout</router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
const isAuthenticated = ref(false);

const token = localStorage.getItem("token");
if (token) {
    isAuthenticated.value = true;
}
</script>

<style scoped>
.navbar {
    width: 100%;
    height: 80px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
}

.navbar-container {
    width: 100%;
    display: flex;
    /* align-items: center;
  justify-content: center; */
}

.navbar-logo {
    width: 100px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 20px;
    font-weight: bold;
}

.navbar-links {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.menu-item {
    margin: 0 1em;
    cursor: pointer;
    /* remove link styles */
    text-decoration: none;
    padding-left: 10px;
    padding-right: 10px;
    color: #000;
}

.menu-item:hover {
    /* color: #ff6b6b; */
}

.auth-links-container {
    margin-right: 20px;
}
.navbar-links a {
    margin: 0 10px;
    text-decoration: none;
    color: #000;
    font-size: 1.2rem;
    transition: all 0.3s ease-in-out;
}

.navbar-links a:hover {
    color: #646cff;
}

.navbar-links a.active {
    color: #646cff;
}
</style>
