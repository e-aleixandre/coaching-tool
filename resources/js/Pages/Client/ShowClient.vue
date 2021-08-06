<template>
    <authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Perfil de cliente
            </h2>
            {{ route }}
            <inertia-link href="#" class="text-xs italic ml-2">
                &#8810; Ir al listado de clientes
            </inertia-link>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                            <user-icon/>
                            Perfil de {{ client.email }}
                        </div>
                        <template v-if="!client.isCreated">
                            <dashboard-notification type="warning" v-if="!client.isCreated">
                                El usuario no tiene una ficha creada. No hay información para mostrar.
                            </dashboard-notification>
                            <div class="flex justify-between w-full md:w-8/12">

                                <button-link href="/">Completar perfil</button-link>
                                <button-link href="/">Enviarle un email</button-link>
                            </div>
                        </template>
                        <template v-else>
                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Nombre</div>
                                        <div class="px-4 py-2">{{ client.first_name }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Apellidos</div>
                                        <div class="px-4 py-2">{{ client.last_name }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Fecha de nacimiento</div>
                                        <div class="px-4 py-2">{{ client.birthdate }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Teléfono</div>
                                        <div class="px-4 py-2">{{ client.phone ?? 'Sin especificar' }}</div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script>

import AuthenticatedLayout from "@/Layouts/Authenticated";
import ButtonLink from "@/Components/UI/ButtonLink";
import DashboardNotification from "@/Components/Notification/DashboardNotification";
import UserIcon from "@/Components/Icon/UserIcon";

export default {
    name: "ShowClient",

    components: {
        UserIcon,
        ButtonLink,
        DashboardNotification,
        AuthenticatedLayout
    },

    props: {
        client: Object
    }
}
</script>
