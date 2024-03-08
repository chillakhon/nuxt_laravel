import {defineStore} from "pinia";


export const useAppStore = defineStore({
    id: 'app',
    state: () => ({
        user: false,
        products: ref(),
        all_products: null,
    }),
    actions: {
        addProduct(newProduct: any) {
            this.products.push(newProduct)
        }
    }
})



