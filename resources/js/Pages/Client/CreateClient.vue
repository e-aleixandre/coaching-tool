<template>
    <authenticated-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear cliente
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <template v-if="!clientCreated">
                            <dashboard-notification type="info">
                                Desde esta página puedes crear un nuevo cliente. Más adelante podrás
                                decidir si rellenar su ficha o enviarle un email para que lo haga él.
                            </dashboard-notification>

                            <form class="w-full md:w-5/12" @submit.prevent="submit">
                                <div class="mb-4">
                                    <input-label for="email">Email del cliente</input-label>
                                    <input-field id="email" type="email" :class="{ 'border-red-500': errors.email }"
                                                 class="mt-1 block w-full" v-model="form.email" required autofocus/>
                                    <input-error class="mt-1" :message="errors.email"/>
                                </div>
                                <div class="flex items-center">
                                    <form-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Añadir cliente
                                    </form-button>
                                </div>
                            </form>
                        </template>

                        <template v-else>
                            <dashboard-notification type="success">
                                Cliente creado correctamente. Ahora puedes completar su perfil o hacerle
                                llegar un email para que lo complete por su cuenta. ¿Qué quieres hacer?
                            </dashboard-notification>

                            <div class="flex justify-between w-full md:w-8/12">

                                <button-link href="/">Completar perfil</button-link>
                                <button-link href="/">Enviarle un email</button-link>
                                <form-button @click="clientCreated = false">Añadir otro cliente</form-button>

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
import FormButton from "@/Components/UI/MyButton";
import InputError from "@/Components/Form/InputError";
import InputField from "@/Components/Form/Input";
import InputLabel from "@/Components/Form/Label";
import DashboardNotification from "@/Components/Notification/DashboardNotification";
import ButtonLink from "@/Components/UI/ButtonLink";

export default {
    name: "CreateClient",

    props: {
        errors: Object
    },

    components: {
        AuthenticatedLayout,
        ButtonLink,
        DashboardNotification,
        InputError,
        FormButton,
        InputField,
        InputLabel
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            }),
            clientCreated: false
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('clients.store'), {
                onSuccess: () => {
                    this.form.reset('email');
                    this.clientCreated = true;
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
