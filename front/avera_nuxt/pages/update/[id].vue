<template>
  <div class="max-w-md mx-auto p-6 bg-white rounded-md shadow-md">
    <h2 class="text-2xl font-bold mb-4">Редактировать</h2>
    <form
        @submit.prevent="updateProduct(product.id,product)"
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
           v-for="(image, index) in product.images" key="index">
        <div class="border border-red-600 p-1">
          <button
              @click="removeImage(index)"
              class=" bg-red-500 text-white px-2 py-0 rounded-bl"
          >
            &times;
          </button>
        <img  :src="`http://127.0.0.1:8000/storage/products/${image.image_path}`" :alt="product.title">
        </div>
      </div>
        <div v-for="image in imageUrl" class="flex-none w-48 mr-2 mb-1">
          <div class="border border-red-600 p-1">
          <img :src="image" alt="Preview" class="max-w-full h-auto">
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
            @change="handleImageSelected"
            multiple
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
import {useImageUpload} from "~/composables/useImageUpload.ts";
import axios from "axios";
import {useAppStore} from "~/store/index.ts";

const route = useRoute()
const productId = route.params.id
const product = ref(await useProducts().showProduct(productId))


const removeImage = (index) => {
  product.value.images.splice(index, 1);
};

let {imageFile,imageUrl, handleImageSelected } = useImageUpload()

const updateProduct = async (id, productItem) => {

  const existingImages = product.value.images.map(image => image.image_path);

  console.log(existingImages)

  const formData = new FormData()

  formData.append('title', productItem.title)
  formData.append('description', productItem.description)
  formData.append('price', productItem.price)

  existingImages.forEach(image => {
    formData.append('existing_images[]', image);
  });

  imageFile.value.forEach(file => {
    formData.append('images[]', file)
  })

    const response = await axios.post(`/api/update/${id}`, formData, {
      headers: {
        'Content-Type':'multipart/form-data'
      }}
    ).then((res) => {
      console.log(res.data)
    });
}



</script>