<template>
  <div class="col-12 col-md-6 px-1 pb-3 pt-0">
    <v-card class="mx-auto col-12 p-0">
      <v-list-item three-line>

        <v-list-item-avatar
          size="125"
          tile
          @click="handleEventUrl"
        >
          <v-img :src="eventImageUrl(image)"></v-img>
        </v-list-item-avatar>
        <v-list-item-content class="pl-3 pt-3 align-self-start" @click="handleEventUrl">
          <v-list-item-title
            v-text="title"
            style="font-size: 1.5rem;"
          ></v-list-item-title>

          <v-list-item-subtitle v-text="formattedDate"></v-list-item-subtitle>
          <v-list-item-subtitle v-text="`${sold} / ${total} sold`"></v-list-item-subtitle>
          <v-list-item-subtitle v-if="sold / total > 0.5" v-text="`${(sold / total * 100).toFixed(2)} %`"></v-list-item-subtitle>
          <v-list-item-subtitle v-if="user && user.role !== '1'" v-text="eventStatus" :class="{'text-danger': status === '3', 'text-success': eventStatus === $t('published') }"></v-list-item-subtitle>
        </v-list-item-content>
        <v-card-actions v-if="!deleted" class="text-right d-flex flex-column justify-content-between px-0 py-1" style="height: 125px;">
          <img v-if="status === '2'" src="/dist/assets/alert-triangle.svg" height="20">
          <img v-if="user && user.role > 3 && status < 2" src="/dist/assets/activity.svg" height="20" @click="showAnalyticsModal">
          <img v-if="user && user.role > 2 && status < 2 && !isPast" src="/dist/assets/tag.svg" height="20" @click="showCouponModal">
          <img v-if="user && user.role > 2 && status === '1' && isOnGoing" src="/dist/assets/edit.svg" height="20" @click="handleEditUrl">
          <img v-if="user && user.role === '2' && status === '1'" src="/dist/assets/alert-triangle.svg" height="20" @click="investigateEvent">
          <img v-if="user && user.role === '2' && status === '3'" src="/dist/assets/eye.svg" height="20" @click="reactivateEvent">
          <img v-if="user && user.role > 1 && status < 2 && !isPast" src="/dist/assets/x-circle.svg" height="20" @click="showCancelModal">
          <img v-if="user && user.role > 2 && status === '1' && isPast" src="/dist/assets/eye-off.svg" height="20" @click="showHideModal">
        </v-card-actions>
      </v-list-item>
    </v-card>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { dateFormat } from '~/utils/dateFormat'
import { baseEventUrl } from '~/utils/url'
import { decrypt } from '~/utils/simpleCrypto'
import { md } from '~/utils/mobileDetect'
import { eventImageUrl } from '~/utils/image'
import axios from 'axios'

export default {
  name: 'EventCard',

  props: {
    id: { type: String, default: null },
    title: { type: String, default: null },
    image: { type: String, default: null  },
    date: { type: String, default: null },
    end: { type: String, default: null },
    sold: { type: String, default: null },
    total: { type: String, default: null },
    status: { type: String, default: null },
    deleted: { type: Boolean, default: false }
  },

  computed: {
    ...mapGetters({
      user: 'auth/user'
    }),
    
    formattedDate () {
      return dateFormat(new Date(this.date), 'dd, DD MM YYYY @ hh.mm')
    },

    eventStatus () {
      if (this.deleted) {
        return this.$i18n.t('cancelled')
      } else {
        if (this.status === '1') {
          if (this.isPast) {
            return this.$i18n.t('past')
          } else {
            return this.$i18n.t('published')
          }
        } else if (this.status === '3') {
          return this.$i18n.t('hided')
        } else {
          return this.$i18n.t('under_investigation')
        }
      }
    },

    isPast () {
      return new Date(this.end) <= new Date()
    },

    isOnGoing () {
      return new Date(this.date) > new Date()
    }
  },

  methods: {
    handleEventUrl () {
      this.$router.push(`event/${this.id}`)
    },

    handleEditUrl () {
      if (md.mobile() || md.ua.includes('Wolvpack')) {
        this.$router.push(`m/event/${this.id}/edit`)
      } else {
        this.$router.push(`event/${this.id}/edit`)
      }
    },

    showShareModal (event) {
      this.$emit('showShareModal', this.id)
    },

    showCancelModal (event) {
      this.$emit('showCancelModal', this.id)
    },

    showCouponModal (event) {
      this.$emit('showCouponModal', this.id)
    },

    showHideModal (event) {
      this.$emit('showHideModal', this.id)
    },

    eventImageUrl,

    investigateEvent () {
      axios.post('/api/investigate', {
        id: decrypt(this.id)
      })
      .then(() => this.$emit('refreshList'))
    },

    reactivateEvent () {
      axios.post('/api/reactivate', {
        id: decrypt(this.id)
      })
      .then(() => this.$emit('refreshList'))
    },

    showAnalyticsModal (event) {
      this.$emit('showAnalyticsModal', this.id)
    }
  }
}
</script>
