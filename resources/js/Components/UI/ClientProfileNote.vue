<template>
    <div class="note w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
        <inertia-link :href="route('notes.edit', note.id)"
           class="bg-yellow-200 block shadow-md hover:shadow-xl rounded-lg overflow-hidden">
            <div class="p-4">
                <span
                    class="inline-block px-2 py-1 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-xs">Categoría</span>
                <h2 class="mt-2 mb-2  font-bold">{{ note.title }}</h2>
                <div class="text-sm" v-html="brief"></div>
            </div>
            <div class="p-4 border-yellow-400 border-t text-xs text-gray-700">
                <span class="flex items-center mb-1">
                    <clock-icon class="w-4 h-4 mr-1"/> Editado {{ note.edited_at }}
                </span>
            </div>
        </inertia-link>
    </div>
</template>

<script>
import ClockIcon from "@/Components/Icon/ClockIcon";

export default {
    name: "ClientProfileNote",
    components: {ClockIcon},
    props: {
        note: Object,
        maxChars: {
            type: Number,
            default: 250
        }
    },
    computed: {
        brief() {
            let brief;
            if (this.note.content.length > this.maxChars)
            {
                brief = this.note.content.substr(0, this.maxChars).concat('...');
            } else {
                brief = this.note.content;
            }

            return brief;
        }
    }
}
</script>
