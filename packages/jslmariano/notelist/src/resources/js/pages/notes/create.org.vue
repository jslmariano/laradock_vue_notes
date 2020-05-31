<template>
    <div class="row">
        <div class="container">
            <div class="page-header">
                <router-link class="btn btn-primary pull-left" role="button" to="/notes">
                    Notes
                </router-link>
                <h3 class="text-center">
                    Create Note
                </h3>
            </div>
            <div class="alert alert-danger hide hidden" role="alert" style="display: none;">
                No results
            </div>
            <hr/>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form @submit.prevent="addNote">
                        <div class="form-group">
                            <label>
                                Title
                            </label>
                            <input class="form-control" type="text" v-model="note.title">
                            </input>
                        </div>
                        <div class="form-group">
                            <label>
                                Content
                            </label>
                            <textarea class="form-control" v-model="note.content">
                            </textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Add Note
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            note: {}
        }
    },
    methods: {
        addNote() {
            this.$store.dispatch("notes/createNote", this.note);
            this.$router.push({name: 'notes'});
        },

    }
}
</script>