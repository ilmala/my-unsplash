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
                               placeholder="Search by name"
                               v-model="search"
                               @input="getImages"
                        >
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
                    :cols="{default: 5, 1260: 4, 960: 3, 780: 2}"
                    :gutter="16"
                >
                    <div v-for="(image,index) in images" :key="image.id">
                        <a href="#" class="relative block group overflow-hidden rounded-2xl shadow-xl mb-6">
                            <div
                                class="opacity-0 group-hover:opacity-100 p-6 absolute inset-0 flex items-end bg-gray-900 bg-opacity-80 text-sm text-white transition-all duration-300">
                                <button
                                    class="absolute top-4 right-4 px-2 py-1 text-xs text-red-400 border border-red-400 rounded-full hover:bg-red-400 hover:text-white transition duration-300"
                                    @click.prevent="onShowDeletePhotoModal(index)"
                                >
                                    Delete
                                </button>
                                <div class="">{{ image.label }}</div>
                            </div>
                            <img
                                :src="image.url"
                                :alt="image.label">
                        </a>
                    </div>
                </masonry>
            </div>
        </main>

        <Modal :open="showAddPhotoModal" @close="closeAddPhotoModal">
            <h2 class="text-2xl text-gray-900">
                Add new photo
            </h2>

            <form class="mt-8" action="" @submit.prevent>
                <div>
                    <label for="label" class="block text-xs text-gray-600">Label</label>
                    <input type="text" ref="labelInput" v-model="label" id="label" name="label"
                           class="mt-1 w-full px-3 py-2 leading-6 border rounded-md shadow-sm"
                           :class="{'border-red-400': formErrors.label}"
                           autofocus required
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
                           required
                    >
                    <div v-if="formErrors.url" class="mt-1 font-medium text-xs text-red-400">
                        {{ formErrors.url[0] }}
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-4">
                    <button type="button"
                            class="bg-white hover:bg-gray-200 border border-white font-semibold text-gray-400 py-3 px-5 rounded-xl focus:outline-none focus:ring-4 focus:ring-gray-100 leading-7 whitespace-nowrap"
                            @click.prevent="closeAddPhotoModal"
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
        </Modal>

        <Modal :open="showDeletePhotoModal" @close="closeDeletePhotoModal">
            <h2 class="text-2xl text-gray-900">
                Delete photo
            </h2>

            <div class="mt-4">
                <p class="text-gray-600">For security reasons we need you to enter your password to delete this photo</p>
            </div>

            <div class="mt-4">
                <input type="password" v-model="deletePassword" class="mt-1 w-full px-3 py-2 leading-6 border rounded-md shadow-sm" required>
            </div>

            <div class="flex justify-end mt-4 space-x-4">
                <button type="button"
                        class="bg-white hover:bg-gray-200 border border-white font-semibold text-gray-400 py-3 px-5 rounded-xl focus:outline-none focus:ring-4 focus:ring-gray-100 leading-7 whitespace-nowrap"
                        @click.prevent="closeDeletePhotoModal"
                >
                    Cancel
                </button>

                <button type="submit"
                        class="bg-red-500 hover:bg-red-400 disabled:opacity-50 border border-red-500 font-semibold text-white py-3 px-5 shadow-sm rounded-xl focus:outline-none focus:ring-4 focus:ring-red-200 leading-7 whitespace-nowrap"
                        @click.prevent="onDeletePhoto"
                        :disabled="!deletePassword.length"
                >
                    Delete
                </button>
            </div>
        </Modal>

    </div>
</template>

<script>
import Logo from "./components/Logo";
import Modal from "./components/Modal";

export default {
    name: "App",
    data() {
        return {
            images: [],
            search: '',
            label: '',
            url: '',
            showAddPhotoModal: false,
            showDeletePhotoModal: false,
            selectedIndexImageToDelete: null,
            formErrors: {},
            deletePassword: ''
        }
    },
    mounted() {
        this.getImages();
    },
    methods: {
        async getImages() {
            let {data} = await axios.get('/images?search=' + this.search);
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
                this.closeAddPhotoModal();
            } catch (err) {
                if (err.response) {
                    this.formErrors = err.response.data.errors;
                } else {
                    this.closeAddPhotoModal();
                    console.log(err.message);
                }
            }
        },
        async onDeletePhoto() {
            try {
                let image = this.images[this.selectedIndexImageToDelete];
                let {data} = await axios.delete('/images/' + image.id);
                this.$delete(this.images, this.selectedIndexImageToDelete);
                this.selectedIndexImageToDelete = null;
                this.showDeletePhotoModal = false;
                this.deletePassword = '';
            } catch (err) {
                console.log(err.message);
            }
        },
        onShowDeletePhotoModal(index) {
            this.selectedIndexImageToDelete = index;
            this.showDeletePhotoModal = true;
        },
        closeAddPhotoModal() {
            this.label = '';
            this.url = '';
            this.showAddPhotoModal = false;
        },
        closeDeletePhotoModal() {
            this.showDeletePhotoModal = false;
        }
    },
    components: {
        Logo,
        Modal
    }
}
</script>

<style scoped>

</style>
