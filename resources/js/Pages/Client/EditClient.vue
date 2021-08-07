<template>
    <authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar cliente
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="text-gray-700">
                            <form @submit.prevent="submit">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-1 p-2">
                                        <input-label for="first_name">
                                            Nombre
                                        </input-label>
                                        <form-input id="first_name" type="text"
                                                    :class="{ 'border-red-500': errors.first_name }"
                                                    class="mt-1 block w-full" v-model="form.first_name" required
                                        ></form-input>
                                        <input-error class="mt-1" :message="errors.first_name"></input-error>
                                    </div>
                                    <div class="grid grid-cols-1 p-2">
                                        <input-label for="last_name">
                                            Apellidos
                                        </input-label>
                                        <form-input id="last_name" type="text"
                                                    :class="{ 'border-red-500': errors.last_name }"
                                                    class="mt-1 block w-full" v-model="form.last_name" required
                                        ></form-input>
                                        <input-error class="mt-1" :message="errors.last_name"></input-error>
                                    </div>
                                    <div class="grid grid-cols-1 p-2">
                                        <input-label for="birthdate">
                                            Fecha de nacimiento
                                        </input-label>
                                        <form-input id="birthdate" type="date"
                                                    :class="{ 'border-red-500': errors.birthdate }"
                                                    class="mt-1 block w-full" v-model="form.birthdate" required
                                                    autocomplete="bday"></form-input>
                                        <input-error class="mt-1" :message="errors.birthdate"></input-error>
                                    </div>
                                    <div class="grid grid-cols-1 p-2">
                                        <input-label for="phone">
                                            Teléfono
                                        </input-label>
                                        <form-input id="phone" type="tel" :class="{ 'border-red-500': errors.phone }"
                                                    class="mt-1 block w-full" v-model="form.phone"
                                        ></form-input>
                                        <input-error class="mt-1" :message="errors.phone"></input-error>
                                    </div>
                                </div>
                                <form-button class="m-2" :class="{ 'opacity-25': form.processing }"
                                             :disabled="form.processing">Guardar
                                </form-button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script>

import AuthenticatedLayout from "@/Layouts/Authenticated";
import FormInput from "@/Components/Form/Input";
import InputLabel from "@/Components/Form/Label";
import InputError from "@/Components/Form/InputError";
import FormButton from "@/Components/UI/MyButton";

export default {
    name: "EditClients",

    components: {
        FormButton,
        AuthenticatedLayout,
        FormInput,
        InputLabel,
        InputError
    },

    props: {
        client: Object,
        errors: Object
    },

    beforeMount() {
        this.form.email = this.client.email;
        this.form.first_name = this.client.first_name;
        this.form.last_name = this.client.last_name;
        this.form.birthdate = this.client.birthdate;
        //const birthdate = new Date(this.client.birthdate).toLocaleDateString();
        //this.form.birthdate = `${birthdate.getFullYear()}-${birthdate.getMonth() + 1}-${birthdate.getDay() + 1}`;
        this.form.phone = this.client.phone;
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                first_name: '',
                last_name: '',
                birthdate: '',
                phone: ''
            }),
            clientCreated: false
        }
    },

    methods: {
        submit() {
            this.form.put(this.route('clients.update', {
                client: this.client.id
            }));
        }
    }
}
</script>

<style scoped>

</style>
