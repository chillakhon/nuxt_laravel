<template>
  <div class="overflow-x-auto">
    <table class="table-auto">
      <thead>
      <tr>
        <th class="px-4 py-2 text-left">Id</th>
        <th class="px-4 py-2 text-left">Img</th>
        <th class="px-4 py-2 text-left">Title</th>
        <th class="px-4 py-2 text-left">Description</th>
        <th class="px-4 py-2 text-left">Price</th>
        <th class="px-4 py-2">Actions</th>
      </tr>
      </thead>

      <tbody>
      <tr v-for="product in useAppStore().all_products" :key="product.id">
        <td class="border px-4 py-2">{{ product.id }}</td>
        <td class="border px-4 py-2 w-[100px]">
          <img :src="`http://127.0.0.1:8000/storage/products/${product.images[0].image_path}`" :alt="product.title">

        </td>
        <td class="border px-4 py-2">{{ product.title }}</td>
        <td class="border px-4 py-2">{{ product.description }}</td>
        <td class="border px-4 py-2">{{ product.price }}</td>
        <td class="border px-4 py-2">

          <button
              class="bg-blue-500 text-white px-2 py-1 mr-2"
          >
            <nuxt-link :to="`/products/show/${product.id}`">Посмотреть</nuxt-link>
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import {useAppStore} from "~/store/index.ts";
import {useProducts} from "~/composables/useProducts.ts";

onMounted(() => {
  useProducts().getAllProducts()
})
</script>