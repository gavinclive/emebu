import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import Vuetify from 'vuetify'
import App from '~/components/App'

import '~/plugins'
import '~/components'
import 'vuetify/dist/vuetify.min.css'

Vue.config.productionTip = false

Vue.use(Vuetify)

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
