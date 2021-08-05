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
                    <div class="mb-6 bg-blue-100 border-l-4 border-blue-500 text-white-700 p-4" role="alert">
                        <p class="font-bold">Información</p>
                        <p class="text-sm">Desde esta página puedes generar un email para el que el cliente rellene su ficha.</p>
                    </div>

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
import FormButton from "@/Components/Button";
import InputError from "@/Components/InputError";
import InputField from "@/Components/Input";
import InputLabel from "@/Components/Label";

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
        InputLabel
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
