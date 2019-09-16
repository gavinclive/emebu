import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import Vuetify from 'vuetify'
import App from '~/components/App'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'

import '~/plugins'
import '~/components'
import 'vuetify/dist/vuetify.min.css'

Vue.config.productionTip = false
Vue.component('font-awesome-icon', FontAwesomeIcon)
library.add(fas)

Vue.use(Vuetify)

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
