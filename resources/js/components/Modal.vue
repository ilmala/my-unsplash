<template>
    <div>
        <transition
            enter-active-class="transition-all duration-100 ease-out transform"
            leave-active-class="transition-all duration-100 ease-in transform"
            enter-class="opacity-0"
            enter-to-class="opacity-100"
            leave-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="open" class="origin-top fixed z-40 inset-0 bg-gray-900 bg-opacity-70"></div>
        </transition>
        <transition
            enter-active-class="transition-all duration-200 ease-out transform"
            leave-active-class="transition-all duration-100 ease-in transform"
            enter-class="opacity-0 scale-90"
            enter-to-class="opacity-100 scale-100"
            leave-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-90"
        >
            <div v-if="open"
                 class="origin-top fixed z-50 inset-0 flex justify-center items-center px-8 py-12"
                 @click.prevent="onClose"
            >
                <div class="relative bg-white w-full max-w-lg rounded-xl shadow-2xl p-8" @click.stop>
                    <slot/>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    name: "Modal",
    props: ['open'],
    methods: {
        onClose() {
            this.$emit('close');
        }
    }
}
</script>

<style scoped>

</style>
