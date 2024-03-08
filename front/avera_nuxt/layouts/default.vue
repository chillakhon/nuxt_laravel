<template>
  <div>
  <header class="bg-white">
    <nav style="background: #d0cece" class=" mx-auto flex max-w-9xl items-center justify-between p-4 lg:px-1" aria-label="Global">
      <div class="hidden lg:flex lg:gap-x-12">
        <nuxt-link to="/">Home</nuxt-link>
        <nuxt-link to="/products/produc">Product</nuxt-link>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <div class="mr-4">
        <nuxt-link v-if="!useAppStore().user" to="/register"> Регистрация </nuxt-link>
        </div>
        <div class="mr-4">
          <nuxt-link v-if="useAppStore().user" to="/my-profile"> MyProfile </nuxt-link>
        </div>
        <nuxt-link v-if="!useAppStore().user" to="/login"> Вход <span aria-hidden="true"></span> </nuxt-link>
        <nuxt-link v-else to="/logout"> Выход <span aria-hidden="true">&rarr;</span> </nuxt-link>
      </div>

    </nav>
  </header>

    <section> <slot/> </section>

    <footer> footer </footer>

  </div>

</template>

<script setup>

import {useAppStore} from "~/store/index.ts";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import MyProfile from "~/pages/my-profile.vue";


</script>

<style lang="scss" scoped>

</style>
