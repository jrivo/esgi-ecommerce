<template>
    <component
        v-if="as === 'select'"
        :is="as"
        :name="name"
        :value="values[name]"
        @input="handleChange"
    >
        <slot>Options</slot>
    </component>
    <component
        v-else
        :is="as"
        :type="type"
        :name="name"
        :placeholder="placeholder"
        :value="values[name]"
        @input="handleChange"
    />
</template>

<script setup>
import { inject, defineProps, toRaw } from "vue";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    as: {
        type: String,
        required: false,
        default: "input",
    },
    type: {
        type: String,
        required: false,
        default: "text",
    },
    placeholder: {
        type: String,
        required: false,
        default: "",
    },
});

const handleChange = function (e) {
    values[e.target.name] = e.target.value;
};

// récupere valeur du Context Formik
const values = inject("formik:values");
const errors = inject("formik:errors");
console.log({ values: toRaw(values), errors: toRaw(errors) });
</script>
