<script setup>
import VueFormik from "@/components/Form/VueFormik.vue";
import VueField from "@/components/Form/VueField.vue";
import { reactive } from "vue";

// Valeur du Form
const initialValues = reactive({
    email: "",
    date: "",
    password: "",
    color: "",
});

// Fonction de validation du Form
function validate(values) {
    console.log("validate", values);
    const errors = {};
    if (!values.email) {
        errors.email = "Required";
    } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(values.email)) {
        errors.email = "Invalid email address";
    }
    if (!values.password) {
        errors.password = "Required";
    }
    if (!values.color) {
        errors.color = "Required";
    }
    return errors;
}

// Fonction à éxécuté lors de l'evement sumbit => validate OK (donnée valide)
function print(val, { setIsSubmitting }) {
    console.log(val);
    setIsSubmitting(true);
}
</script>

<template>
    <div class="main-container">
        <div class="login-card">
            <VueFormik
                v-slot="{ values, errors, handleSubmit, isSubmitting }"
                :initialValues="initialValues"
                :validate="validate"
                @submit="print"
            >
                <h1 class="title">Login to your account</h1>
                <!-- 
                {{ JSON.stringify(values) }}
                {{ errors }}
                {{ isSubmitting }} -->

                <!-- EXEMPLE => A MODIFIER -->
                <VueField
                    type="email"
                    name="email"
                    placeholder="email"
                    class="input"
                />
                <VueField
                    name="password"
                    type="password"
                    placeholder="password"
                    class="input"
                />
                <VueField
                    name="button"
                    value="submit "
                    :disabled="isSubmitting"
                    type="submit"
                    class="submit-button"
                />
                <!-- EXEMPLE => A MODIFIER -->
            </VueFormik>
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
