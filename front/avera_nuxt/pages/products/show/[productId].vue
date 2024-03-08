<template>

  <div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row">
      <swiper :navigation="true" :modules="modules" class="mySwiper">
        <swiper-slide v-for="imageUrl in product.images">
          <img :src="`http://127.0.0.1:8000/storage/products/${imageUrl.image_path}`"
               :alt="product.title"
               class="border border-red-500 p-2"
          />
        </swiper-slide>
      </swiper>

      <div class="md:w-1/2 md:pl-8">
        <h1 class="text-3xl font-bold mb-2">{{ product.title }}</h1>
        <p class="text-gray-600 mb-4">{{ product.description }}</p>
        <p class="text-2xl font-bold">{{ formatPrice(product.price) }}</p>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
          Купить
        </button>
      </div>
    </div>
  </div>


  <div
      class=" flex mr-2">
    <div class="border border-red-500 m-2 ">One</div>
    <div class="border border-red-500 m-2">Two</div>
    <div class="border border-red-500 m-2">Three</div>
    <div class="border border-red-500 m-2">Four</div>
    <div class="border border-red-500 m-2">Five</div>
  </div>


</template>

<script setup>
import {useProducts} from "~/composables/useProducts.ts";

import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import { Navigation } from 'swiper/modules';

const modules = [Navigation]

const route = useRoute()
const productId = route.params.productId
const product = ref(await useProducts().showProduct(productId))
console.log(product)



const formatPrice = (price) => {
  return new Intl.NumberFormat('ru-RU', { style: 'currency', currency: 'RUB' }).format(price)
}
</script>

<style>




.swiper {
  width: 60%;
  height: 80%;

}

.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #fff;

  display: flex;
  justify-content: center;
  align-items: center;

}

.swiper-slide img {
  display: block;
  width: 60%;
  height: 60%;
  object-fit: cover;
}

</style>