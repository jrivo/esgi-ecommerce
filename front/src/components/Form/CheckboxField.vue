checkbox field

<template>
    <div class="checkbox-container">
        <div v-for="option in options" :key="option.value" class="checkbox">
            <div :class="['box']" @click="onChange(option.value)">
                <div
                    :class="[value.includes(option.value) ? 'filled' : '']"
                ></div>
            </div>

            <div class="label">{{ option.label }}</div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { ref } from "vue";

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    value: {
        type: Array,
        required: true,
    },
    onChange: {
        type: Function,
        required: true,
    },
});
</script>

<style scoped>
.checkbox {
    display: flex;
    align-items: center;
    margin: 5px 0;
    margin-right: 10px;
}

.box {
    width: 20px;
    height: 20px;
    border: 1px solid black;
    border-radius: 5px;
    margin-right: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.label {
    font-size: 13px;
}

.checkbox-container {
    display: flex;
    flex-direction: row;
    /* flex-direction: column; */
    /* width: 100%; */
}

.filled {
    background-color: #111;
    height: 75%;
    width: 75%;
    border-radius: 3px;
}
</style>
