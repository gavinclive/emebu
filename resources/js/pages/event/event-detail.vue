<template>
  <div class="event-detail main-layout col-12 p-0 mt-2 mt-md-3">
    <div class="event-heading col-12 col-md-10 mx-auto p-0" >
      <v-img class="event-image col-12 rounded-lg" :src="eventImageUrl(event.image)" />
      <div class="share-btn bg-primary p-2 rounded-circle" @click="shareEvent">
        <img src='/dist/assets/share-2.svg' height="28" class="white-svg mx-auto">
      </div>
      <div class="event-info col-12 p-0 border-top-0 border-md-primary row m-0">
        <div class="col-sm-6 col-12 p-0">
          <div class="event-name col-12 pb-0">
            <h4>{{ event.title }}</h4>
          </div>
          <div class="col-12 event-type-cate pt-0 text-primary">
            {{ eventType }}, {{ eventCategory }}
          </div>
        </div>
        <div class="col-md-6 d-none d-md-flex flex-row-reverse">
          <div class="col-6 p-0 mx-2">
            <button v-if="!authenticated" class="btn col-12 btn-primary" @click="handleUnregistered()">Register to get Ticket</button>
            <button v-else type="button" class="btn col-12 btn-primary" data-toggle="modal" data-target="#getTicket">{{ $t('get_ticket') }}</button>
            
            <p class="mb-0 text-right" v-if="startFrom != 0 && startFrom != -1">{{ $t('starts_from') }} Rp {{ startFrom }}</p>
          </div>
        </div>
        <div class="col-12 event-summary pt-0 font-weight-lighter text-justify">
          {{ event.summary }}
        </div>
        <div class="col-12 py-0"><v-divider class="my-0"/></div>
        <div class="row px-3">
          <div class="col-12 col-md-4">
            <span class="font-weight-bold">{{ $t('organized_by') }}</span>
            <div class="mt-2 d-flex">
              <img :src="event.eo.image" height="24" contain class="rounded-circle">
              <span class="ml-1">{{ event.eo.name }}</span>
            </div>
          </div>
          <div class="col-12 col-md-4 px-md-0">
            <span class="font-weight-bold">{{ $t('date_n_time') }}</span>
            <div class="d-flex flex-align-center mt-2">
              <img src="/dist/assets/play-circle.svg" width="20">
              <span class="px-2">{{ eventStart }}</span>
            </div>
            <div class="d-flex flex-align-center mt-2">
              <img src="/dist/assets/stop-circle.svg" width="20">
              <span class="px-2">{{ eventEnd }}</span>
            </div>
          </div>
          <div class="col-12 col-md-4">
            <span class="font-weight-bold">{{ $t('location') }}</span>
            <div class="d-flex flex-align-center mt-2">
              <img src="/dist/assets/map-pin.svg" width="20">
              <span class="px-2">{{ venue }}</span>
            </div>
            <span class="px-2">{{ event.location_guide }}</span>
          </div>
          <div class="col-12 p-2 d-flex justify-content-around">
            <div class="d-flex justify-content-center"  @click="showMap = !showMap">
              <img :src="showMap ? '/dist/assets/chevron-up.svg' : '/dist/assets/chevron-down.svg'" width="16">
              <span class="pl-2">{{ $t('see_map') }}</span>
            </div>
            <div v-if="event.image_3d" class="d-flex justify-content-center"  @click="showPanorama = !showPanorama">
              <img :src="showPanorama ? '/dist/assets/chevron-up.svg' : '/dist/assets/chevron-down.svg'" width="16">
              <span class="pl-2">{{ $t('see_3d') }}</span>
            </div>
          </div>
          <div class="col-12 p-0" v-if="showMap">
            <GmapMap
              class="mx-auto col-12 px-0 overflow-none"
              :center="latLng"
              :zoom="13"
              style="width: 100%; height: 300px"
              :options="{
                streetViewControl: false,
                mapTypeControl: false,
                fullscreenControl: false,
                zoomControl: false
              }"
            >
              <GmapMarker
                :position="marker.position"
                :clickable="true"
                :draggable="false"
              />
            </GmapMap>
            <div class="col-12 d-flex justify-content-center" @click="navigateUrl">
              <img src="/dist/assets/navigation.svg" width="16">
              <span class="pl-2">{{ $t('direction') }}</span>
            </div>
          </div>
          <Panorama :source="eventImageUrl(event.image_3d)"
            v-if="showPanorama"
            :caption="event.title"
            style="background-size: cover; min-height: 500px; height: 500px;" />
        </div>
      </div>
    </div>
    <div class="col-12 col-md-10 mx-auto py-0"><v-divider class="my-0"/></div>
    <div class="col-12 col-md-10 mx-auto d-flex justify-content-center">
      <star-rating
        v-if="ratingScore !== 'NaN'"
        v-model="ratingScore"
        active-color="#258efe"
        :read-only="true"
        :round-start-rating="false"
        :rounded-corners="true"
        text-class="rating-score"
        :star-size="40" />
    </div>
    <div v-if ="ratingScore !== 'NaN'" class="col-12 col-md-10 mx-auto py-0"><v-divider class="my-0"/></div>
    <div class="col-12 col-md-10 overflow-hidden event-desc mx-auto mb-5 pb-5" v-html="event.description" />
    <div class="col-12 fixed-bottom bg-light d-md-none" style="box-shadow: 0px -1px 6px 2px rgba(158,158,158,1);">
      <p class="mb-1 text-center" v-if="startFrom !== -2">{{ $t('starts_from') }} Rp {{ startFrom }}</p>
      <button :disabled="startFrom === -2" type="button" class="btn col-12 btn-primary" data-toggle="modal" :data-target="authenticated ? '#getTicket' : ''">{{ $t('get_ticket') }}</button>
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
    
    <div class="modal fade" id="getTicket" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content" style="height: 100vh;">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t('get_ticket') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap">
            <div class="col-12 p-0 text-center">
              <v-card v-for="(ticket, index) in tickets" :key="index" class="ticket mb-2" :class="{'ticket-selected': activeTicket == index}" @click="selectTicket(index)">
                <v-card-title>{{ ticket.name }}</v-card-title>
                <v-card-text>
                  <p class="text-left">{{ ticket.description }}</p>
                  <h5 class="d-flex justify-content-between align-items-end"><small class="text-left m-0">{{ ticket.qty - ticket.sold + ' ' + $t('remaining') }}</small> <span class="text-right m-0">{{ ticket.price == 0 ? 'FREE' : 'Rp ' + currencyFormat(ticket.price) }}</span></h5>
                </v-card-text>
              </v-card>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" :disabled="!authenticated || authenticated.role > 1" class="btn btn-primary" data-dismiss="modal" @click="buyTicket">{{ $t('buy') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="giveRating" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Give Rating</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap">
            <p>{{ $t('give_rating_guide') }}</p>
            <star-rating
              v-model="rating"
              active-color="#258efe"
              :show-rating="false"
              :rounded-corners="true"
              :star-size="40" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="submitRating">{{ $t('submit') }}</button>
          </div>
        </div>
      </div>
    </div>

    <div v-if="authenticated && authenticated.role === '1'" class="bg-primary rounded-circle d-none d-md-block position-fixed p-2" style="bottom: 1rem; right: 1rem;" @click="reportEvent">
      <img src="/dist/assets/alert-octagon.svg" class="white-svg" height="28" width="28">
    </div>

    <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t('report_event') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{ $t('report_guide') }}
            <input class="form-control" v-model="report" :placeholder="$t('report_placeholder')">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="handleReport">{{ $t('report') }}</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import store from '~/store'
import router from '~/router'
import axios from 'axios'
import $ from 'jquery'
import { dateFormat } from '~/utils/dateFormat'
import { currencyFormat } from '~/utils/currencyFormat'
import Panorama from 'vuejs-panorama'
import { encrypt, decrypt } from '~/utils/simpleCrypto'
import { eventImageUrl } from '~/utils/image'
import StarRating from 'vue-star-rating'

export default {
  components: {
    Panorama,
    StarRating
  },

  data: () => ({
    activeTicket: -1,
    latLng: { lat:0, lng:0 },
    showMap: false,
    showPanorama: false,
    addressData: '',
    rating: 0,
    report: ''
  }),

  beforeRouteEnter (to, from, next) {
    if (store.getters['auth/user']) {
      store.dispatch('event/fetchEventById', decrypt(to.params.id))
        .then(() => store.dispatch('category/fetchCategories'))
        .then(() => store.dispatch('type/fetchTypes'))
        .then(() => store.dispatch('rating/fetchRatingStatus', {
          event: parseInt(decrypt(to.params.id)),
          member: store.getters['auth/user'].id
        }))
        .then(() => next(vm => vm.handleGiveRating()))
    } else {
      store.dispatch('event/fetchEventById', decrypt(to.params.id))
        .then(() => store.dispatch('category/fetchCategories'))
        .then(() => store.dispatch('type/fetchTypes'))
        .then(() => next())
    }
  },

  mounted () {
    this.reverseGeocode()
  },

  computed: {
    ...mapGetters({
      categories: 'category/getCategories',
      types: 'type/getTypes',
      eventDetail: 'event/eventDetail',
      authenticated: 'auth/user',
      ratingStatus: 'rating/ratingStatus',
      ratingDetail: 'rating/ratingDetail'
    }),

    event () {
      return this.eventDetail[0]
    },

    tickets () {
      return this.eventDetail[0].ticket.filter(e => new Date(e.start_time) <= new Date())
    },

    eventType () {
      return this.types[this.event.type_id-1].name
    },

    eventCategory () {
      return this.categories[this.event.category_id-1].name
    },

    eventStart () {
      return dateFormat(new Date(this.event.start_time), 'ddd, DD MMMM YYYY @ hh.mm')
    },

    eventEnd () {
      return dateFormat(new Date(this.event.end_time), 'ddd, DD MMMM YYYY @ hh.mm')
    },

    venue () {
      return this.addressData ? this.addressData.formatted_address : 'Error'
    },

    marker () {
      return {
        position: this.latLng,
        opacity: 1,
        draggable: true,
        enabled: true,
        dragended: 0
      }
    },

    startFrom () {
      if (this.tickets.length === 0) {
        return -2
      } else {
        const prices = []
        let allFree = true
        this.tickets.forEach(ticket => {
          prices.push(ticket.price)
          allFree = allFree ? ticket.price == 0 : false
        })
        return allFree ? -1 : currencyFormat(Math.min(...prices))
      }
    },

    eventUrl () {
      return window.location.href
    },

    ratingScore () {
      const score = this.ratingDetail
      return parseFloat(score).toFixed(2)
    }
  },

  methods: {
    async reverseGeocode () {
      const latLng = this.event.location.split(', ')
      this.latLng = {
        lat: parseFloat(latLng[0]),
        lng: parseFloat(latLng[1])
      }
      axios.get(`https://maps.google.com/maps/api/geocode/json?latlng=${latLng[0]},${latLng[1]}&key=AIzaSyAyhAP-kfAQ9xqD6jEhwnQPkAmxFSNIxZI`)
        .then(res => {
          this.addressData = res.data.results[0]
        })
        .catch(e => {
          console.log(e)
        })
    },

    navigateUrl () {
      window.location.href = `https://www.google.com/maps/dir/?api=1&destination=${encodeURI(this.address)}`
    },

    shareEvent () {
      $('#shareEvent').modal('show')
    },

    shareUrl (platform) {
      const id = this.$route.params.id

      if (platform.includes('fb')) {
        window.location.href = `https://www.facebook.com/sharer/sharer.php?u=${baseEventUrl(id)}`
      } else if (platform.includes('twit')) {
        window.location.href = `https://twitter.com/intent/tweet?text=${baseEventUrl(id)}`
      } else if (platform.includes('email')) {
        window.location.href = `mailto:?subject=Check%20out%20this%20cool%20Event&body=${baseEventUrl(id)}`
      } else if (platform.includes('in')) {
        window.location.href = `https://www.linkedin.com/shareArticle?mini=true&url=${baseEventUrl(id)}&title=&summary=&source=`
      } else {
        const copyText = document.getElementById('eventUrl')
        copyText.select()
        copyText.setSelectionRange(0, 99999)
        document.execCommand('copy')
      }
    },

    selectTicket (index) {
      if (this.tickets[index].sold < this.tickets[index].qty) this.activeTicket = index
    },

    buyTicket () {
      const id = encrypt(this.eventDetail[0].ticket[this.activeTicket].id.toString())
      router.push({ name: 'checkout', params: { id: id } })
    },

    eventImageUrl,

    currencyFormat,

    handleGiveRating () {
      const end = new Date(this.eventDetail[0].end_time)
      const now = new Date()
      if (!this.ratingStatus && end < now && this.authenticated.role == 1) {
        $('#giveRating').modal('show')
      }
      store.dispatch('rating/fetchRatingDetail', this.eventDetail[0].id)
    },

    submitRating () {
      axios.post('/api/rating', {
        event_id: this.eventDetail[0].id,
        point: this.rating
      })
    },

    handleUnregistered () {
      router.push({ name: 'register' })
    },

    reportEvent () {
      $('#report').modal('show')
    },

    handleReport () {
      axios.post('/api/report', {
        event_id: this.event[0].id,
        report: this.report
      })
    }
  },
}
</script>