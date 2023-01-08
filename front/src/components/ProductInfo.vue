<template>
    <div class="main-container">
        <h1 class="title">{{ name }}</h1>
        <p class="price">{{ price }} €</p>
        <!-- <p class="description">{{ description }}</p> -->
        <p class="stripe-message">
            Pay securely with
            <a class="stripe-logo" href="https://stripe.com/">Stripe</a>
        </p>

        <template v-if="colors && colors.length">
            <p class="standard-label">COLOR</p>
            <div class="color-container">
                <ColorBox
                    v-for="(color, index) in colors"
                    :key="color"
                    :color="color"
                    :class="selectedColor === index ? 'color-selected' : ''"
                    @click="onColorClick(index)"
                ></ColorBox>
            </div>
        </template>

        <!-- show sizes only if there are any -->
        <template v-if="sizes && sizes.length">
            <p class="standard-label">SIZE</p>
            <div class="size-container">
                <div
                    v-for="(size, index) in sizes"
                    :key="size"
                    class="size-box"
                    :class="selectedSize === index ? 'size-selected' : ''"
                    @click="onSizeClick(index)"
                >
                    {{ size }}
                </div>
            </div>
        </template>

        <button class="add-to-cart-button">ADD TO CART</button>
        <button @click="checkout_sessions" class="checkout-button">
            CHECKOUT
        </button>
        <p v-if="errorStatus">Something went wrong, please try again later.</p>
        <template v-if="description">
            <div class="description-container">
                <p class="standard-label">DETAILS</p>
                <p class="description">{{ description }}</p>
            </div>
        </template>
    </div>
</template>

<script setup>
import { ref } from "vue";
import ColorBox from "./ColorBox.vue";
import { defineProps } from "vue";
const props = defineProps({
    name: {
        type: String,
    },
    id: {
        type: Number,
    },
    price: {
        type: Number,
    },
    sizes: {
        type: Array,
    },
    colors: {
        type: Array,
    },
    description: {
        type: String,
    },
});

const selectedColor = ref(0);
const selectedSize = ref(0);
const errorStatus = ref(false);

const onColorClick = (index) => {
    selectedColor.value = index;
};

const onSizeClick = (index) => {
    console.log("size clicked", index);
    selectedSize.value = index;
};

const checkout_sessions = async () => {
    const data = {
        success_url: "http://localhost:3000",
        cancel_url: `http://localhost:3000/products/${props.id}`,
        line_items: [
            {
                price_data: {
                    currency: "EUR",
                    product_data: {
                        name: props.name,
                    },
                    unit_amount_decimal: props.price * 100, //100 = 1€
                },
                quantity: 1,
            },
        ],
    };
    const url = `http://localhost:3010/create-checkout-session`;
    try {
        const resp = await fetch(url, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then()
            .catch((error) => {
                throw new Error(`Fetch error: ${error.message}`);
            });
        if (resp.ok) {
            errorStatus.value = false;
            window.location.replace(await resp.json());
        } else
            throw new Error(
                `Backend error (payment): ${resp.status} - ${resp.statusText}`
            );
    } catch (error) {
        console.log(error);
        errorStatus.value = true;
    }
};
</script>

<style scoped>
.main-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    /* align-items: center; */
}

.title {
    font-size: 18px;
    font-weight: 200;
    margin: 0;
    color: #1c1b1b;
}

.price {
    font-size: 20px;
    font-weight: 200;
    margin: 0;
    color: #4e4d4d;
}

.stripe-message {
    font-size: 12px;
    font-weight: 200;
    margin: 0;
    color: #1c1b1b;
    margin-bottom: 10px;
}

.stripe-logo {
    font-weight: bold;
    color: #5e56f2;
}

.standard-label {
    font-size: 16px;
    font-weight: 220;
    margin: 0;
    color: #1c1b1b;
    margin-top: 10px;
}

.color-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-top: 5px;
}

.color-selected {
    border: 2.5px solid rgba(0, 0, 0, 0.4);
}

.size-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-top: 5px;
}

.size-box {
    width: 40px;
    height: 40px;
    /* border-radius: 5px; */
    /* background-color: #f2f2f2; */
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    color: #4e4d4d;
    font-weight: 300;
    font-size: 14px;
    cursor: pointer;
    border: 1px solid #ddd;
}

.size-selected {
    border: 1px solid #111;
}

.add-to-cart-button {
    width: 100%;
    height: 40px;
    background-color: #222;
    color: #fff;
    font-size: 14px;
    font-weight: 100;
    border: none;
    cursor: pointer;
    margin-top: 30px;
}

.checkout-button {
    width: 100%;
    height: 40px;
    background-color: rgb(59, 39, 150);
    color: #fff;
    font-size: 14px;
    font-weight: 100;
    border: none;
    cursor: pointer;
    margin-top: 30px;
}

.description {
    font-size: 14px;
    font-weight: 200;
    margin: 0;
    color: #1c1b1b;
    margin-top: 10px;
}
.description-container {
    margin-top: 10px;
}
</style>
