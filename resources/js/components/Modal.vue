<template>
    <div v-if="open"
         class="fixed bg-gray-900 bg-opacity-80 inset-0 flex justify-center items-center px-8 py-12"
         @click.prevent="onClose"
    >
        <div class="relative bg-white w-full max-w-lg rounded-xl shadow-2xl p-8" @click.stop>
            <slot/>
        </div>
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
