<template>
    <div>
        <h3 class="text-center">
            Add Note
        </h3>
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

                this.axios
                    .post('http://localhost/api/note/store', this.note)
                    .then(response => (
                        this.$router.push({name: 'notes'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>