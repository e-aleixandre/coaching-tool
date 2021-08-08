<template>
    <authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar nota
            </h2>
            <button :disabled="note.saving || note.saved"
                    class="text-xs disabled:opacity-50 italic ml-2 flex bg-blue-100 hover:bg-blue-300 p-2 rounded-lg"
                    @click="saveChanges">
                <save-icon class="w-4 h-4 mr-2"/>
                <template v-if="note.saved">
                    Todos los cambios guardados
                </template>
                <template v-else-if="note.saving">
                    Guardando...
                </template>
                <template v-else>
                    Guardar cambios
                </template>
            </button>
        </template>

        <div v-if="editor" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-2 bg-white border-b border-gray-200">
                        <div class="editor-buttons flex flex-wrap flex-shrink-0">
                            <editor-button @click="editor.chain().focus().undo().run()">
                                <undo-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().redo().run()">
                                <redo-icon/>
                            </editor-button>
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
                            <editor-button @click="editor.chain().focus().toggleStrike().run()"
                                           :class="{'is-active': editor.isActive('strike')}">
                                <strikethrough-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().setTextAlign('left').run()"
                                           :class="{'is-active': editor.isActive({ textAlign: 'left' })}">
                                <align-left-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().setTextAlign('center').run()"
                                           :class="{'is-active': editor.isActive({ textAlign: 'center' })}">
                                <align-center-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().setTextAlign('right').run()"
                                           :class="{'is-active': editor.isActive({ textAlign: 'right' })}">
                                <align-right-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().setTextAlign('justify').run()"
                                           :class="{'is-active': editor.isActive({ textAlign: 'justify' })}">
                                <align-justify-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().toggleBulletList().run()"
                                           :class="{'is-active': editor.isActive('bulletList')}">
                                <bullet-list-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().toggleOrderedList().run()"
                                           :class="{'is-active': editor.isActive('orderedList')}">
                                <ordered-list-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().toggleTaskList().run()"
                                           :class="{'is-active': editor.isActive('taskList')}">
                                <task-list-icon/>
                            </editor-button>
                            <editor-button @click="editor.chain().focus().setHorizontalRule().run()">
                                <horizontal-rule-icon/>
                            </editor-button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="note note-editor p-6 bg-white border-b border-gray-200">
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
import TaskList from "@tiptap/extension-task-list";
import TaskListItem from "@tiptap/extension-task-item";
import TextAlign from "@tiptap/extension-text-align";
import EditorButton from "@/Components/UI/EditorButton";
import ItalicIcon from "@/Components/Icon/ItalicIcon";
import StrikethroughIcon from "@/Components/Icon/StrikethroughIcon";
import BulletListIcon from "@/Components/Icon/BulletListIcon";
import OrderedListIcon from "@/Components/Icon/OrderedListIcon";
import UndoIcon from "@/Components/Icon/UndoIcon";
import RedoIcon from "@/Components/Icon/RedoIcon";
import HorizontalRuleIcon from "@/Components/Icon/HorizontalRuleIcon";
import TaskListIcon from "@/Components/Icon/TaskListIcon";
import AlignLeftIcon from "@/Components/Icon/AlignLeftIcon";
import AlignCenterIcon from "@/Components/Icon/AlignCenterIcon";
import AlignRightIcon from "@/Components/Icon/AlignRightIcon";
import AlignJustifyIcon from "@/Components/Icon/AlignJustifyIcon";
import SaveIcon from "@/Components/Icon/SaveIcon";
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "EditNote",

    components: {
        SaveIcon,
        AlignJustifyIcon,
        AlignRightIcon,
        AlignCenterIcon,
        AlignLeftIcon,
        TaskListIcon,
        HorizontalRuleIcon,
        RedoIcon,
        UndoIcon,
        OrderedListIcon,
        BulletListIcon,
        StrikethroughIcon,
        ItalicIcon,
        EditorButton,
        UnderscoreIcon,
        BIcon,
        EditorContent,
        AuthenticatedLayout
    },

    props: {
        _note: Object
    },

    data() {
        return {
            editor: null,
            note: {
                title: null,
                content: null,
                saved: true,
                saving: false
            }
        }
    },

    mounted() {
        this.note.content = this._note.content;
        this.note.title = this._note.title;
        this.editor = new Editor({
            content: this.note.content,
            extensions: [
                StarterKit,
                Underline,
                TaskList,
                TaskListItem,
                TextAlign
            ],
            onUpdate: () => {
                this.note.content = this.editor.getHTML();
                this.note.saved = false;
            }
        });
    },

    beforeUnmount() {
        this.editor.destroy()
    },

    methods: {

        saveChanges() {
            Inertia.put(this.route('notes.update', this._note.id),
                {
                    title: this.note.title,
                    content: this.note.content
                },
                {
                    onBefore: () => {
                        this.note.saving = true;
                        this.setEditable(false);
                    },
                    onFinish: (visit) => {
                        this.note.saving = false;
                        this.setEditable(true);
                        console.log(visit);
                    },
                    onSuccess: page => {
                        console.log(page);
                    },
                    onError: errors => {
                        console.log(errors);
                    }
                });
        },

        setEditable(editable) {
            this.editor.setOptions({
                editable: editable
            });
            this.editor.view.update(this.editor.view.props);
        }
    }

}
</script>
<style scoped>
.editor-buttons .is-active {
    @apply bg-blue-100;
    @apply fill-current;
    @apply text-blue-500;
}

.note-editor .ProseMirror[contenteditable="false"] {
    @apply animate-pulse;
}
</style>
