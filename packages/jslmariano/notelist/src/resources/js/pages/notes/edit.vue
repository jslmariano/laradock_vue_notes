<template>
    <div class="row">

        <!-- NAVIGATE BUTTON -->
        <div class="container">
            <div class="page-header">
                <router-link class="btn btn-primary pull-left" role="button" to="/notes">
                    Notes
                </router-link>
                <hr/>
            </div>
        </div>
        <!-- NAVIGATE BUTTON -->

        <!-- FORM -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <card title="Update Note">
                        <form @submit.prevent="update" @keydown="form.onKeydown($event)">

                            <!-- Email -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">Title</label>
                                <div class="col-md-7">
                                    <input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control" type="text" name="title" :disabled="loading == 1" />
                                    <small class="text-muted" >
                                        Max of 50 characters
                                    </small>
                                    <has-error :form="form" field="title" />
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">Content</label>
                                <div class="col-md-7">
                                    <textarea v-model="form.content" :class="{ 'is-invalid': form.errors.has('content') }" class="form-control" type="text" name="content" :disabled="loading == 1">
                                    </textarea>
                                    <small class="text-muted" >
                                        Max of 500 characters
                                    </small>
                                    <has-error :form="form" field="content" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-7 offset-md-3 d-flex">
                                    <!-- Submit Button -->
                                    <v-button :loading="form.busy">
                                        Update Note
                                    </v-button>
                                </div>
                            </div>

                        </form>
                    </card>
                </div>
            </div>
        </div>
        <!-- FORM -->

    </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from "vuex";

export default {

    metaInfo () {
        return { title: "Update Note" }
    },

    data: () => ({
        loading: 0,
        form: new Form({
          title: '',
          content: ''
        })
    }),

    mounted () {
        this.$loading = this.$refs.loading
    },

    computed: mapGetters({
        note: "notes/current_note"
    }),

    async created () {
        this.loading = 1;
        this.$router.app.$loading.start();
        // Fetch the note.
        await this.$store.dispatch('notes/fetchSingleNote', this.$route.params.id)

        // Fill the form with note data.
        this.form.keys().forEach(key => {
            this.form[key] = this.note[key];
        });
        this.loading = 0;
        this.$router.app.$loading.finish();
    },

    methods: {
        async update () {

            this.$router.app.$loading.start();
            // Submit the form.
            const { data } = await this.form.put(`/api/note/update/${this.$route.params.id}`)

            this.$router.app.$loading.finish();
            // Redirect notes.
            this.$router.push({ name: 'notes' })
        }
    }
}
</script>
