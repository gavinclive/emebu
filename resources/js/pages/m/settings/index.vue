<template>
  <div>
    <v-card width="100%" height="14rem" class="settings-card bg-gradient-primary text-light">
      <v-card-title class="small pt-2 settings-title">
        {{ $t('my_account') }}
      </v-card-title>
      <v-card-text class="text-center pt-5">
        <img :src="user.photo_url" class="profile-photo" height="100" style="border-radius: .5rem;">
      </v-card-text>
       <div class="text-center text-light">
        <p class="mb-0 font-weight-bold medium">{{ user.name }}</p>
        <p class="mb-0 font-weight-light small">{{ user.email }}</p>
      </div>
    </v-card>
    <router-link :to="{ name: 'm.settings.profile' }" class="col-12 d-flex align-items-center text-dark border-bottom">
      <img src="/dist/assets/edit.svg" width="22" height="22" class="mr-2">
      {{ $t('edit_profile') }}
    </router-link>
    <router-link :to="{ name: 'm.settings.password' }" class="col-12 d-flex align-items-center text-dark border-bottom">
      <img src="/dist/assets/key.svg" width="22" height="22" class="mr-2">
      {{ $t('change_password') }}
    </router-link>
    <router-link :to="{ name: 'm.settings.atm' }" v-if="user.role === 1" class="col-12 d-flex align-items-center text-dark border-bottom">
      <img src="/dist/assets/dollar-sign.svg" width="22" height="22" class="mr-2">
      {{ $t('edit_atm') }}
    </router-link>
    <router-link to="/" class="col-12 d-flex align-items-center text-dark border-bottom">
      <img src="/dist/assets/help-circle.svg" width="22" height="22" class="mr-2">
      {{ $t('help') }}
    </router-link>
    <div class="col-12 d-flex align-items-center text-primary border-bottom" @click="logout">
      {{ $t('logout') }}
    </div>
    <div class="col-12"></div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',
  
  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')
      this.$router.push({ name: 'm.login' })
    }
  }
}
</script>