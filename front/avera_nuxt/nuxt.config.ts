// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    // devServer:{
    //   host: '192.168.0.112',
    //   port: 3000,
    // },
  devtools: { enabled: false },
  modules: [
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt',
    '@formkit/nuxt'
  ],

  formkit: {
    autoImport: true,
  },
  runtimeConfig: {
    public:{
      appUrl: 'http://127.0.0.1:8000'
    }
  },

})
