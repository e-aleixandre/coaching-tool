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
                        <dashboard-notification type="info">
                            No hay novedades. Usa el menú superior para moverte por la aplicación.
                        </dashboard-notification>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Authenticated'
import DashboardNotification from "@/Components/Notification/DashboardNotification";

export default {

    components: {
        DashboardNotification,
        AuthenticatedLayout,
    }
}
</script>
<style scoped>
</style>
