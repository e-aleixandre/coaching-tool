<template>
    <inertia-link :class="[ active && 'border-l-2 border-indigo-400 bg-indigo-50']" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
        <slot />
    </inertia-link>
</template>
<script>
export default {

    props: {
        active: Boolean
    },
}
</script>
