<template>
  <div>
    <div class="row col-12 mx-0 pt-0 px-2">
      <div class="input-group col-md-6 pb-2 px-0 pr-md-1">
        <input v-model="searchTitle" class="form-control">
        <div class="input-group-append">
          <span class="input-group-text"><img src="/dist/assets/search.svg"></span>
        </div>
      </div>
      <div class="input-group col-md-6 pb-2 px-0 pl-md-1">
        <select v-model="searchStatus" class="custom-select">
          <option value="0">{{ $t('all') }}</option>
          <option value="1">{{ $t('published') }}</option>
          <option value="3">{{ $t('under_investigation') }}</option>
          <option value="4">{{ $t('past') }}</option>
          <option value="2">{{ $t('cancelled') }}</option>
        </select>
        <div class="input-group-append">
          <span class="input-group-text"><img src="/dist/assets/activity.svg"></span>
        </div>
      </div>
    </div>
    <div class="row col-12 mx-0 py-0 px-1">
      <EventCard v-for="(event, index) in filteredList" :key="index" 
        :id="encrypt(event.id)"
        :title="event.title"
        :image="event.img"
        :date="event.startDate"
        :sold="event.sold"
        :total="event.qty"
        :status="event.status"
        @showShareModal="shareEvent"
        @showCancelModal="cancelEvent"
        />
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

    <div class="modal fade" id="cancelEvent" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Cancel Event</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body d-flex justify-content-center flex-wrap text-justify">
            Are you sure to cancel this event? This action is irreversible and ticket sales will need to be refunded!
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="handleCancelEvent" data-dismiss="modal">{{ $t('confirm') }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import $ from 'jquery'
import { baseEventUrl } from '~/utils/url'
import { encrypt, decrypt } from '~/utils/simpleCrypto'

export default {
  middleware: 'auth',

  data: () => ({
    searchTitle:'',
    searchStatus: '0',
    id: '',
    eventUrl: '',
  }),
  
  computed: {
    ...mapGetters ({
      events: 'event/events'
    }),

    filteredList () {
      const list = this.events.filter(data => {
        return data.title.toLowerCase().includes(this.searchTitle.toLowerCase())
      }).sort((a, b) => b.id - a.id)

      if(this.searchStatus !== '0') {
        return list.filter(data => {
          return data.status.includes(this.searchStatus)
        })
      }

      return list
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

    encrypt: encrypt,

    cancelEvent (id) {
      $('#cancelEvent').modal('show')
      this.id = id
    },

    handleCancelEvent () {
      console.log(`cancel event id ${decrypt(this.id)}  ${decrypt('42')}`)
    }
  }
}
</script>
