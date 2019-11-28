<template>
  <div class="col-12 p-0 position-relative">
    <video autoplay loop class="video-background" muted plays-inline>
      <source src="https://www.videvo.net/videvo_files/converted/2016_01/preview/koncert.mp426536.webm" type="video/mp4">
    </video>
    <div class="welcome-detail col-9 col-xl-6 col-lg-7">
      <div class="top-left links">
        <template>
          <router-link :to="{ name: 'event.view' }">
            <span class="text-light">{{ $t('browse') }}</span>
          </router-link>
          <router-link :to="{ name: 'register' }">
            <span class="text-light">{{ $t('faq') }}</span>
          </router-link>
        </template>
      </div>

      <div class="top-right links">
        <template>
          <router-link :to="{ name: 'login' }">
            <span class="text-light">{{ $t('login') }}</span>
          </router-link>
          <router-link :to="{ name: 'register' }">
            <span class="text-light">{{ $t('register') }}</span>
          </router-link>
        </template>
      </div>

      <div class="text-center">
        <div class="title mb-4">
          {{ title }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { md } from '~/utils/mobileDetect'
import store from '~/store'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),

  beforeRouteEnter (to, from, next) {
    if (store.getters['auth/check']) {
      next({ name: 'home' })
    } else if (md.mobile()) {
      next({ name: 'm.login' })
    } else {
      next()
    }
  },

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 20%;
}

.top-left {
  position: absolute;
  left: 10px;
  top: 20%;
}

.title {
  font-size: 85px;
}

.video-background {
  position: relative;
  top: 0;
  left: 0;
  width: 100%;
  filter: blur(5px);
  transform: scale(1.03);
}

@media (max-width: 1660px) {
  .video-background {
    position: relative;
    top: 0;
    left: 0;
    height: 100vh;
    width: auto;
    filter: blur(5px);
    transform: scale(1.03);
    object-position: center;
  }
}

.welcome-detail {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-size: 2.75rem;
}
</style>
