<template>
  <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto grid max-w-7xl gap-x-8 gap-y-20 px-6 lg:px-8 xl:grid-cols-3">
    Login... out
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import {useAppStore} from "~/store/index.ts";

 let token = useCookie('token')

if (token.value){
  onMounted(() => {
    token.value = null
  })
  await axios.post('/api/logout')
  useAppStore().products = null
}
useRouter().replace('/login')


</script>

<style lang="scss" scoped>

</style>
