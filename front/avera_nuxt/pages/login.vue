<template>
  <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Вход</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form
          class="space-y-6"
          @submit.prevent="handleLogin(form)"
      >
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input v-model="form.email"
                   id="email"
                   name="email"
                   type="email"
                   autocomplete="email"
                   required=""
                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          </div>
          <div class="mt-2">
            <input v-model="form.password"
                   id="password"
                   name="password"
                   type="password"
                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
          </div>
          <div v-if="errors" style="color: red">
            {{errors.message}}
          </div>
        </div>

        <div>
          <ClientOnly>
            <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
              Вход
            </button>
          </ClientOnly>
        </div>
      </form>
    </div>
  </div>

</template>

<script setup>
 import axios from "axios";
 import {useAppStore} from "../store/index.ts";


const form = ref({
  email: 'test@example.com',
  password: 'password',
})

const errors = ref({
  message: ''
})
async function handleLogin (form) {
  try {
    const res = await axios.post('/api/login', form);
    useCookie('token').value = res.data.token
    navigateTo('/my-profile')
    axios.defaults.headers.common['Authorization'] = `Bearer ${res.data.token}`
  }catch (e) {
    console.log(e)
    if (e.response.status === 422){
      errors.message.value = 'Пользователь не найден'
      console.log(errors)
    }
  }
}

onMounted(() => {
  if (useCookie('token').value) {
    navigateTo('/my-profile')
  }
})
</script>

<style scoped>

</style>