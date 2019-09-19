<template>
  <div class="row">
    <div class="col-md-3 d-none d-md-block pl-0">
      <div class="list-group" role="tablist">
        <router-link :to="{name: 'settings.profile'}">
          <div class="list-group-item list-group-item-action" :class="{'active': routeName === 'settings.profile'}" data-toggle="list" role="tab">{{ $t('edit_profile') }}</div>
        </router-link>
        <router-link :to="{name: 'settings.password'}">
          <div class="list-group-item list-group-item-action" :class="{'active': routeName === 'settings.password'}" data-toggle="list" role="tab">{{ $t('change_password') }}</div>
        </router-link>
        <router-link v-if="user.role === 1" :to="{name: 'settings.atm'}">
          <div class="list-group-item list-group-item-action" :class="{'active': routeName === 'settings.atm'}" data-toggle="list" role="tab">{{ $t('edit_atm') }}</div>
        </router-link>
      </div>
    </div>

    <div class="col-md-9 col-xs-12 pr-0">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  middleware: 'auth',

  computed: {
    routeName () {
      return this.$route.name
    },
    tabs () {
      return [
        {
          icon: 'user',
          name: this.$t('profile'),
          route: 'settings.profile'
        },
        {
          icon: 'lock',
          name: this.$t('password'),
          route: 'settings.password'
        }
      ]
    },
    ...mapGetters ({
      user: 'auth/user'
    })
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
