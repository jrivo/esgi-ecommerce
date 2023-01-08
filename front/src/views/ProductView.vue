<template>
    <div class="product-container">
        <ProductImage
            class="product-image"
            :images="product.image"
            :name="product.name"
        />
        <ProductInfo
            class="product-info"
            :name="product.name"
            :price="product.price"
            :sizes="product.sizes"
            :colors="product.colors"
            :description="product.description"
            :id="product.id"
        />
    </div>
</template>

<script setup>
import { ref } from "vue";
import ProductImage from "../components/ProductImage.vue";
import ProductInfo from "../components/ProductInfo.vue";
import { getProduct } from "../utils/apiCalls";
const product = ref({});

const id = window.location.pathname.split("/")[2];

const loadProduct = async () => {
    const data = await getProduct(id);
    product.value = {
        id: data.id,
        name: data.name,
        price: data.price,
        sizes: data.sizes,
        colors: data.colors,
        description: data.description,
        image: data.images,
    };
    console.log("product value", product.value);
};

loadProduct();
</script>

<style scoped>
.product-container {
    display: flex;
    /* align-items: center; */
    /* stretch  items */
    justify-content: center;
}

.product-image {
    border-radius: 10px;
    /* width: 30vw; */
    overflow: hidden;
    margin-right: 30px;
}

.product-info {
    width: 22vw;
    overflow: hidden;
    margin-top: 30px;
}
</style>
