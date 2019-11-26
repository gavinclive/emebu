<template>
  <div class="col-12 col-md-6 p-0 d-flex flex-column justify-content-center">
    <div v-if="user.role == 2" class="col-12 text-center">
      {{ $t('you_are_logged_in') }}
    </div>
    <div v-if="user.role > 2" class="col-12">

    </div>
    <div v-if="user.role == 3" class="col-12 text-center">
      <v-divider />
      <img src="/dist/assets/smile.svg" width="60">
      <p>{{ $t('lets_premium') }}</p>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import store from '~/store'

export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },

  beforeRouteEnter (to, from, next) {
    if (store.getters['auth/user'].role === '2') next({ name: 'content.admin' })
    else next()
  },

  computed: {
    ...mapGetters ({
      user: 'auth/user'
    })
  }
}
</script>
