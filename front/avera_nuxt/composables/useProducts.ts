import axios from "axios";
import {useAppStore} from "~/store";

export const useProducts = () =>{
    async function getProducts() {
        if (useAppStore().products){
            return  useAppStore().products
        }else{
            const res = await axios.get('/api/products').then(
                (res) => {
                    useAppStore().products = res.data
                    console.log(res.data)
                }
            )
           // useAppStore().products = res.data
        }
    }
    async function getAllProducts() {
        if (useAppStore().all_products){
            return  useAppStore().all_products
        }else{
            const res = await axios.get('/api/all_products').then(
                (res) => {
                    console.log(res.data)
                    useAppStore().all_products = res.data
                }
            )
        }
    }
    async function removeProduct(productId:string) {
         await axios.delete(`/api/products/${productId}`)
        const res = await axios.get('/api/products')
        useAppStore().products = res.data
    }

    async function updateProduct(productId: string, data: any){
        const res = await axios.put(`/api/update/${productId}`, data)
        const res2 = await axios.get('/api/products')
        useAppStore().products = res2.data
        await useRouter().replace('/my-profile')
    }

    async function showProduct(productId:any) {
        const res = await axios.get(`/api/products/${productId}`)
        return res.data
    }


    return {
        getProducts,removeProduct,updateProduct,showProduct,getAllProducts
    }
}