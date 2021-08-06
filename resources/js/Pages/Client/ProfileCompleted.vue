<template>
    <div>
        <div class="flex justify-center my-4 text-gray-700 fill-current">
            <check-icon width="48" height="48"/>
        </div>
        <span class="text-sm text-gray-600">
            Muchas gracias. En cuanto revise tu ficha me pondré en contacto contigo por correo electrónico o teléfono.
        </span>
    </div>
</template>

<script>
import GuestLayout from "@/Layouts/Guest";
import CheckIcon from "@/Components/Icon/CheckIcon";

export default {
    layout: GuestLayout,

    components: {
        CheckIcon
    },

    name: "ProfileCompleted"
}
</script>

<style scoped>

</style>
