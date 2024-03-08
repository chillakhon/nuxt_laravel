import axios from "axios";
import {useAppStore} from "~/store";

export default defineNuxtRouteMiddleware(async (to, from) => {

    try {
        const user = await axios.get('/api/user')
        if (user.data) {
            useAppStore().user = user.data
           // console.log(user.data)
        }
    }catch (error) {
        // @ts-ignore
        if (error.response?.status === 401){
            useAppStore().user = false
           // return navigateTo('/login')
            console.log('error')
        }
    }


    // try {
    //     console.log(111)
    //     await axios.get('/api/user')
    //     const token = useCookie('token').value
    //
    //     if(token){
    //         if(useAppStore().$state.user) return;
    //         await axios.get('/api/user')
    //             .then((response) =>{
    //                 if(response.data.user){
    //                     useAppStore().$state.user = response.data.user
    //                 }
    //             })
    //             .catch((error) => {
    //                 if (error.response?.status === 401){
    //                     if(to.path.startsWith('/profile')){
    //                         return navigateTo('/')
    //                     }
    //                 }
    //             })
    //     } else {
    //         if(to.path.startsWith('/profile')){
    //             return navigateTo('/')
    //         }
    //     }
    // }catch (error) {
    //     if (error.response?.status === 401){
    //         return navigateTo('/login')
    //      }
    //     }
    })

