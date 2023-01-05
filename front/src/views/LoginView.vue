<script setup>
import VueFormik from "@/components/Form/VueFormik.vue";
import VueField from "@/components/Form/VueField.vue";
import { reactive } from "vue";
import { login } from "../utils/apiCalls";
import { ref } from "vue";
const email = ref("");
const password = ref("");

const handleSubmit = async () => {
    const repoose = await login({
        email: email.value,
        password: password.value,
    });
    console.log(repoose);
};

// Fonction à éxécuté lors de l'evement sumbit => validate OK (donnée valide)
</script>
<template>
    <div class="main-container">
        <div class="login-card">
            <form class="form" @submit.prevent="handleSubmit">
                <h1 class="title">Login to your account</h1>
                <input
                    v-model="email"
                    type="email"
                    placeholder="email"
                    class="input"
                />
                <input
                    name="password"
                    type="password"
                    placeholder="password"
                    class="input"
                    v-model="password"
                />
                <Button name="button" type="submit" class="submit-button">
                    Login
                </Button>
                <!-- EXEMPLE => A MODIFIER -->
            </form>
        </div>
    </div>
</template>

<style scoped>
.form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}
.input {
    width: 100%;
    height: 50px;
    border: 1px solid black;
    border-radius: 5px;
    margin: 10px;
    padding: 10px;
}

.submit-button {
    width: 100%;
    height: 50px;
    border: 1px solid black;
    border-radius: 5px;
    margin: 10px;
    padding: 10px;
    background-color: #111;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
}

.main-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60vh;
}

.login-card {
    width: 30vw;
    height: 350px;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    padding-right: 50px;
    padding-left: 50px;
}

.title {
    font-size: 20px;
    font-weight: 400;
    margin-top: 20px;
    margin-bottom: 20px;
}
</style>
