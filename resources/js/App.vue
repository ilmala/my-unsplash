<template>
<div>
    <header class="px-4 py-8">
        <div class="flex justify-between items-center container mx-auto">
            <div class="flex items-center space-x-8">
                <Logo/>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center ml-4">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" class="w-72 border border-gray-300 focus:border-blue-300 focus:outline-none focus:ring-4 focus:ring-blue-200 leading-7 pl-10 pr-4 py-3 rounded-xl text-sm" placeholder="Search by name">
                </div>
            </div>
            <div>
                <button type="button" class="bg-green-500 hover:bg-green-400 border border-green-500 font-semibold text-white py-3 px-5 shadow-sm rounded-xl focus:outline-none focus:ring-4 focus:ring-green-200 leading-7 whitespace-nowrap">
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
                <div v-for="(item, index) in items" :key="index">
                    <div class="overflow-hidden rounded-2xl mb-12">
                        <img src="https://images.unsplash.com/photo-1610694742959-4c2785ebbde9?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=934&q=80" alt="image">
                    </div>
                </div>
            </masonry>
        </div>
    </main>
</div>
</template>

<script>
import Logo from "./components/Logo";
export default {
    name: "App",
    data() {
        return {
            items: [0,1,2,3,4,5,6,7,8,9]
        }
    },
    components: {
        Logo
    }
}
</script>

<style scoped>

</style>
