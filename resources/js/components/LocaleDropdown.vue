<template>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-light" href="#" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
    >
    <div class="d-flex align-items-center justify-content-between">
      <img :src="locales[locale] === 'EN' ? '/dist/assets/united-kingdom.svg' : '/dist/assets/indonesia.svg'" width="17.5"> <span class="ml-2">{{ locales[locale] }}</span>
    </div>
    </a>
    <div class="dropdown-menu bg-gradient-primary" style="min-width: 5rem;">
      <a v-for="(value, key) in locales" :key="key" class="dropdown-item text-light" href="#"
         @click.prevent="setLocale(key)"
      >
        <div class="d-flex align-items-center">
          <img :src="value === 'EN' ? '/dist/assets/united-kingdom.svg' : '/dist/assets/indonesia.svg'" width="17.5"><span class="ml-2">{{ value }}</span>
        </div>
      </a>
    </div>
  </li>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {
  name: 'LocaleDropdown',
  
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),

  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)

        this.$store.dispatch('lang/setLocale', { locale })
      }
    }
  }
}
</script>
