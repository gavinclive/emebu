<template>
  <div>
    <div v-if="transactionDetail.settled_at">
      <qrcode-vue
        :value="url"
        :size="size"
        class="col-12 px-0 d-flex justify-content-center"
        style="margin-top: 4%" />
      <p class="text-center" style="font-size: .7rem">{{ $t('ticket_guide') }}</p>
    </div>
    <div class="col-12">
      <div class="col-12 p-0">
        <p class="m-0">{{ $t('transaction_id') }}</p>
        <p>{{ transactionDetail.id.toUpperCase() }}</p>
      </div>
      <div class="col-12 p-0">
        <p>{{ transactionDetail.event.title }} - {{ transactionDetail.ticket.name }}</p>
      </div>
      <v-divider />
      <div class="col-12 p-0 d-flex justify-content-between">
        <span><p>{{ $t('ticket_price') }}</p></span> 
        <span>{{ transactionDetail.qty }} &times; <span class="font-weight-bold">Rp {{ currencyFormat(transactionDetail.ticket.price) }}</span></span>
      </div>
      <div class="col-12 p-0 d-flex justify-content-between" v-if="transactionDetail.coupon">
        <span><p >{{ transactionDetail.coupon.code }}</p></span> 
        <span class="font-weight-bold mb-0">- Rp {{ currencyFormat(countCut) }}</span>
      </div>
      <div class="col-12 p-0 d-flex justify-content-between blockquote m-0">
        <span><p>{{ $t('total_payment') }}</p></span> 
        <span><p class="font-weight-bold">Rp {{ currencyFormat(total) }}</p></span>
      </div>
      <div v-if="paymentInfo && !transactionDetail.settled_at">
        <v-divider />
        <p>{{ $t('please_transfer_to') }}</p>
        <p>{{ paymentInfo.name }}</p>
        <p>{{ paymentInfo.bank }} - {{ paymentInfo.acc_number }}</p>
      </div>
    </div>
    <div class="col-12 fixed-bottom bg-light d-md-none" style="box-shadow: 0px -1px 6px 2px rgba(158,158,158,1);">
      <button type="button" class="btn col-12 btn-primary" @click="handleEventUrl()">{{ $t('see_event_detail') }}</button>
    </div>
  </div>
</template>

<script>
import { encrypt, decrypt } from '~/utils/simpleCrypto'
import { mapGetters } from 'vuex'
import QrcodeVue from 'qrcode.vue'
import axios from 'axios'
import { currencyFormat } from '~/utils/currencyFormat'
import store from '~/store'

export default {
  components: {
    QrcodeVue,
  },

  data: () => ({
    id: ''
  }),

  beforeRouteEnter (to, from, next) {
    const encId = to.params.id
    const id = decrypt(encId)

    store.dispatch('transaction/fetchTransactionById', id)
    .then( () => store.dispatch('transaction/fetchPaymentInfo', store.getters['transaction/transactionDetail'].event.eo_id))
    .then( () => next(vm => {
      vm.id = encId ? encId : ''
    }))
  },

  computed: {
    ...mapGetters ({
      transactionDetail: 'transaction/transactionDetail',
      paymentInfo: 'transaction/paymentInfo'
    }),

    url () {
      return window.location.href
    },

    size () {
      return window.innerWidth < 500 ? window.innerWidth * 0.5 : 250
    },

    total () {
      const cut = this.countCut
      return (this.transactionDetail.qty * this.transactionDetail.ticket.price) - cut
    },

    countCut () {
      if (!this.transactionDetail.coupon_id) return 0

      const maxCut = parseInt(this.transactionDetail.coupon.max_cut)
      const totalCut = this.transactionDetail.qty * this.transactionDetail.ticket.price * (this.transactionDetail.coupon.rate / 100)

      if (maxCut === 0) return totalCut

      return totalCut > maxCut ? maxCut : totalCut 
    },
  },

  methods: {
    decrypt,

    currencyFormat,

    handleEventUrl () {
      this.$router.push({ name: 'event.detail', params: { id: encrypt(this.transactionDetail.event.id) } })
    }
  }
}
</script>