<!-- product component -->

<template>
  <div class="product">
    <div class="product-image">
      <img :src="imageLink" alt="product image" />
    </div>
    <div class="product-info">
      <h2 class="product-title">{{ name }}</h2>
      <p class="product-price">{{ price }} €</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  name: {
    type: String,
    required: true,
  },
  price: {
    type: Number,
    required: true,
  },
  imageLink: {
    type: String,
    required: true,
  },
});
</script>

<style scoped>
.product {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 250px;
  height: 350px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease-in-out;
  margin: 10px;
  cursor: pointer;
}

.product:hover {
  transform: scale(1.05);
}

.product-image {
  width: 100%;
  height: 100%;
  border-radius: 10px 10px 0 0;
  overflow: hidden;
}

.product-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-info {
  /* display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center; */
  color: #1c1b1b;
  padding: 10px;
  padding-top: 20px;
}

.product-title {
  font-size: 15px;
  font-weight: 200;
  margin: 0;
  color: #4e4d4d;
}

.product-price {
  font-size: 15px;
  font-weight: 200;
  margin: 0;
  color: #4e4d4d;
}
</style>
