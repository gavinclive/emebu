<template>
  <v-bottom-navigation
    v-if="user && inMenus"
    :value="activeBtn"
    class="bottom-nav bg-gradient-primary"
    dark
    shift>
    <v-btn @click="toHomePage">
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
      <v-img src="/dist/assets/compass.svg" class="white-svg main-navbar-icon" />
    </v-btn>

    <!-- Organizer Account -->
    <v-btn v-if="user.role === 1">
      <span>{{ $t('manage') }}</span>
      <v-img src="/dist/assets/tool.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role === 1" @click="toCreatePage">
      <span>{{ $t('create') }}</span>
      <v-img src="/dist/assets/plus-circle.svg" class="white-svg main-navbar-icon" />
    </v-btn>

    <v-btn>
      <span>{{ $t('tickets') }}</span>
      <v-img src="/dist/assets/credit-card.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn @click="toSettingPage">
      <span>{{ $t('me') }}</span>
      <v-img src="/dist/assets/user.svg" class="white-svg navbar-icon" />
    </v-btn>
  </v-bottom-navigation>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),

    activeBtn () {
      const routeName = this.$route.name
      switch (routeName) {
      case 'home':
        return 0
        break
      case 'm.settings':
        return 4
        break
      }
    },

    inMenus () {
      const routeName = this.$route.name
      return routeName === 'm.settings' || routeName === 'home'
    }
  },

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },

    toHomePage () {
      this.$router.push({ name: 'home' })
    },

    toSettingPage () {
      this.$router.push({ name: 'm.settings' })
    },

    toCreatePage () {
      this.$router.push({ name: 'm.event.input' })
    }
  }
}
</script>
