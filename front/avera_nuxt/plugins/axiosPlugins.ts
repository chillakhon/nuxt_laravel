import axios from "axios";

export default defineNuxtPlugin(async (nuxtApp) => {

    const config = useRuntimeConfig()

    axios.defaults.baseURL = `${config.public.appUrl}`

    let token = useCookie('token').value

    if (token) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    }

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
    axios.defaults.headers.common['Content-Type'] = 'application/json'
    axios.defaults.headers.common['Accept'] = 'application/json'


    // const csrfToken = axios.defaults.baseURL = 'http://127.0.0.1:8000';
    // await axios.get('/sanctum/csrf-cookie')
    // axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    // axios.defaults.headers.common["Content-Type"] = "application/json";
    // axios.defaults.headers.common["Accept"] = "application/json";
    // axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken
    // axios.defaults.withCredentials = true;

})
