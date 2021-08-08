<template>
    <authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar nota
            </h2>
        </template>

        <div v-if="editor" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-2 bg-white border-b border-gray-200">
                        <div class="editor-buttons flex flex-wrap flex-shrink-0">


                            <editor-button @click="editor.chain().focus().toggleBold().run()"
                                           :class="{'is-active': editor.isActive('bold')}">
                                <b-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().toggleUnderline().run()"
                                           :class="{'is-active': editor.isActive('underline')}">
                                <underscore-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().toggleItalic().run()"
                                           :class="{'is-active': editor.isActive('italic')}">
                                <italic-icon/>
                            </editor-button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <editor-content :editor="editor"/>
                    </div>
                </div>
            </div>
        </div>
    </authenticated-layout>
</template>

<script>

import AuthenticatedLayout from "@/Layouts/Authenticated";
import {Editor, EditorContent} from "@tiptap/vue-3";
import StarterKit from '@tiptap/starter-kit'
import BIcon from "@/Components/Icon/BIcon";
import UnderscoreIcon from "@/Components/Icon/UnderscoreIcon";
import Underline from "@tiptap/extension-underline";
import Italic from "@tiptap/extension-italic";
import EditorButton from "@/Components/UI/EditorButton";
import ItalicIcon from "@/Components/Icon/ItalicIcon";

export default {
    name: "EditNote",

    components: {
        ItalicIcon,
        EditorButton,
        UnderscoreIcon,
        BIcon,
        EditorContent,
        Underline,
        Italic,
        AuthenticatedLayout,
    },

    data() {
        return {
            editor: null
        }
    },

    mounted() {
        this.editor = new Editor({
            content: '<p>I’m running tiptap with Vue.js. 🎉</p>',
            extensions: [
                StarterKit,
                Underline,
                Italic
            ],
        })
    },

    beforeUnmount() {
        this.editor.destroy()
    }


}
</script>
<style scoped>
</style>
