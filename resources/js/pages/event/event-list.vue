<template>
  <div>
    <div class="row col-12 mx-0 pt-0 px-2">
      <div class="input-group pb-2 px-0 px-md-1" :class="{ 'col-md-6': user && user.role > 2, 'col-12': !user || user.role === '1', 'pt-2': user && user.role === '2' }">
        <input v-model="searchTitle" class="form-control">
        <div class="input-group-append">
          <span class="input-group-text"><img src="/dist/assets/search.svg"></span>
        </div>
      </div>
      <div v-if="user && user.role > 2" class="input-group col-md-6 pb-2 px-0 px-md-1" @click="showStatusModal">
        <input disabled v-model="activeStatus" class="form-control">
        <div class="input-group-append">
          <span class="input-group-text"><img src="/dist/assets/grid.svg"></span>
        </div>
      </div>
      <div v-if="!user || user.role === '1'" class="input-group col-6 pb-2 pr-1 pl-1" @click="showTypeModal">
        <input disabled v-model="activeType" class="form-control">
        <div class="input-group-append">
          <span class="input-group-text">{{ $t('type') }}</span>
        </div>
      </div>
      <div v-if="!user || user.role === '1'" class="input-group col-6 pb-2 pl-1 pr-1" @click="showCategoryModal">
        <input disabled v-model="activeCategory" class="form-control">
        <div class="input-group-append">
          <span class="input-group-text">{{ $t('category') }}</span>
        </div>
      </div>
    </div>
    <div class="row col-12 mx-0 py-0 px-1">
      <EventCard v-for="(event, index) in filteredList" :key="index" 
        :id="encrypt(event.id)"
        :title="event.title"
        :image="event.image"
        :date="event.start_time"
        :end="event.end_time"
        :sold="event.sold"
        :total="event.total"
        :status="event.status"
        :deleted="event.deleted_at !== null"
        @showShareModal="shareEvent"
        @showCancelModal="cancelEvent"
        @showCouponModal="inputCoupon(index)"
        @showHideModal="hideEvent"
        @refreshList="refreshEvent"
        @showAnalyticsModal="analEvent"
        />
    </div>
    <div class="modal fade" id="eventType" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">{{ $t('type') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap">
            <div class="position-relative text-center" v-for="(type, index) in types" :key="index">
              <div class="modal-icon-container m-1 rounded-lg" width="140" height="140" data-dismiss="modal" @click="setType(index)">
                <v-img class="modal-icon" :src="type.image" width="140" height="140" cover></v-img>
                <span class="position-absolute modal-icon-name">{{ type.name }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="eventCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">{{ $t('category') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap">
            <div class="position-relative text-center" v-for="(category, index) in categories" :key="index">
              <div class="modal-icon-container m-1 rounded-lg" width="140" height="140" data-dismiss="modal" @click="setCategory(index)">
                <v-img class="modal-icon" :src="category.image" width="140" height="140" cover></v-img>
                <span class="position-absolute modal-icon-name">{{ category.name }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="shareEvent" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t('share_event') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap">
            <v-img src="/dist/assets/facebook.svg" height="25" width="25" contain @click="shareUrl('fb')"></v-img>
            <v-img src="/dist/assets/twitter.svg" height="25" width="25" contain @click="shareUrl('twit')"></v-img>
            <v-img src="/dist/assets/linkedin.svg" height="25" width="25" contain @click="shareUrl('in')"></v-img>
            <v-img src="/dist/assets/mail.svg" height="25" width="25" contain @click="shareUrl('email')"></v-img>
            <v-img src="/dist/assets/clipboard.svg" height="25" width="25" contain @click="shareUrl('')"></v-img>
          </div>
          <div class="d-flex input-group col-12 justify-content-center">
            <input readonly id="eventUrl" v-model="eventUrl" class="form-control">
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="cancelEvent" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t('cancel_event') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap text-justify">
            {{ $t('cancel_event_guide') }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="handleCancelEvent" data-dismiss="modal">{{ $t('confirm') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="hideEvent" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t('hide_event') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap text-justify">
            {{ $t('hide_event_guide') }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="handleHideEvent" data-dismiss="modal">{{ $t('confirm') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="eventStatus" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t('status') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap text-justify">
            <div v-for="(status, index) in statuses" :key="index" class="col-12 p-0 my-1" data-dismiss="modal" @click="setStatus(index)">
              <div class="col-12 py-1 rounded-lg" :class="{ 'bg-primary text-light': index == searchStatus, 'bg-light': index != searchStatus }">
                {{ status }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="eventAnalytics" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t('event_analytics') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div v-if="!analytics" class="text-center">
              <img src="/dist/assets/frown.svg" width="60">
              <p>{{ $t('no_analytics') }}</p>
            </div>
            <div v-else>
              <p>{{ $t('views') + analytics.view }}</p>
              <p>{{ $t('first_viewed') + dateFormat(new Date(analytics.created_at), 'dd, DD MMM YYYY @ hh.mm') }}</p>
              <p>{{ $t('last_viewed') + dateFormat(new Date(analytics.updated_at), 'dd, DD MMM YYYY @ hh.mm') }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <form @submit.prevent="coupon" @keydown="form.onKeydown($event)">
      <div class="modal fade" id="inputCoupon" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ $t('coupon') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body d-flex justify-content-center flex-wrap text-justify">
              <div class="col-12 form-group py-1 px-0 my-0">
                <label>{{ $t('coupon_code') }}</label>
                <input class="form-control col-12 mx-auto" type="text" maxlength="10" oninput="this.value = this.value.toUpperCase()" v-model="form.code" :disabled="form.id != 0" required>
              </div>
              <div class="col-12 form-group py-1 px-0 my-0">
                <label>{{ $t('quantity') }}</label>
                <input class="form-control col-12 mx-auto" type="number" required min="1" v-model="form.qty">
              </div>
              <div class="col-12 form-group px-0 py-1 my-0">
                <label>{{ $t('starts') }}</label>
                <datetime type="datetime" :week-start="1" :minute-step="30" class="form-control theme-blue mx-auto" v-model="form.start_time" required></datetime>
              </div>
              <div class="col-12 form-group px-0 py-1 my-0">
                <label>{{ $t('ends') }}</label>
                <datetime type="datetime" :week-start="1" :minute-step="30" class="form-control theme-blue mx-auto" v-model="form.end_time" required></datetime>
              </div>
              <div class="col-12 form-group py-1 px-0 my-0">
                <input type="checkbox" v-model="form.daily_reset">
                <label>{{ $t('daily_reset') }}</label>
              </div>
              <div class="col-12 row py-1 px-0 my-0">
                <div class="col-6 form-group pr-1 pl-0 py-0 my-0">
                  <label>{{ $t('discount_rate') }}</label>
                  <div class="input-group">
                    <input type="number" class="form-control" min="1" max="100" v-model="form.rate" :disabled="form.id != 0" required>
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>
                <div class="col-6 form-group pr-0 pl-1 py-0 my-0">
                  <label>{{ $t('max_cut') }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" step="1000" v-model="form.max_cut" :disabled="form.id != 0" required>
                  </div>
                  <small>{{ $t('coupon_guide') }}</small>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <v-button :loading="form.busy" :type="form.id ? 'primary' : 'success'">
                {{ form.id ? $t('save') : $t('create') }}
              </v-button>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import $ from 'jquery'
import store from '~/store'
import { baseEventUrl } from '~/utils/url'
import { encrypt, decrypt } from '~/utils/simpleCrypto'
import Form from 'vform'
import axios from 'axios'
import { dateFormat } from '~/utils/dateFormat'
import router from '~/router'

export default {
  metaInfo () {
    return { title: this.$t('events') }
  },

  data: () => ({
    searchTitle:'',
    searchStatus: 0,
    searchLocation: '',
    id: '',
    eventUrl: '',
    type: '',
    category: '',
    form: new Form({
      id: 0,
      code: '',
      qty: '',
      daily_reset: '',
      start_time: '',
      end_time: '',
      rate: '',
      max_cut: '',
      event_id: ''
    }),
    isHistory: '',
  }),

  beforeRouteEnter (to, from, next) {
    if (store.getters['auth/user'] && parseInt(store.getters['auth/user'].role) > 1) {
      store.dispatch('event/fetchEventsByParams', {
        id: store.getters['auth/user'].id,
        role: store.getters['auth/user'].role
      })
      .then( () => next( vm => vm.setSoldCount()))
    } else {
      store.dispatch('event/fetchEvents')
      .then( () => next( vm => vm.setSoldCount()))
    }
  },

  mounted () {
    store.dispatch('category/fetchCategories')
    store.dispatch('type/fetchTypes')
  },
  
  computed: {
    ...mapGetters ({
      events: 'event/events',
      categories: 'category/getCategories',
      types: 'type/getTypes',
      user: 'auth/user',
      analytics: 'event/analytics'
    }),

    filteredList () {
      let list = this.events.filter(data => {
        return data.title.toLowerCase().includes(this.searchTitle.toLowerCase())
      })

      if(this.type) {
        list = list.filter(data => {
          return data.type_id === this.type
        })
      }

      if(this.category) {
        list = list.filter(data => {
          return data.category_id === this.category
        })
      }

      if (this.searchStatus !== 0) {
        if(this.searchStatus === 3 ) {
          return list.filter(data => {
            return new Date(data.end_time) < new Date()
          })
        } else if (this.searchStatus === 4) {
          return list.filter(data => {
            return data.deleted_at !== null
          })
        } else {
          return list.filter(data => {
            return data.status.includes(this.searchStatus)
          })
        }
      }

      return list
    },

    activeType () {
      return this.type !== '' ? this.types[this.type].name : ''
    },

    activeCategory () {
      return this.category !== '' ? this.categories[this.category].name : ''
    },

    activeStatus () {
      if (this.searchStatus == 0) return this.$i18n.t('all')
      else if (this.searchStatus == 1) return this.$i18n.t('published')
      else if (this.searchStatus == 2) return this.$i18n.t('under_investigation')
      else if (this.searchStatus == 3) return this.$i18n.t('past')
      else return this.$i18n.t('cancelled')
    },

    statuses () {
      return [
        this.$i18n.t('all'),
        this.$i18n.t('published'),
        this.$i18n.t('under_investigation'),
        this.$i18n.t('past'),
        this.$i18n.t('cancelled')
      ]
    }
  },

  methods: {
    shareEvent (id) {
      $('#shareEvent').modal('show')
      this.id = id
      this.eventUrl = baseEventUrl(id)
    },

    shareUrl (platform) {
      if (platform.includes('fb')) {
        window.location.href = `https://www.facebook.com/sharer/sharer.php?u=${baseEventUrl(this.id)}`
      } else if (platform.includes('twit')) {
        window.location.href = `https://twitter.com/intent/tweet?text=${baseEventUrl(this.id)}`
      } else if (platform.includes('email')) {
        window.location.href = `mailto:?subject=Check%20out%20this%20cool%20Event&body=${baseEventUrl(this.id)}`
      } else if (platform.includes('in')) {
        window.location.href = `https://www.linkedin.com/shareArticle?mini=true&url=${baseEventUrl(this.id)}&title=&summary=&source=`
      } else {
        const copyText = document.getElementById('eventUrl')
        copyText.select()
        copyText.setSelectionRange(0, 99999)
        document.execCommand('copy')
      }
    },

    inputCoupon (id) {
      $('#inputCoupon').modal('show')

      if(this.events[id].coupon) {
        this.form.keys().forEach( key => this.form[key] = this.events[id].coupon[key])
        this.form.start_time = new Date(this.form.start_time).toISOString()
        this.form.end_time = new Date(this.form.end_time).toISOString()
      } else {
        this.form.keys().forEach( key => {
          if(key != 'id' || key != 'event_id') this.form[key] = ''
        })
        this.form.event_id = this.events[id].id
      }
    },

    encrypt,

    hideEvent (id) {
      $('#hideEvent').modal('show')
      this.id = id
    },

    showTypeModal () {
      $('#eventType').modal('show')
    },

    showCategoryModal () {
      $('#eventCategory').modal('show')
    },

    showStatusModal () {
      $('#eventStatus').modal('show')
    },

    setType (index) {
      this.type = index
    },

    setCategory (index) {
      this.category = index
    },

    setStatus (index) {
      this.searchStatus = index
    },

    cancelEvent (id) {
      $('#cancelEvent').modal('show')
      this.id = id
    },

    handleCancelEvent () {
      store.dispatch('event/removeEvent', decrypt(this.id))
        .then(() => router.go())
    },

    handleHideEvent () {
      axios.post('/api/hide-event', {
        id: decrypt(this.id)
      })
        .then(() => router.go(0))
    },

    setSoldCount () {
      this.events.forEach( evt => {
        let total = 0
        let sold = 0
        evt.ticket.forEach( t => {
          total += t.qty
          sold += t.sold
        })
        evt.total = total.toString()
        evt.sold = sold.toString()
      })
    },

    coupon() {
      if(this.form.id) {
        this.form.patch(`/api/coupon/${this.form.id}`)
        .then(() => {
          $('#inputCoupon').modal('hide')
          this.form.reset()
        })
      } else {
        this.form.post('/api/coupon')
        .then(() => {
          $('#inputCoupon').modal('hide')
          this.form.reset()
        })
      }
    },

    refreshEvent() {
      store.dispatch('event/fetchEventsByParams', {
        id: store.getters['auth/user'].id,
        role: store.getters['auth/user'].role
      })
    },

    analEvent(id) {
      store.dispatch('event/fetchAnalytics', decrypt(id))
      .then( () => $('#eventAnalytics').modal('show'))
    },

    dateFormat
  }
}
</script>
