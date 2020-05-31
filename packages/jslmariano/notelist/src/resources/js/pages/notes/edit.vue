<template>
    <div>
        <h3 class="text-center">
            Edit Note
        </h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateNote">
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
                        Update Note
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                note: {}
            }
        },
        created() {
            axios
                .get(`http://localhost/api/note/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.note = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updateNote() {
                axios
                    .put(`http://localhost/api/note/update/${this.$route.params.id}`, this.note)
                    .then((response) => {
                        this.$router.push({name: 'notes'});
                    });
            }
        }
    }
</script>