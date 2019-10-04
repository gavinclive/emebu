<template>
  <div class="event-detail main-layout col-12 p-0 mt-2 mt-md-3">
    <div class="event-heading col-12 col-md-10 mx-auto p-0" >
      <v-img class="event-image col-12 rounded-lg" :src="img" />
      <div class="share-btn bg-primary p-2 rounded-circle" @click="shareEvent">
        <img src='/dist/assets/share-2.svg' height="28" class="white-svg mx-auto">
      </div>
      <div class="event-info col-12 p-0 border-top-0 border-md-primary row m-0">
        <div class="col-md-6 col-12 p-0">
          <div class="event-name col-12 pb-0">
            <h4>{{ title }}</h4>
          </div>
          <div class="col-12 event-type-cate pt-0 text-primary">
            {{ eventType }}, {{ eventCategory }}
          </div>
        </div>
        <div class="col-md-6 d-none d-md-flex flex-row-reverse">
          <div class="col-6 p-0 mx-2">
            <button type="button" class="btn col-12 btn-primary">{{ $t('get_ticket') }}</button>
            <p class="mb-0 text-right" v-if="startFrom >= 0">{{ $t('starts_from') }} Rp {{ startFrom }}</p>
          </div>
        </div>
        <div class="col-12 event-summary pt-0 font-weight-lighter text-justify">
          {{ summary }}
        </div>
        <div class="col-12 py-0"><v-divider class="my-0"/></div>
        <div class="row px-3">
          <div class="col-12 col-md-4">
            <span class="font-weight-bold">{{ $t('organized_by') }}</span>
            <div class="mt-2">
              <span>{{ organizer }}</span>
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
              <span class="px-2">{{ address }}</span>
            </div>
          </div>
          <div class="col-12 p-2 ">
            <div class="d-flex justify-content-center"  @click="showMap = !showMap">
              <img :src="showMap ? '/dist/assets/chevron-up.svg' : '/dist/assets/chevron-down.svg'" width="16">
              <span class="pl-2">{{ $t('see_map') }}</span>
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
        </div>
      </div>
    </div>
    <div class="col-12 col-md-10 mx-auto py-0"><v-divider class="my-0"/></div>
    <div class="col-12 col-md-10 overflow-hidden event-desc mx-auto mb-5 pb-5" v-html="description" />
    <div class="col-12 fixed-bottom bg-light d-md-none" style="box-shadow: 0px -1px 6px 2px rgba(158,158,158,1);">
      <p class="mb-1 text-center" v-if="startFrom >= 0">{{ $t('starts_from') }} Rp {{ startFrom }}</p>
      <button type="button" class="btn col-12 btn-primary">{{ $t('get_ticket') }}</button>
    </div>

    <div class="modal fade" id="shareEvent" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">{{ $t('share_event') }}</h5>
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
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import store from '~/store'
import axios from 'axios'
import $ from 'jquery'
import { dateFormat } from '~/utils/dateFormat'
import { currencyFormat } from '~/utils/currencyFormat'

export default {
  data: () => ({
    img: 'https://s.yimg.com/os/creatr-uploaded-images/2018-11/bb1e57e0-ed98-11e8-bbbe-f413dd5587e9',
    title: 'TwitchCon Europe',
    category: '4',
    type: '11',
    organizer: 'Admin',
    startTime: '2020-01-05 09:30',
    endTime: '2020-01-06 18:30',
    location: '52.5186, 13.3762',
    addressData: '',
    summary: 'Paint the town purple',
    latLng: {lat:0, lng:0},
    showMap: false,
    tickets: [
      {
        name: '3-day Pass',
        price: '5100000'
      },
      {
        name: 'Nonton dari Tribun',
        price: '44000'
      },
      {
        name: 'Nonton di Rumah',
        price: '3330'
      }
    ],
    description : '<h1>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting English</h1><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><ol><li>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li><li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ol><ul><li>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li><li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ul><table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\"><tbody><tr><td>No</td><td>Name</td><td>Description</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><p><strong>Lorem Ipsum</strong>&nbsp;<em>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it</em> t<u>o make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</u></p><p><tt><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</tt></p><p><code><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</code></p><p><code><img alt=\"\" src=\"http://cdn.dota2.com/apps/dota2/images/blogfiles/planetfall_blog_zxgim.jpg\" style=\"height:550px; width:810px\" /></code></p><p><tt><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</tt></p><p><code><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</code></p>'
  }),

  async beforeRouteEnter (to, from, next) {
    try {
      await store.dispatch('category/fetchCategories')
      await store.dispatch('type/fetchTypes')
    } catch (e) {
      console.log(e)
    }
    next()
  },

  mounted () {
    this.reverseGeocode()
  },

  computed: {
    ...mapGetters({
      categories: 'category/getCategories',
      types: 'type/getTypes'
    }),

    eventType () {
      return this.types[this.type-1].name
    },

    eventCategory () {
      return this.categories[this.category-1].name
    },

    eventStart () {
      return dateFormat(new Date(this.startTime), 'ddd, DD MMMM YYYY @ hh.mm')
    },

    eventEnd () {
      return dateFormat(new Date(this.endTime), 'ddd, DD MMMM YYYY @ hh.mm')
    },

    address () {
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
      const prices = []
      let allFree = true
      this.tickets.forEach( ticket => {
        prices.push(ticket.price)
        allFree = allFree ? ticket.price == 0 : false
      })
      return allFree ? -1 : currencyFormat(Math.min(...prices))
    },

    eventUrl () {
      return window.location.href
    }
  },

  methods: {
    async reverseGeocode() {
      const latLng = this.location.split(', ')
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
    }
  },
}
</script>