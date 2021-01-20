<template>
    <div>
        <header class="px-4 py-8">
            <div class="flex justify-between items-center container mx-auto">
                <div class="flex items-center space-x-8">
                    <Logo/>

                    <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center ml-4">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                        <input type="text"
                               class="w-72 border border-gray-300 focus:border-indigo-300 focus:outline-none focus:ring-4 focus:ring-indigo-200 leading-7 pl-10 pr-4 py-3 rounded-xl text-sm"
                               placeholder="Search by name">
                    </div>
                </div>

                <div>
                    <button type="button"
                            class="bg-indigo-500 hover:bg-indigo-400 border border-indigo-500 font-semibold text-white py-3 px-5 shadow-sm rounded-xl focus:outline-none focus:ring-4 focus:ring-indigo-200 leading-7 whitespace-nowrap"
                            @click.prevent="showAddPhotoModal=true"
                    >
                        Add a photo
                    </button>
                </div>
            </div>
        </header>

        <main class="px-4">
            <div class="container mx-auto">
                <masonry
                    :cols="{default: 4, 1024: 3, 768: 2, 640: 1}"
                    :gutter="46"
                >
                    <div v-for="image in images" :key="image.id">
                        <a href="#" class="relative block overflow-hidden rounded-2xl mb-12">
                            <div
                                class="hidden hover:block p-6 absolute inset-0 flex items-end bg-gray-900 opacity-80 text-sm text-white">
                                <button
                                    class="absolute top-4 right-4 px-2 py-1 text-xs text-red-400 border border-red-400 rounded-full hover:bg-red-400 hover:text-white">
                                    Delete
                                </button>
                                <div>{{ image.label }}</div>
                            </div>
                            <img
                                :src="image.url"
                                :alt="image.label">
                        </a>
                    </div>
                </masonry>
            </div>
        </main>

        <div v-if="showAddPhotoModal"
             class="fixed bg-gray-900 bg-opacity-30 inset-0 flex justify-center items-center px-8 py-12">
            <div class="relative bg-white w-full max-w-lg rounded-xl shadow-2xl p-8">
                <h2 class="text-2xl text-gray-900">
                    Add new photo
                </h2>

                <form class="mt-8" action="" @submit.prevent>
                    <div>
                        <label for="label" class="block text-xs text-gray-600">Label</label>
                        <input type="text" v-model="label" id="label" name="label"
                               class="mt-1 w-full px-3 py-2 leading-6 border rounded-md shadow-sm"
                               :class="{'border-red-400': formErrors.label}"
                        >
                        <div v-if="formErrors.label" class="mt-1 font-medium text-xs text-red-400">
                            {{ formErrors.label[0] }}
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="url" class="block text-xs text-gray-600">Photo URL</label>
                        <input type="text" v-model="url" id="url" name="url"
                               class="mt-1 w-full px-3 py-2 leading-6 border rounded-md shadow-sm"
                               :class="{'border-red-400': formErrors.url}"
                        >
                        <div v-if="formErrors.url" class="mt-1 font-medium text-xs text-red-400">
                            {{ formErrors.url[0] }}
                        </div>
                    </div>

                    <div class="flex justify-end mt-4 space-x-4">
                        <button type="button"
                                class="bg-white hover:bg-gray-200 border border-white font-semibold text-gray-600 py-3 px-5 shadow-sm rounded-xl focus:outline-none focus:ring-4 focus:ring-gray-50 leading-7 whitespace-nowrap"
                                @click.prevent="showAddPhotoModal=false"
                        >
                            Cancel
                        </button>

                        <button type="submit"
                                class="bg-indigo-500 hover:bg-indigo-400 border border-indigo-500 font-semibold text-white py-3 px-5 shadow-sm rounded-xl focus:outline-none focus:ring-4 focus:ring-indigo-200 leading-7 whitespace-nowrap"
                                @click.prevent="onAddPhoto"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from "./components/Logo";

export default {
    name: "App",
    data() {
        return {
            images: [],
            label: '',
            url: '',
            showAddPhotoModal: false,
            formErrors: {}
        }
    },
    mounted() {
        this.getImages();
    },
    methods: {
        async getImages() {
            let {data} = await axios.get('/images');
            this.images = data.images.data;
        },
        async onAddPhoto() {
            this.formErrors = {};
            try {
                let {data} = await axios.post('/images', {
                    label: this.label,
                    url: this.url
                });
                this.images.unshift(data);
                this.closeModal();
            }catch (err) {
                if(err.response) {
                    this.formErrors = err.response.data.errors;
                }else{
                    this.closeModal();
                    console.log(err.message);
                }
            }
        },
        closeModal() {
            this.label = '';
            this.url = '';
            this.showAddPhotoModal = false;
        }
    },
    components: {
        Logo
    }
}
</script>

<style scoped>

</style>
