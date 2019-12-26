<template>
  <div class="col-12 col-md-6 m-auto p-0">
    <v-img class="event-image col-12" :src="eventImageUrl(ticketDetail.event.image)" style="margin-top: -.2rem;"/>
    <div class="col-12">
      <p class="mb-2">{{ ticketDetail.event.title }} - {{ ticketDetail.name }}</p>
      <small>{{ ticketDetail.description }}</small>
    </div>
    <v-divider />
    <div class="form-group row d-flex justify-content-center mb-0">
      <div class="col-12 d-flex align-items-center justify-content-center py-1">
        <label class="m-0 col-2 pl-0">{{ $t('quantity') }}</label>
        <input class="form-control col-9" v-model="qty" type="number" name="qty" min="1" step="1">
      </div>
    </div>
    <div v-if="!couponApplied" class="form-group row d-flex justify-content-center mb-0">
      <div class="col-12 d-flex align-items-center justify-content-center py-1">
        <label class="m-0 col-2 pl-0">{{ $t('coupon') }}</label>
        <input class="form-control col-9" v-model="coupon" type="text" name="coupon" oninput="this.value = this.value.toUpperCase()">
      </div>
    </div>
    <div class="col-12" v-if="!couponApplied">
      <button :disabled="!ticketDetail.code && badCode" type="button" class="btn col-12 btn-success" @click="useCoupon">{{ $t('use_coupon') }}</button>
    </div>
    <v-divider />
    <div class="col-12 d-flex justify-content-between">
      <span><p class="mb-0">{{ $t('ticket_price') }}</p></span> 
      <span>{{ qty }} &times; <span class="font-weight-bold">Rp {{ currencyFormat(ticketDetail.price) }}</span></span>
    </div>
    <div v-if="couponApplied" class="col-12 d-flex justify-content-between">
      <span><p >{{ coupon }}</p></span> 
      <span><p class="font-weight-bold mb-0">- Rp {{ currencyFormat(countCut) }}</p></span>
    </div>
    <div class="col-12 d-flex justify-content-between blockquote m-0">
      <span><p class="mb-0">{{ $t('total_payment') }}</p></span> 
      <span><p class="font-weight-bold mb-0">Rp {{ currencyFormat(total) }}</p></span>
    </div>
    <div class="col-12 d-md-block d-none">
      <button :disabled="!canCheckout" type="button" class="btn col-12 btn-primary" @click="createTransaction">{{ $t('checkout') }}</button>
    </div>
    <div class="col-12 fixed-bottom bg-light d-md-none" style="box-shadow: 0px -1px 6px 2px rgba(158,158,158,1);">
      <button :disabled="!canCheckout" type="button" class="btn col-12 btn-primary" @click="createTransaction">{{ $t('checkout') }}</button>
    </div>
  </div>
</template>

<script>
import { decrypt, encrypt } from '~/utils/simpleCrypto'
import store from '~/store'
import axios from 'axios'
import { mapGetters } from 'vuex'
import { currencyFormat } from '~/utils/currencyFormat'
import { eventImageUrl } from '~/utils/image'
import router from '~/router'

export default {
  data: () => ({
    qty: 1,
    coupon: '',
    ticketId: '',
    couponId: '',
    couponApplied: false
  }),
  
  beforeRouteEnter (to, from, next) {
    store.dispatch('ticket/fetchTicketById', decrypt(to.params.id))
    .then(() => next(vm => vm.ticketId = to.params.id))
  },

  computed: {
    ...mapGetters({
      ticketDetail: 'ticket/ticketDetail'
    }),

    badCode () {
      const code = this.coupon
      return this.ticketDetail.code ? code !== this.ticketDetail.coupon.code : false
    },

    total () {
      const cut = this.countCut
      return (this.qty * this.ticketDetail.price) - cut
    },

    canCheckout () {
      return !isNaN(parseFloat(this.qty)) && isFinite(this.qty) && this.qty > 0
    },

    countCut () {
      if (!this.couponApplied) return 0

      const maxCut = parseInt(this.ticketDetail.coupon.max_cut)
      const totalCut = this.qty * this.ticketDetail.price * (this.ticketDetail.coupon.rate / 100)

      if (maxCut === 0) return totalCut

      return totalCut > maxCut ? maxCut : totalCut
    },
  },

  methods: {
    currencyFormat,

    eventImageUrl,

    useCoupon () {
      this.couponApplied = true
      this.couponId = this.ticketDetail.coupon.id
    },

    createTransaction () {
      axios.post('/api/transaction', {
        ticketId: decrypt(this.ticketId),
        qty: this.qty,
        coupon_id: this.couponId ? this.couponId : ''
      })
      .then( res => router.push({ name: 'transaction.detail', params: { id: encrypt(res.data.result) } }))
    }
  },
}
</script>