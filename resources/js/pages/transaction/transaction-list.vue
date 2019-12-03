<template>
  <div>
    <div v-if="transactionList.length === 0" class="col-12 text-center d-absolute" style="transform: translateY(175%);">
      <img src="/dist/assets/frown.svg" width="60">
      <p>{{ $t('no_history') }}</p>
    </div>
    <div v-else>
      <div
        v-for="(transaction, index) in transactionList"
        :key="index"
        @click="handleTransactionUrl(transaction.id)">
        <div class="row col-12 d-md-flex rounded-lg bg-white m-2" :class="{ 'd-none': isMember}">
          <div class="col-12 p-0">
            <p class="m-0">{{ $t('transaction_id') }}{{ transaction.id.toUpperCase() }}</p>
          </div>
          <v-img class="col-3 rounded-lg" :src="eventImageUrl(transaction.event.image)" height="174" width="300" cover :class="{ 'd-none': user.role !== '1', 'gray-out': !transaction.settled_at }"/>
          <div class="col-3 d-flex flex-column justify-content-center" :class="{ 'col-6 pl-0': !isMember}">
            <h5 class="m-0 d-block text-truncate">{{ transaction.event.title }}</h5>
            <p class="m-0 d-block text-truncate">{{ transaction.ticket.name }}</p>
            <v-divider class="my-2 mx-0"/>
            <p class="m-0">{{ dateFormat(new Date(isMember? transaction.event.start_time : transaction.created_at), 'dd, DD MMM YYYY')}}</p>
            <p class="m-0">{{ dateFormat(new Date(isMember? transaction.event.start_time : transaction.created_at), 'hh.mm')}}</p>
          </div>
          
          <div class="col-3 d-flex flex-column justify-content-center" :class="{ 'col-6 ': !isMember}">
            <p class="m-0">{{ $t('ticket_price') }}</p>
            <span>{{ transaction.qty }} &times; <span class="font-weight-bold">Rp {{ currencyFormat(transaction.ticket.price) }}</span></span>
            <v-divider class="my-2 mx-0"/>
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <p class="m-0">{{ $t('total_payment') }}</p>
                <span class="font-weight-bold">Rp {{ currencyFormat(total(transaction)) }}</span>
              </div>
              <div v-if="transaction.coupon_id && transaction.coupon">
                <span class="d-none d-md-inline">{{ transaction.coupon.code }}</span>
                <img src="/dist/assets/tag.svg" height="18">
              </div>
            </div>
          </div>

          <div class="px-4 col-3 text-right d-flex flex-column justify-content-around" v-if="isMember">
            <button v-if="transaction.settled_at && !isHistory" class="btn btn-primary btn-block" type="button" @click="handleQr(transaction.id)">
              {{ $t('see_qr') }}
            </button>
            <button v-if="!isHistory" class="btn btn-primary btn-block" type="button" @click="handlePaymentDest(transaction.event.eo_id)">
              {{ $t('see_payment_dest')}}
            </button>
            <button class="btn btn-white text-primary btn-block" type="button" @click="handleEventUrl(transaction.event.id)">
              {{ $t('see_event_detail') }}
            </button>
          </div>
          <div class="col-12 d-flex p-0" v-if="!isMember && !transaction.settled_at">
            <div class="col-6 p-0">
              <p class="m-0">{{ $t('sender_name') }}:</p>
              <p class="m-0">{{ transaction.member.name }}</p>
            </div>
            <div class="col-6 text-right">
              <button type="button" class="btn btn-success"><img class="white-svg" src="/dist/assets/check-circle.svg" height="18" cover> <span>{{ $t('settle') }}</span></button>
            </div>
          </div>
        </div>
        <Ticket v-if="user.role === '1'"
          class="d-md-none"
          :image="transaction.event.image"
          :title="transaction.event.title"
          :name="transaction.ticket.name"
          :date="transaction.event.start_time"
          :settled_at="transaction.settled_at"
          @click="handleTransactionUrl(transaction.id)"
          />
      </div>

      <div class="modal fade" id="qrCode" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ $t('see_qr') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body d-flex justify-content-center flex-wrap">
              <qrcode-vue
                :value="qrUrl"
                size="250"
                class="col-12 px-0 d-flex justify-content-center" />
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="paymentDest" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ $t('see_payment_dest') }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div v-if="paymentInfo" class="modal-body text-center">
              <p><small>{{ $t('please_transfer_to') }}</small></p>
              <p>{{ paymentInfo.name }}</p>
              <p>{{ paymentInfo.bank }} - {{ paymentInfo.acc_number }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { encrypt } from '~/utils/simpleCrypto'
import { currencyFormat } from '~/utils/currencyFormat'
import { dateFormat } from '~/utils/dateFormat'
import { md } from '~/utils/mobileDetect'
import QrcodeVue from 'qrcode.vue'
import { BASE_URL } from '~/utils/constant'
import $ from 'jquery'
import store from '~/store'
import { eventImageUrl } from '~/utils/image'

export default {
  middleware: 'auth',

  components: {
    QrcodeVue,
  },

  data: () => ({
    id: '',
    isHistory: ''
  }),

  beforeRouteEnter (to, from, next) {
    store.dispatch('transaction/fetchTransaction')
    .then(() => next( vm => vm.isHistory = to.name.includes('history')))
  },

  computed: {
    ...mapGetters ({
      transactions: 'transaction/transactions',
      user: 'auth/user',
      paymentInfo: 'transaction/paymentInfo'
    }),

    transactionList () {
      if (this.user.role === '1') {
        return this.transactions.filter( data => {
          return this.isHistory ? +new Date(data.event.end_time) <= +new Date() : new Date(data.event.end_time) > new Date()
        })
      } else {
        return this.transactions
      }
    },

    qrUrl () {
      return `${BASE_URL}/transaction/${this.id}`
    },

    isMember () {
      return this.user.role === '1'
    }
  },

  methods: {
    handleTransactionUrl (id) {
      if (this.isHistory) {
        const index = this.transactionList.findIndex(e => e.id === id)
        this.$router.push({ name: 'event.detail', params: { id: encrypt(this.transactionList[index].event.id) } })
      }
      else if(md.mobile()) this.$router.push({ name: 'transaction.detail', params: { id: encrypt(id) } })
    },

    currencyFormat,

    dateFormat,

    handleEventUrl (id) {
      this.$router.push({ name: 'event.detail', params: { id: encrypt(id) } })
    },

    handleQr (id) {
      $('#qrCode').modal('show')
      this.id = encrypt(id)
    },

    eventImageUrl,

    total (t) {
      const cut = this.countCut(t)
      return (t.qty * t.ticket.price) - cut
    },

    countCut (t) {
      if (!t.coupon_id) return 0

      const maxCut = parseInt(t.coupon.max_cut)
      const totalCut = t.qty * t.ticket.price * (t.coupon.rate / 100)

      if (maxCut === 0) return totalCut

      return totalCut > maxCut ? maxCut : totalCut 
    },

    handlePaymentDest (id) {
      store.dispatch('transaction/fetchPaymentInfo', id)
      .then( () => $('#paymentDest').modal('show'))
    }
  }
}
</script>