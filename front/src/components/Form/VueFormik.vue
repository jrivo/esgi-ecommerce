<template>
    <slot
        :values="values"
        :errors="errors"
        :isSubmitting="isSubmitting"
        :handleSubmit="handleSubmit"
    >
        Form
    </slot>
</template>

<script setup>
import { reactive, ref, toRaw, provide } from "vue";

const props = defineProps({
    initialValues: {
        type: Object,
        required: false,
        default: () => ({}),
    },
    validate: {
        type: Function,
        default: () => ({}),
        required: false,
    },
});

function setIsSubmitting(bool) {
    isSubmitting.value = bool;
}

// variables à passer dans le component enfant (via le slot)
const values = reactive(props.initialValues);
const errors = reactive({});
const isSubmitting = ref(false);

function handleSubmit() {
    setIsSubmitting(true);
    // recupere un obj contenant des erreurs ou non
    const new_errors = props.validate(toRaw(values));
    // merge anciennes avec nouvelles erreurs
    Object.assign(errors, new_errors);
    // supprime les erreurs (corrigé) présente dans l'ancien mais pas le nouveau
    for (const item in errors) {
        if (!new_errors[item]) {
            delete errors[item];
        }
    }
    // Si plus d'erreur emet event submit
    if (!Object.keys(errors).length) {
        emit("submit", toRaw(values), { setIsSubmitting });
    } else setIsSubmitting(false);
}

// defini l'action submit event
const emit = defineEmits(["submit"]);

// Context; envoyer valeur au component descendant
provide("formik:values", values);
provide("formik:errors", errors);
</script>
