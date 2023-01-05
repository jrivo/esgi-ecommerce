<template>
    <div class="products-container" v-if="products && products.length">
        <!-- loop through products -->

        <!-- if products are loaded, show them else show message -->
        <div v-for="product in products" :key="product.id">
            <Product
                :name="product.name"
                :price="product.price"
                :imageLink="product.image"
                @click="() => $router.push(`/products/${product.id}`)"
            />
        </div>
    </div>
    <div class="empty-page-message-container" v-else>
        <p class="empty-page-message">
            There are no products to show, if you are a vendor you can
            <a class="add-product" href="sell-product">Add a new product</a>
        </p>
    </div>
</template>

<script setup>
import Product from "../components/Product.vue";
import Navbar from "../components/Navbar.vue";
import { ref, watchEffect } from "vue";
import { getAllProducts } from "../utils/apiCalls";

const loadProducts = async () => {
    const data = await getAllProducts();
    products.value = data.map((product) => {
        return {
            id: product.id,
            name: product.name,
            price: product.price,
            image:
                product?.images && Array.isArray(product.images)
                    ? product.images[0]
                    : product.images,
        };
    });
};

// const productList = [
//     {
//         name: "Addidas shoes",
//         price: 100,
//         description: "Comes in multiple colors",
//         image: "https://i8.amplience.net/i/jpl/jd_417268_a?qlt=92&w=750&h=531&v=1&fmt=auto",
//     },
//     {
//         name: "Oversized shirt",
//         price: 50,
//         description: "This shirt is very big",
//         image: "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmedia.missguided.com%2Fi%2Fmissguided%2FTW627405_02%3Ffmt%3Djpeg%26fmt.jpeg.interlaced%3Dtrue%26%24product-page__main--2x%24&f=1&nofb=1&ipt=b65aee3028141fb98211cb9935ab13f934efa46ee203c078d5c17980dd5bbd4a&ipo=images",
//     },
//     {
//         name: "Ugly hat",
//         price: 20,
//         description: "This hat is very ugly",
//         image: "https://sc01.alicdn.com/kf/HTB1f2RjSXXXXXb1XVXXq6xXFXXXq/229435585/HTB1f2RjSXXXXXb1XVXXq6xXFXXXq.jpg",
//     },
//     {
//         name: "Sunglasses",
//         price: 30,
//         description: "These sunglasses are very stylish",
//         image: "https://asset.swarovski.com/images/$size_360/t_swa103/b_rgb:ffffff,c_scale,dpr_3.0,f_auto,w_500/5625304/5625304.jpg",
//     },
// ]

watchEffect(() => {
    loadProducts();
});

const products = ref([]);
</script>

<style scoped>
.products-container {
    display: flex;
    /* flex-direction: column; */
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease-in-out;
}

.empty-page-message-container {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 60vh;
}

.empty-page-message {
    font-weight: 300;
    color: #333;
    text-align: center;
}
.add-product {
    color: #333;
    font-weight: 500;
    text-decoration: underline;
    cursor: pointer;
}
</style>
