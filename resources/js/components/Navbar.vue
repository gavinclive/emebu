<template>
  <nav v-if="!inSettings" class="navbar navbar-expand-lg navbar-light bg-gradient-primary">
    <div class="container">
      <div class="side-menu d-md-none">
        <v-img v-if="inEoHome" src="/dist/assets/camera.svg" class="white-svg" height="28" width="28" cover @click="handleCamera"/>
        <v-img v-if="inNavigations" src="/dist/assets/arrow-left.svg" class="white-svg" height="28" width="28" cover @click="handleBack"/>
      </div>
      <div class="other-side-menu d-md-none">
        <v-img v-if="inEventDetail" src="/dist/assets/alert-octagon.svg" class="white-svg" height="28" width="28" cover @click="handleReport" />
      </div>
      <div class="mx-auto mx-md-0">
        <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
          <v-img src="/dist/assets/emebu-logo.svg" class="white-svg" max-width="100" contain />
        </router-link>
        </div>
        <div class="hide collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item" v-if="user && user.role == 1">
              <router-link :to="{ name: 'event.view' }" class="nav-link text-light">
                {{ $t('browse') }}
              </router-link>
            </li>
            <li class="nav-item" v-if="user && user.role == 1">
              <router-link :to="{ name: 'transaction.history' }" class="nav-link text-light">
                {{ $t('history') }}
              </router-link>
            </li>
            <li class="nav-item" v-if="user && user.role > 2">
              <router-link :to="{ name: 'event.input' }" class="nav-link text-light">
                {{ $t('create') }}
              </router-link>
            </li>
            <li class="nav-item" v-if="user && user.role > 2">
              <router-link :to="{ name: 'event.view' }" class="nav-link text-light">
                {{ $t('manage') }}
              </router-link>
            </li>
            <li class="nav-item" v-if="user && user.role !== 2">
              <router-link :to="{ name: 'transaction.view' }" class="nav-link text-light">
                {{ $t('tickets') }}
              </router-link>
            </li>
            <li class="nav-item" v-if="user && user.role == 2">
              <router-link :to="{ name: 'users.admin' }" class="nav-link text-light">
                {{ $t('users') }}
              </router-link>
            </li>
            <li class="nav-item" v-if="user && user.role == 2">
              <router-link :to="{ name: 'events.admin' }" class="nav-link text-light">
                {{ $t('events') }}
              </router-link>
            </li>
            <li class="nav-item" v-if="user && user.role == 2">
              <router-link :to="{ name: 'report.view' }" class="nav-link text-light">
                {{ $t('report') }}
              </router-link>
            </li>
            <li class="nav-item" v-if="!user || user.role != 2">
              <router-link :to="{ name: 'faq' }" class="nav-link text-light">
                {{ $t('faq') }}
              </router-link>
            </li>
          </ul>

          <ul class="navbar-nav ml-auto">
            <!-- Authenticated -->
            <li v-if="user" class="nav-item dropdown">
              <a class="nav-link text-light"
                href="#" role="button" data-toggle="dropdown"
              >
                <img v-if="user.photo_url" :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              </a>
              <div class="dropdown-custom dropdown-menu bg-gradient-primary">
                <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3 text-light d-flex align-items-center">
                  <v-img src="/dist/assets/settings.svg" max-width="15" max-height="15" contain class="white-svg mr-3"/>
                  {{ $t('settings') }}
                </router-link>
                <a href="#" class="dropdown-item pl-3 text-light d-flex align-items-center" @click.prevent="logout">
                  <v-img src="/dist/assets/log-out.svg" max-width="15" max-height="15" contain class="white-svg mr-3"/>
                  {{ $t('logout') }}
                </a>
              </div>
            </li>
            <!-- Guest -->
            <template v-else>
              <li class="nav-item">
                <router-link :to="{ name: 'login' }" class="nav-link text-light" active-class="active">
                  {{ $t('login') }}
                </router-link>
              </li>
              <li class="nav-item">
                <router-link :to="{ name: 'register' }" class="nav-link text-light" active-class="active">
                  {{ $t('register') }}
                </router-link>
              </li>
            </template>
            <locale-dropdown />
          </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import LocaleDropdown from './LocaleDropdown'
import { mapGetters } from 'vuex'

export default {
  components: {
    LocaleDropdown
  },

  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),

    inSettings () {
      const currentRoute = this.$route.name ? this.$route.name : ''
      return currentRoute.includes('m.settings.index') || currentRoute.includes('download')
    },

    inEoHome () {
      const currentRoute = this.$route.name ? this.$route.name : ''
      if ((currentRoute.includes('home')) && this.user.role > 2) return true
      return false
    },

    inNavigations () {
      const currentRoute = this.$route.name ? this.$route.name : ''
      if (currentRoute.includes('home')  || currentRoute.includes('content.admin') || currentRoute.includes('login')) return false
      return true
    },

    inEventDetail () {
      const currentRoute = this.$route.name ? this.$route.name : ''
      if (currentRoute.includes('event.detail') && this.user && this.user.role === '1') return true
      return false
    }
  },

  methods: {
    handleBack () {
      this.$router.go(-1)
    },

    handleCamera () {
      this.$router.push({ name: 'camera' })
    },

    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },

    handleReport () {
      this.$emit('showReportModal')
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}

.side-menu {
  position: absolute;
}

.other-side-menu {
  position: absolute;
  right: 0;
}

.container {
  position: relative;
}
</style>
