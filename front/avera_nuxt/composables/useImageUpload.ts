import { ref, watch } from 'vue'

export const useImageUpload = () => {
    const imageFile = ref<File[]>([])
    const imageUrl = ref<string[]>([])
    const handleImageSelected = (event: Event) => {
        const files = (event.target as HTMLInputElement).files
        if (files) {
            imageFile.value = Array.from(files)
        } else {
            imageFile.value = []
            imageUrl.value = []
        }
    }

    const readFileAsDataUrl = (file: Blob) => {
        const reader = new FileReader()
        reader.onload = () => {
            if (typeof reader.result === 'string') {
                imageUrl.value.push(reader.result)
            }
        }
        reader.readAsDataURL(file)
    }

    watch(imageFile, (newFiles) => {
        imageUrl.value = []

        newFiles.forEach(file => {
            readFileAsDataUrl(file)
        })
    }, { deep: true })

    return {
        imageFile,
        imageUrl,
        handleImageSelected
    }
}