<template>
    <div class="bg-white dark:bg-gray-900 min-h-screen">
        <header class="px-4 py-8">
            <div class="flex justify-between items-center">
                <!-- Left nav -->
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
                               class="w-72 bg-gray-100 dark:bg-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 leading-7 pl-10 pr-4 py-3 rounded-xl text-sm"
                               placeholder="Search by name"
                               v-model="search"
                               @input="getImages"
                        >
                        <span v-if="this.search.length" class="absolute inset-y-0 right-0 flex items-center mr-2">
                            <button class="p-2 bg-gray-900 rounded-full text-gray-400 hover:text-white"
                                    @click.prevent="clearSearch">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </span>
                    </div>
                </div>

                <!-- Right nav -->
                <div class="flex items-center space-x-2">
                    <div>
                        <button v-if="!darkMode"
                                class="w-10 h-10 rounded-full text-gray-500 hover:text-gray-800 flex justify-center items-center flex-shrink-0 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                @click.prevent="setDarkMode(true)"
                        >
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </button>
                        <button v-if="darkMode"
                                class="w-10 h-10 rounded-full text-gray-400 hover:text-gray-50 flex justify-center items-center flex-shrink-0 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                @click.prevent="setDarkMode(false)"
                        >
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>
                    </div>
                    <button type="button"
                            class="bg-teal-500 hover:bg-teal-600 font-semibold text-white py-3 px-5 shadow-sm rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-200 leading-7 whitespace-nowrap"
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
                                    class="absolute top-4 right-4 inline-flex items-center space-x-1 px-3 py-1 font-semibold text-xs text-red-400 leading-6 border border-red-400 rounded-full hover:bg-red-400 hover:text-white transition duration-300 focus:outline-none focus:ring-4 focus:ring-gray-500"
                                    @click.prevent="onShowDeletePhotoModal(index)"
                                >
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Delete</span>
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

        <footer class="px-8 py-12 text-center">
            <p class="text-gray-400 text-sm dark:text-gray-700">
                Created by <a class="text-teal-500 dark:text-teal-700 hover:underline" href="https://github.com/ilmala">@ilmala</a>
            </p>
        </footer>

        <Modal :open="showAddPhotoModal" @close="closeAddPhotoModal">
            <h2 class="font-semibold text-2xl text-gray-900">
                Add new photo
            </h2>

            <form class="mt-8" action="" @submit.prevent>
                <div>
                    <label for="label" class="block text-sm text-gray-500">Label</label>
                    <input type="text" ref="labelInput" v-model="label" id="label" name="label"
                           class="mt-1 w-full px-3 py-3 leading-6 text-lg bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                           :class="{'border-red-400': formErrors.label}"
                           autofocus required
                    >
                    <div v-if="formErrors.label" class="mt-1 font-medium text-xs text-red-400">
                        {{ formErrors.label[0] }}
                    </div>
                </div>

                <div class="mt-4">
                    <label for="url" class="block text-sm text-gray-500">Photo URL</label>
                    <input type="text" v-model="url" id="url" name="url"
                           class="mt-1 w-full px-3 py-3 leading-6 text-lg bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500"
                           :class="{'border-red-400': formErrors.url}"
                           required
                    >
                    <div v-if="formErrors.url" class="mt-1 font-medium text-xs text-red-400">
                        {{ formErrors.url[0] }}
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-4">
                    <button type="button"
                            class="bg-white hover:bg-gray-200 border border-white font-semibold text-gray-400 hover:text-gray-700 py-3 px-5 rounded-xl focus:outline-none focus:ring-4 focus:ring-gray-100 leading-7 whitespace-nowrap"
                            @click.prevent="closeAddPhotoModal"
                    >
                        Cancel
                    </button>

                    <button type="submit"
                            class="bg-teal-500 hover:bg-teal-600 font-semibold text-white py-3 px-5 shadow-sm rounded-xl focus:outline-none focus:ring-4 focus:ring-teal-200 leading-7 whitespace-nowrap"
                            @click.prevent="onAddPhoto"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </Modal>

        <Modal :open="showDeletePhotoModal" @close="closeDeletePhotoModal">
            <h2 class="font-semibold text-2xl text-gray-900">
                Delete photo
            </h2>

            <div class="mt-4">
                <p class="text-gray-600">For security reasons we need you to enter your password to delete this
                    photo</p>
            </div>

            <div class="mt-4">
                <input type="password" v-model="deletePassword"
                       class="mt-1 w-full px-3 py-2 leading-6 border rounded-md shadow-sm" required>
            </div>

            <div class="flex justify-end mt-4 space-x-4">
                <button type="button"
                        class="bg-white hover:bg-gray-200 border border-white font-semibold text-gray-400 hover:text-gray-700 py-3 px-5 rounded-xl focus:outline-none focus:ring-4 focus:ring-gray-100 leading-7 whitespace-nowrap"
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
            deletePassword: '',
            darkMode: false,
        }
    },
    mounted() {
        this.getImages();
        //this.setDarkMode(true);
    },
    methods: {
        async getImages() {
            let {data} = await axios.get('/images?search=' + this.search);
            this.images = data.images.data;
        },
        clearSearch() {
            this.search = '';
            this.getImages();
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
        },
        setDarkMode(state) {
            this.darkMode = state;
            console.log(this.darkMode);
            if (this.darkMode) {
                document.querySelector('html').classList.add('dark')
            } else {
                document.querySelector('html').classList.remove('dark')
            }
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
