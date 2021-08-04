<template>
    <div>
        <small class="text-gray-600">Rellena tus datos para crear tu ficha de cliente</small>

        <validation-errors class="mb-4"/>
        <form novalidate ="mt-4 w-full max-w-lg" @submit.prevent="submit">

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <input-label for="first-name">
                        Nombre
                    </input-label>
                    <breeze-input id="first-name" type="text" class="mt-1 block w-full" v-model="form.first_name"
                                  required autofocus autocomplete="given-name"/>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <input-label for="last-name">
                        Apellidos
                    </input-label>
                    <breeze-input id="last-name" type="text" class="mt-1 block w-full" v-model="form.last_name" required
                                  autocomplete="family-name"/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <input-label for="birthdate">
                        Fecha de nacimiento
                    </input-label>
                    <breeze-input id="birthdate" type="date" class="mt-1 block w-full" v-model="form.birthdate" required
                                  autocomplete="bday"></breeze-input>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <input-label for="phone">
                        Teléfono
                    </input-label>
                    <breeze-input id="phone" type="tel" class="mt-1 block w-full" v-model="form.phone"
                                  autocomplete="tel"></breeze-input>
                    <p class="mt-3 text-gray-600 text-xs italic">
                        El teléfono no es obligatorio, pero agilizará la comunicación
                    </p>
                </div>
            </div>
            <div class="flex w-full justify-end">
                <breeze-button type="submit" class="right-0" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Siguiente
                </breeze-button>
            </div>
        </form>
    </div>
</template>

<script>
import GuestLayout from "@/Layouts/Guest";
import ValidationErrors from "@/Components/ValidationErrors";
import BreezeInput from "@/Components/Input";
import InputLabel from "@/Components/Label";
import BreezeButton from "@/Components/Button";

export default {
    layout: GuestLayout,

    props: {
        clientToken: String
    },

    components: {
        BreezeInput,
        InputLabel,
        ValidationErrors,
        BreezeButton
    },

    name: "CompleteProfile",

    data() {
        return {
            form: this.$inertia.form({
                first_name: '',
                last_name: '',
                phone: '',
                birthdate: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('client_token.complete_profile', this.clientToken), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>

<style scoped>

</style>
