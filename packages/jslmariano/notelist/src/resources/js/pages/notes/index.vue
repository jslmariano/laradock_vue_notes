<template>
    <div class="row">
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
        <div class="container notes-container">
            <div class="row">
                <div class="col-sm-4 py-2" v-for="note in notes.notes" :key="note.id">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                [ {{ note.id }} ] - {{ note.title }}
                            </h5>
                            <p class="card-text">
                                {{ note.short_content }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary pull-left" role="button"
                                v-on:click="viewNote(note.id)"
                                >
                                <fa icon="eye" fixed-width />
                            </button>
                            <router-link class="btn btn-sm btn-info pull-left" role="button"
                                :to="{ name: 'note.edit', params: {id: note.id } }"
                                >
                                <fa icon="pencil-alt" fixed-width />
                            </router-link>
                            <button class="btn btn-sm btn-danger pull-left" role="button"
                                v-on:click="deleteNote(note.id)" >
                                <fa icon="trash-alt" fixed-width />
                            </button>
                            <br/>
                            <small class="text-muted">
                                Last updated 3 mins ago
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { mapState } from "vuex";

export default {
    middleware: "auth",
    computed: mapState(["notes"]),
    async created() {
        await this.$store.dispatch('notes/fetchNotes');
    },
    methods: {
        deleteNote: function(id) {
            if(confirm("Do you really want to delete?")){
                console.log('deleteNote', id);
                this.$store.dispatch("notes/deleteNote", id);
            }
        },
        editNote: function(id) {
            /** For future pop-up **/
            console.log('editNote', id);
        },
        viewNote: function(id) {
            /** For future pop-up **/
            console.log('viewNote', id);
        }
    }
};
</script>
