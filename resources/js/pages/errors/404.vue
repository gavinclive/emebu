<template>
  <card class="text-center">
    <h3 class="mb-4">
      {{ $t('page_not_found') }}
    </h3>

    <div class="links">
      <router-link :to="{ name: user ? 'home' : 'welcome' }">
        {{ $t('go_home') }}
      </router-link>
    </div>
  </card>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  name: 'NotFound',

  computed: mapGetters ({
    user: 'auth/user'
  })
}
</script>
