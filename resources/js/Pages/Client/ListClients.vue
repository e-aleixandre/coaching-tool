<template>
    <authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de clientes
            </h2>
        </template>
        <modal v-if="deleteModal.show" @close="deleteModal.show = false">
            <template #icon>
                <trash-icon class="w-16 h-16 text-red-500 mx-auto"/>
            </template>
            <template #title>
                ¿Quieres borrar el cliente?
            </template>
            <template #content>
                Una vez borrado no será posible recuperar la información. El cliente, su ficha y sus notas serán
                borrados permanentemente.
            </template>
            <template #actions>
                <my-button class="bg-red-500 hover:bg-red-600" :disabled="deleteModal.processing"
                           @click="deleteClient(deleteModal.clientId)">
                    Borrar
                </my-button>
            </template>
        </modal>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <template v-if="clients.length === 0">
                            <dashboard-notification type="warning">
                                No hay clientes para mostrar. Si no tienes clientes puedes ignorar esta advertencia. Si
                                crees que es un error avisa a Enrique.
                            </dashboard-notification>
                        </template>
                        <template v-else>
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Email</th>
                                    <th class="py-3 px-6 text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                <transition-group name="fade">
                                    <tr v-for="(client, index) in clients" :key="client.id"
                                        :class="{'bg-gray-50': index % 2}"
                                        @click="$inertia.get(route('clients.show', client.id))"
                                        class="border-b border-gray-200 hover:bg-gray-100 cursor-pointer">
                                        <!-- Email -->

                                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ client.email }}</td>
                                        <!-- Actions -->
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <!-- Action: view
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <inertia-link :href="route('clients.show', client.id)">
                                                        <eye-icon/>
                                                    </inertia-link>
                                                </div>-->
                                                <!-- Action: edit -->
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <inertia-link @click.stop :href="route('clients.edit', client.id)">
                                                        <pencil-icon/>
                                                    </inertia-link>
                                                </div>
                                                <!-- Action: delete -->
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                                    <trash-icon @click.stop="showDeleteModal(client.id)"/>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                </transition-group>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script>

import AuthenticatedLayout from "@/Layouts/Authenticated";
import DashboardNotification from "@/Components/Notification/DashboardNotification";
import EyeIcon from "@/Components/Icon/EyeIcon";
import PencilIcon from "@/Components/Icon/PencilIcon";
import TrashIcon from "@/Components/Icon/TrashIcon";
import Modal from "@/Components/Notification/Modal";
import MyButton from "@/Components/UI/MyButton";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "ListClients",

    components: {
        MyButton,
        Modal,
        TrashIcon,
        PencilIcon,
        EyeIcon,
        DashboardNotification,
        AuthenticatedLayout
    },

    props: {
        clients: Object
    },

    data() {
        return {
            deleteModal: {
                show: false,
                processing: false,
                clientId: null
            }
        }
    },

    methods: {

        showDeleteModal(clientId) {
            this.deleteModal.clientId = clientId;
            this.deleteModal.show = true;
        },

        deleteClient(clientId) {
            Inertia.delete(this.route('clients.destroy', clientId), {
                onStart: () => {

                },
                onFinish: () => {
                    this.deleteModal.show = false;
                    this.deleteModal.processing = false;
                }
            });
        }
    }
}
</script>
<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0
}
</style>
