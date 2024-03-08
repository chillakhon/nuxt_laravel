<template>
  <div class="max-w-md mx-auto p-6 bg-white rounded-md shadow-md">
    <h2 class="text-2xl font-bold mb-4">Добавить продукт</h2>
    <form @submit.prevent="addProduct(product)">
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
      <div class="mb-4">
        <div class="w-[100px]"
            v-for="image in imageUrl"
        >
          <img  :src="image" alt=""/>
        </div>
        <label class="block text-gray-700 font-bold mb-2" for="image">
          Изображение
        </label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="product_image"
            type="file"
            @change="handleImageSelected"
            multiple
        />
      </div>
      <div class="flex items-center justify-between">
        <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            type="submit"
        >
          Добавить
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import axios from "axios";
import {useAppStore} from "~/store/index.ts";
import {useImageUpload} from "~/composables/useImageUpload.ts";

const product = ref({
  title: 'dwad',
  description: 'dawd',
  price: 3232,
  image: null,
});


let {imageFile,imageUrl, handleImageSelected } = useImageUpload()

 const  addProduct = async (product) => {
  if (!imageFile.value) return

    const formData = new FormData()

    formData.append('title', product.title)
    formData.append('description', product.description)
    formData.append('price', product.price)

   imageFile.value.forEach(file => {
     formData.append('images[]', file)
   })

    const res = await axios.post('/api/createProduct', formData, {
      headers: {
        'Content-Type':'multipart/form-data'
      }
    })
    useAppStore().products = res.data
    await useRouter().replace('/my-profile')
  }


</script>