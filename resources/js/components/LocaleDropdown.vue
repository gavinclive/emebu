<template>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-light" href="#" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
    >
      <span><img :src="locales[locale] === 'EN' ? '/dist/assets/united-kingdom.svg' : '/dist/assets/indonesia.svg'" width="17.5"></span> {{ locales[locale] }}
    </a>
    <div class="dropdown-menu bg-gradient-primary">
      <a v-for="(value, key) in locales" :key="key" class="dropdown-item text-light" href="#"
         @click.prevent="setLocale(key)"
      >
        <span><img :src="value === 'EN' ? '/dist/assets/united-kingdom.svg' : '/dist/assets/indonesia.svg'" width="17.5"></span> {{ value }}
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
