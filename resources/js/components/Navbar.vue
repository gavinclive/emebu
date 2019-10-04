<template>
  <nav v-if="!inRoute" class="navbar navbar-expand-lg navbar-light bg-gradient-primary">
    <div class="container">
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
        <v-img src="/dist/assets/emebu-logo.svg" class="white-svg" max-width="100" contain />
      </router-link>
      <div class="hide collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link :to="{ name: 'event.view' }" class="nav-link text-light">
              {{ $t('manage') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'event.input' }" class="nav-link text-light">
              {{ $t('create') }}
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/" class="nav-link text-light">
              {{ $t('tickets') }}
            </router-link>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link text-light"
               href="#" role="button" data-toggle="dropdown"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
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
import { md } from '~/utils/mobileDetect'

export default {
  components: {
    LocaleDropdown
  },

  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),

    inRoute () {
      const currentRoute = this.$route.name
        switch(currentRoute) {
          case 'm.settings':
            return true
            break
        }
      return false
    }
  },

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

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
