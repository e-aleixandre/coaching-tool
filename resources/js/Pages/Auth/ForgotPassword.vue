<template>
    <div class="mb-4 text-sm text-gray-600">
        ¿Has olvidado tu contraseña? No te preocupes. Introduce tu dirección email y te enviaremos un enlace para poder establecer una nueva contraseña.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <breeze-label for="email" value="Email" />
            <breeze-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
            <input-error class="mt-1" :message="errors.email"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <breeze-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Reestablecer contraseña
            </breeze-button>
        </div>
    </form>
</template>

<script>
    import BreezeButton from '@/Components/UI/Button'
    import BreezeGuestLayout from "@/Layouts/Guest"
    import BreezeInput from '@/Components/Form/Input'
    import BreezeLabel from '@/Components/Form/Label'
    import BreezeValidationErrors from '@/Components/Form/ValidationErrors'
    import InputError from "@/Components/Form/InputError";

    export default {
        layout: BreezeGuestLayout,

        components: {
            InputError,
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
        },

        props: {
            status: String,
            errors: Object
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
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>
