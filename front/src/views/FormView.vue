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
    <main>
        <VueFormik
            v-slot="{ values, errors, handleSubmit, isSubmitting }"
            :initialValues="initialValues"
            :validate="validate"
            @submit="print"
        >
            {{ JSON.stringify(values) }}
            {{ errors }}
            {{ isSubmitting }}

            <form @submit.prevent="handleSubmit">
                <!-- EXEMPLE => A MODIFIER -->
                <VueField type="email" name="email" placeholder="email" />
                <VueField type="date" name="date" />
                <VueField as="select" name="color">
                    <option value="red">Red</option>
                    <option value="green">Green</option>
                    <option value="blue">Blue</option>
                </VueField>
                <VueField
                    name="password"
                    type="password"
                    placeholder="password"
                />
                <VueField
                    name="button"
                    value="submit"
                    :disabled="isSubmitting"
                    type="submit"
                />
                <!-- EXEMPLE => A MODIFIER -->
            </form>
        </VueFormik>
    </main>
</template>
