<template>
  <div>
    <qrcode-vue
      :value="url"
      :size="size"
      class="col-12 px-0 d-flex justify-content-center"
      style="margin-top: 4%" />
    <div class="col-12">
      <div class="col-12 p-0">
        <p>{{ $t('transaction_id') }}{{ transactionDetail.id }}</p>
      </div>
      <div class="col-12 p-0">
        <p>{{ transactionDetail.event.title }} - {{ transactionDetail.ticket.name }}</p>
      </div>
      <v-divider />
      <div class="col-12 p-0 d-flex justify-content-between blockquote m-0">
        <span><p>{{ $t('total_payment') }}</p></span> 
        <span><p class="font-weight-bold">Rp {{ currencyForamt(total) }}</p></span>
      </div>
      <div class="col-12 p-0 d-flex justify-content-between">
        <span><p>{{ $t('ticket_price') }}</p></span> 
        <span>{{ transactionDetail.qty }} &times; <span class="font-weight-bold">Rp {{ currencyFormat(transactionDetail.ticket.price) }}</span></span>
      </div>
      <v-divider />
      <p class="text-right" style="font-size: .7rem">{{ $t('ticket_guide') }}</p>
    </div>
    <div class="col-12 fixed-bottom bg-light d-md-none" style="box-shadow: 0px -1px 6px 2px rgba(158,158,158,1);">
      <button type="button" class="btn col-12 btn-primary" @click="handleEventUrl()">{{ $t('see_event_detail') }}</button>
    </div>
  </div>
</template>

<script>
import { decrypt } from '~/utils/simpleCrypto'
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
    .then( () => next(vm => {
      vm.id = encId ? encId : ''
    }))
  },

  computed: {
    ...mapGetters ({
      transactionDetail: 'transaction/transactionDetail'
    }),

    url () {
      return window.location.href
    },

    size () {
      return window.innerWidth < 500 ? window.innerWidth * 0.5 : 250
    },

    total () {
      return currencyFormat(this.transactionDetail.ticket.price * this.transactionDetail.qty)
    }
  },

  methods: {
    decrypt,

    currencyFormat,

    handleEventUrl () {
      this.$router.push({ name: 'event.detail', params: { id: this.id } })
    }
  }
}
</script>