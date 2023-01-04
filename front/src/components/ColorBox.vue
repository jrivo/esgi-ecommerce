<template>
    <div class="color-box">
        <div class="box-inside" :style="{ backgroundColor: localColor }"></div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { ref } from "vue";

const props = defineProps({
    color: {
        type: String,
    },
});

const localColor = ref(props.color);

if (props.color === "red") {
    localColor.value = "#ff6666";
} else if (props.color === "blue") {
    localColor.value = "#afeeee";
} else if (props.color === "green") {
    localColor.value = "#66cdaa";
} else if (props.color === "yellow") {
    localColor.value = "#ffff66";
} else if (props.color === "black") {
    localColor.value = "#101010";
} else if (props.color === "white") {
    localColor.value = "#ffffff";
}
</script>

<style scoped>
.color-box {
    width: 30px;
    height: 30px;
    border-radius: 5px;
    margin: 5px;
    cursor: pointer;
    padding: 2px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.box-inside {
    width: 90%;
    height: 90%;
    border-radius: 2px;
}
</style>
