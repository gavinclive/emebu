<template>
  <div class="col- p-0">
    <v-img class="event-image col-12" :src="eventImageUrl(ticketDetail.event.image)" style="margin-top: -.2rem;"/>
    <div class="col-12">
      <p class="mb-2">{{ ticketDetail.event.title }} - {{ ticketDetail.name }}</p>
      <small>{{ ticketDetail.description }}</small>
    </div>
    <v-divider />
    <div class="form-group row d-flex justify-content-center mb-0">
      <div class="col-12 d-flex align-items-center justify-content-center py-1">
        <label class="m-0 mr-2">{{ $t('quantity') }}</label>
        <input class="form-control col-9" v-model="qty" type="number" name="qty" min="1" step="1">
      </div>
    </div>
    <v-divider />
    <div class="col-12 d-flex justify-content-between blockquote m-0">
      <span><p class="mb-0">{{ $t('total_payment') }}</p></span> 
      <span><p class="font-weight-bold mb-0">Rp {{ currencyFormat(total) }}</p></span>
    </div>
    <div class="col-12 d-flex justify-content-between">
      <span><p>{{ $t('ticket_price') }}</p></span> 
      <span>{{ qty }} &times; <span class="font-weight-bold">Rp {{ currencyFormat(ticketDetail.price) }}</span></span>
    </div>
    <div class="col-12 fixed-bottom bg-light d-md-none" style="box-shadow: 0px -1px 6px 2px rgba(158,158,158,1);">
      <button :disabled="!canCheckout" type="button" class="btn col-12 btn-primary" data-toggle="modal" :data-target="authenticated ? '#getTicket' : ''">{{ $t('get_ticket') }}</button>
    </div>
  </div>
</template>

<script>
import { decrypt } from '~/utils/simpleCrypto'
import store from '~/store'
import { mapGetters } from 'vuex'
import { currencyFormat } from '~/utils/currencyFormat'
import { eventImageUrl } from '~/utils/image'

export default {
  data: () => ({
    qty: 1
  }),
  
  beforeRouteEnter (to, from, next) {
    store.dispatch('ticket/fetchTicketById', decrypt(to.params.id))
    .then(() => next())
  },

  mounted () {
    console.log(this.ticketDetail)
  },

  computed: {
    ...mapGetters({
      ticketDetail: 'ticket/ticketDetail'
    }),

    total () {
      return this.qty * this.ticketDetail.price
    },

    canCheckout () {
      return !isNaN(parseFloat(this.qty)) && isFinite(this.qty)
    }
  },

  methods: {
    currencyFormat,

    eventImageUrl
  },
}
</script>