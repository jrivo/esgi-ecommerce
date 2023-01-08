<template>
    <!-- OPTI -->
    <!-- IF as ==='string' html Natif @input="handleChange"  -->
    <!-- IF as ==='Object' ComponentCustom v-model  -->
    <component
        :is="as"
        :name="name"
        :value="values[name]"
        @input="handleChange"
        v-bind="$attrs"
    >
        <slot />
    </component>
</template>

<script>
// use normal <script> to declare options
export default {
    inheritAttrs: false,
};
</script>

<script setup>
import { inject, defineProps, toRaw } from "vue";

defineProps({
    name: {
        type: String,
        required: true,
    },
    as: {
        type: String,
        required: false,
        default: "input",
    },
});

// récupere valeur du Context Formik
const values = inject("formik:values");

const handleChange = function (e) {
    values[e.target.name] = e.target.value;
};

</script>
