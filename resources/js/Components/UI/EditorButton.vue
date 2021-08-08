<template>
    <button
        class="rounded-2xl flex justify-center items-center transition duration-150 hover:bg-gray-300 w-8 h-8 m-1">
        <slot/>
    </button>
</template>

<script>
export default {
    name: "EditorButton"
}
</script>

<style scoped>

</style>
