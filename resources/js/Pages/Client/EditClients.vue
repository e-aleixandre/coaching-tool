<template>
    <authenticated-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de clientes
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Editando cliente {{ client.email }}
                </div>
            </div>
        </div>
    </div>
    </authenticated-layout>
</template>

<script>

import AuthenticatedLayout from "@/Layouts/Authenticated";

export default {
    name: "EditClients",

    components: {
        AuthenticatedLayout
    },

    props: {
        client: Object
    }
}
</script>

<style scoped>

</style>
