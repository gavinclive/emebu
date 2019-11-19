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
    <v-btn v-if="user.role == 1">
      <span>{{ $t('history') }}</span>
      <v-img src="/dist/assets/file-text.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role == 1" @click="toEventsPage">
      <span>{{ $t('browse') }}</span>
      <v-img src="/dist/assets/compass.svg" class="white-svg main-navbar-icon" />
    </v-btn>

    <!-- Organizer Account -->
    <v-btn v-if="user.role > 2" @click="toEventsPage">
      <span>{{ $t('manage') }}</span>
      <v-img src="/dist/assets/tool.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role > 2" @click="toCreatePage">
      <span>{{ $t('create') }}</span>
      <v-img src="/dist/assets/plus-circle.svg" class="white-svg main-navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role !== 2" @click="toTransactionPage">
      <span>{{ $t('tickets') }}</span>
      <v-img src="/dist/assets/credit-card.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role === 2" @click="toUsersPage">
      <span>{{ $t('users') }}</span>
      <v-img src="/dist/assets/users.svg" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role === 2" @click="toManagePage">
      <span>{{ $t('events') }}</span>
      <v-img src="/dist/assets/emebu-mini.png" class="white-svg navbar-icon" />
    </v-btn>

    <v-btn v-if="user.role === 2" @click="toManagePage">
      <span>{{ $t('content') }}</span>
      <v-img src="/dist/assets/file-text.svg" class="white-svg navbar-icon" />
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
      if (routeName === 'home') {
        return 0
      } else if (routeName === 'm.settings') {
        if (this.user.role === 2) {
          return 3
        }
        return 4
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
    },

    toEventsPage () {
      this.$router.push({ name: 'event.view'})
    },

    toTransactionPage () {
      this.$router.push({ name: 'transaction.view' })
    },

    toUsersPage () {
      this.$router.push({ name: 'users.admin' })
    }
  }
}
</script>
