<template>
  <v-bottom-navigation
    v-if="user"
    :value="activeBtn"
    class="bottom-nav bg-gradient-primary"
    dark
    shift>
    <v-btn>
      <span>{{ $t('home') }}</span>
      <v-img src="/dist/assets/home.svg" class="white-svg navbar-icon" />
    </v-btn>
    
    <!-- Attendee Account -->
    <v-btn v-if="user.role === 2">
      <span>{{ $t('history') }}</span>
      <v-img src="/dist/assets/file-text.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role === 2">
      <span>{{ $t('browse') }}</span>
      <v-img src="/dist/assets/search.svg" class="white-svg main-navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role === 2">
      <span>{{ $t('tickets') }}</span>
      <v-img src="/dist/assets/tag.svg" class="white-svg navbar-icon" />
    </v-btn>

     <!-- Organizer Account -->
    <v-btn v-if="user.role === 1">
      <span>{{ $t('manage_event') }}</span>
      <v-img src="/dist/assets/tool.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role === 1">
      <span>{{ $t('create_event') }}</span>
      <v-img src="/dist/assets/plus-circle.svg" class="white-svg navbar-icon main-navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role === 1">
      <span>{{ $t('pending_tickets') }}</span>
      <v-img src="/dist/assets/credit-card.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn>
      <span>{{ $t('me') }}</span>
      <v-img :src="user.photo_url" class="navbar-icon rounded-circle profile-photo" width="24" height="24" />
    </v-btn>
  </v-bottom-navigation>
</template>

<script>
import { baseImageUrl } from '~/utils/constant'
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    activeBtn: 0
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
