<template>
<authenticated-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi Panel
        </h2>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <dashboard-notification class="mb-4" type="info">
                        Desde esta página puedes generar un email para que el cliente rellene su ficha.
                    </dashboard-notification>
                    <form class="w-full md:w-5/12" @submit.prevent="submit">
                        <div class="mb-4">
                            <input-label for="email">Email del cliente</input-label>
                            <input-field id="email" type="email" :class="{ 'border-red-500': errors.email }" class="mt-1 block w-full" v-model="form.email" required autofocus />
                            <input-error class="mt-1" :message="errors.email"/>
                        </div>
                        <div class="flex items-center">
                            <form-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Enviar
                            </form-button>
                        </div>
                    </form>
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

export default {
    name: "CreateTokenForm",

    layout: AuthenticatedLayout,

    props: {
        errors: Object
    },

    components: {
        InputError,
        FormButton,
        InputField,
        InputLabel,
        DashboardNotification
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('client_tokens.generate'))
        }
    }
}
</script>

<style scoped>

</style>
