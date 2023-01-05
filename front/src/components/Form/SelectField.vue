custom select field

<template>
    <div class="select-field" @click="showOptions = !showOptions">
        <div class="select-input">{{ value ? value.label : label }}</div>
        <div class="select-options" v-show="showOptions">
            <div
                v-for="option in options"
                :key="option.value"
                class="select-option"
                @click="onChange(option)"
            >
                {{ option.label }}
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { defineProps } from "vue";

const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    options: {
        type: Array,
        required: true,
    },
    value: {
        type: String,
        required: true,
    },
    onChange: {
        type: Function,
        required: true,
    },
});

const showOptions = ref(false);
const options = ref(props.options);

// const { label, options, value, onChange } = ref(props);
</script>

<style scoped>
.select-input {
    width: 100%;
    height: 50px;
    border: 1px solid black;
    border-radius: 5px;
    padding: 10px;
    font-size: 13px;
}

.select-field {
    width: 100%;
    position: relative;
    margin: 10px;
    cursor: pointer;
    user-select: none;
}

.select-options {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: #fff;
    border: 1px solid black;
    border-top: none;
    border-radius: 5px;
    /* padding: 10px; */
    z-index: 2;
}

.select-option {
    padding: 15px;
    cursor: pointer;
}

.select-option:hover {
    background-color: #eee;
}
</style>
