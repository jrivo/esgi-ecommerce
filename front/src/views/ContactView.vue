<template>
    <div class="main-container">
        <div class="form-card">
            <h1>Contact</h1>
            <VueFormik
                v-slot="{ handleSubmit, isSubmitting }"
                :initialValues="initialValues"
                :validate="validate"
                messageValisation="Message sent with success"
                @submit="print"
            >
                <form @submit.prevent="handleSubmit">
                    <VueField type="email" name="email" placeholder="email" />
                    <VueField
                        as="textarea"
                        name="message"
                        placeholder="message"
                    />
                    <VueField
                        name="button"
                        value="submit"
                        :disabled="isSubmitting"
                        type="submit"
                    />
                </form>
            </VueFormik>
        </div>
    </div>
</template>

<script setup>
import VueFormik from "@/components/Form/VueFormik.vue";
import VueField from "@/components/Form/VueField.vue";
import { reactive } from "vue";

// Valeur du Form
const initialValues = reactive({
    email: "",
    message: "",
});

// Fonction de validation du Form
function validate(values) {
    const errors = {};
    if (!values.email) {
        errors.email = "Required";
    } else if (!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(values.email)) {
        errors.email = "Invalid email address";
    }
    if (!values.message) {
        errors.message = "Required";
    }
    return errors;
}

// Fonction à éxécuté lors de l'evement sumbit => validate OK (donnée valide)
function print(val, { setIsSubmitting }) {
    setIsSubmitting(true);
    initialValues.email = "";
    initialValues.message = "";
}
</script>

<style>
.main-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60vh;
}

.form-card {
    min-width: 60vw;
    /* height: 420px; */
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    padding-right: 50px;
    padding-left: 50px;
    padding-top: 35px;
    padding-bottom: 50px;
}
</style>
