<template>
  <div class="max-w-md mx-auto p-6 bg-white rounded-md shadow-md">
    <h2 class="text-2xl font-bold mb-4">Редактировать</h2>
    <form
        @submit.prevent="useProducts().updateProduct(product.id,{
            title: product.title,
            description: product.description,
            price: product.price,
            image: product.image
        })"
    >
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="name">
          Название
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="name"
            type="text"
            v-model="product.title"
            required
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="description">
          Описание
        </label>
        <textarea
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="description"
            rows="3"
            v-model="product.description"
            required
        ></textarea>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="price">
          Цена
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="price"
            type="number"
            step="0.01"
            v-model="product.price"
            required
        />
      </div>
      <div class="border px-4 py-2 flex overflow-x-auto">
      <div class="flex-none w-48 mr-2 mb-1"
           v-for="imageUrl in product.images">
        <div class="border border-red-600 p-1">
        <img :src="`http://127.0.0.1:8000/storage/products/${imageUrl.image_path}`" :alt="product.title">
        </div>
      </div>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="image">
          Изображение
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="image"
            type="file"
            @change="handleImageUpload"
        />
      </div>
      <div class="flex items-center justify-between">
        <button

            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >

          Обновить
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>

import {useProducts} from "~/composables/useProducts.ts";

const route = useRoute()
const productId = route.params.id
const product = ref(await useProducts().showProduct(productId))
const products = ref({
  title: '',
  description: '',
  price: null,
  image: null,
});

</script>