<script setup>
import { signup } from "../utils/apiCalls";
import { ref } from "vue";
import SelectField from "../components/Form/SelectField.vue";
import CheckboxField from "../components/Form/CheckboxField.vue";
const name = ref("");
const price = ref("");
const colorOptions = [
    { value: "red", label: "Red" },
    { value: "blue", label: "Blue" },
    { value: "green", label: "Green" },
    { value: "yellow", label: "Yellow" },
    { value: "black", label: "Black" },
];
const sizeOptions = [
    { value: "XS", label: "S" },
    { value: "S", label: "S" },
    { value: "M", label: "M" },
    { value: "L", label: "L" },
    { value: "XL", label: "XL" },
    { value: "2XL", label: "2XL" },
    { value: "3XL", label: "3XL" },
];

const selectedColors = ref([]);
const selectedSizes = ref([]);

const onColorChange = (value) => {
    console.log("color changed", value);
    if (selectedColors.value.includes(value)) {
        selectedColors.value = selectedColors.value.filter(
            (color) => color !== value
        );
    } else {
        selectedColors.value = [...selectedColors.value, value];
    }
};

const onSizeChange = (value) => {
    console.log("size changed", value);
    if (selectedSizes.value.includes(value)) {
        selectedSizes.value = selectedSizes.value.filter(
            (size) => size !== value
        );
    } else {
        selectedSizes.value = [...selectedSizes.value, value];
    }
};

const description = ref("");
const image = ref("");

const role = ref(undefined);

const handleSubmit = async () => {
    const response = await signup({
        name: name.value,
        price: price.value,
        colors: selectedColors.value,
        sizes: selectedSizes.value,
        description: description.value,
        images: [image.value],
    });
    console.log(response);
};

// Fonction à éxécuté lors de l'evement sumbit => validate OK (donnée valide)
</script>
<template>
    <div class="main-container">
        <div class="login-card">
            <form class="form" @submit.prevent="handleSubmit">
                <h1 class="title">Create a new product</h1>

                <div class="form-grid">
                    <input
                        v-model="name"
                        type="text"
                        placeholder="Product name"
                        class="input"
                    />
                    <input
                        name="price"
                        type="number"
                        placeholder="Price"
                        class="input"
                        v-model="price"
                    />
                    <div class="input-container">
                        <p class="input-label">Color</p>
                        <CheckboxField
                            label="Colors"
                            :options="colorOptions"
                            :value="selectedColors"
                            :onChange="onColorChange"
                        />
                    </div>
                    <div class="input-container">
                        <p class="input-label">Size</p>
                        <CheckboxField
                            label="Sizes"
                            :options="sizeOptions"
                            :value="selectedSizes"
                            :onChange="onSizeChange"
                        />
                    </div>
                </div>

                <input
                    name="description"
                    type="text"
                    placeholder="Description"
                    :class="['input', 'margin-top']"
                    v-model="description"
                />
                <input
                    name="image"
                    type="text"
                    placeholder="Product image url"
                    :class="['input', 'margin-top']"
                    v-model="image"
                />
                <Button
                    name="button"
                    type="submit"
                    :class="['submit-button', 'margin-top']"
                >
                    Create product
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
    width: 200px;
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

.title {
    font-size: 20px;
    font-weight: 400;
    margin-top: 20px;
    margin-bottom: 20px;
}
.form-grid {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    /* horizontal gap  */
    grid-column-gap: 30px;
    grid-column-gap: 50px;
    margin-top: 35px;
}

.input-container {
    margin-top: 20px;
}

.input-label {
    margin-bottom: 7px;
}

.margin-top {
    margin-top: 20px;
}
</style>
