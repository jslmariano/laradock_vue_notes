<template>
    <div class="row">

        <!-- HEADER -->
        <div class="container">
            <div class="page-header">
                <router-link class="btn btn-primary pull-left" role="button" to="/note/create">
                    Create
                </router-link>
                <h3 class="text-center">
                    NOTES
                </h3>
            </div>
            <div class="alert alert-danger hide hidden" role="alert" style="display: none;">
                No results
            </div>
            <hr/>
        </div>
        <!-- HEADER -->

        <!-- LISTS -->
        <div class="container notes-container">
            <div class="row">
                <div class="col-sm-4 py-2" v-for="note in notes.notes" :key="note.id">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ note.title }}
                            </h5>
                            <p class="card-text">
                                {{ note.short_content }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted" >
                                Last updated {{ note.updated_ago }}
                            </small>
                            <br/>
                            <button class="btn btn-sm btn-primary pull-left" role="button"
                                v-on:click="viewNote(note.title, note.content, note.updated_ago)"
                                >
                                <fa icon="eye" fixed-width />
                            </button>
                            <router-link class="btn btn-sm btn-info pull-left" :disabled="user.id === note.created_user" role="button"
                                :to="{ name: 'note.edit', params: {id: note.id } }"
                                >
                                <fa icon="pencil-alt" fixed-width />
                            </router-link>
                            <button class="btn btn-sm btn-danger pull-left" role="button"
                                 :disabled="user.id === note.created_user" v-on:click="deleteNote(note.id)" >
                                <fa icon="trash-alt" fixed-width />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LISTS -->

    </div>
</template>
<script>
import axios from 'axios';
import { mapState, mapGetters } from "vuex";
import Swal from 'sweetalert2';
import i18n from '~/plugins/i18n';

export default {

    middleware: "auth",

    computed : {
        ...mapGetters({
          user: "auth/user",
        }),
        ...mapState(["notes"])
    },

    async created () {
        await this.$store.dispatch('notes/fetchNotes');
    },

    methods: {

        deleteNote : function(id) {
            if(confirm("Do you really want to delete?")){
                console.log('deleteNote', id);
                this.$store.dispatch("notes/deleteNote", id);
            }
        },

        editNote : function(id) {
            /** For future pop-up easy-edit **/
            console.log('editNote', id);
        },

        viewNote : function(title, content, updated_ago) {
            Swal.fire({
              title: title,
              text: content,
              reverseButtons: true,
              confirmButtonText: i18n.t('ok')
            })
        }
    }
};
</script>
