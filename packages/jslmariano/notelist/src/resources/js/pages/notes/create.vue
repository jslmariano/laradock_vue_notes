<template>
    <div class="row">
        <div class="col-lg-8 m-auto">
            <card title="Create Note">
                <form @submit.prevent="create" @keydown="form.onKeydown($event)">

                    <!-- Email -->
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-md-right">Title</label>
                        <div class="col-md-7">
                            <input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control" type="text" name="title">
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
                            <textarea v-model="form.content" :class="{ 'is-invalid': form.errors.has('content') }" class="form-control" type="text" name="content">
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
                                Create Note
                            </v-button>
                        </div>
                    </div>

                </form>
            </card>
        </div>
    </div>
</template>

<script>
import Form from 'vform'

export default {

  metaInfo () {
    return { title: "Create Note" }
  },

  data: () => ({
    form: new Form({
      title: '',
      content: ''
    })
  }),

  methods: {
    async create () {
      this.$router.app.$loading.start();

      // Submit the form.
      const { data } = await this.form.post('/api/note/store')

      this.$router.app.$loading.finish();
      // Redirect notes.
      this.$router.push({ name: 'notes' })
    }
  }
}
</script>
