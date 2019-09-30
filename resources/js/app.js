import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import Vuetify from 'vuetify'
import App from '~/components/App'
import * as VueGoogleMaps from 'vue2-google-maps'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import Datetime from 'vue-datetime'

import '~/plugins'
import '~/components'
import 'vuetify/dist/vuetify.min.css'
import 'vue-datetime/dist/vue-datetime.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css'
import '@mdi/font/css/materialdesignicons.css'
import objectToFormData from './utils/objectToFormData'

window.objectToFormData = objectToFormData
Vue.config.productionTip = false

Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker)
Vue.use(Vuetify)
Vue.use(Datetime)
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyAyhAP-kfAQ9xqD6jEhwnQPkAmxFSNIxZI',
    libraries: 'places'
  }
})

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  icons: {
    iconfont: 'mdi', // default - only for display purposes
  },
  ...App
})
