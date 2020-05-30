<template>
  <card :title="$t('home')">
    {{ $t('you_are_logged_in') }}
    <br/>
    <router-link class="btn btn-primary pull-left" to="/notes" role="button">
        Check out the notes!
    </router-link>
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
