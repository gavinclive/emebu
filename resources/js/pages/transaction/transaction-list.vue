<template>
  <div>
    <div
      v-for="(transaction, index) in transactions"
      :key="index"
      @click="handleTransactionUrl(transaction.id)">
      <div class="row col-12 d-none d-md-flex rounded-lg bg-white m-2">
        <div class="col-12 p-0">
          <p class="m-0">{{ $t('transaction_id') }}{{ transaction.id }}</p>
        </div>
        <v-img class="col-3 rounded-lg" :src="transaction.image" height="140" width="300" cover/>
        <div class="col-3">
          <h5 class="m-0">{{ transaction.title }}</h5>
          <p class="m-0">{{ transaction.name }}</p>
          <v-divider class="my-2 mx-0"/>
          <p class="m-0">{{ dateFormat(new Date(transaction.date), 'dd, DD MMM YYYY')}}</p>
        <p class="m-0">{{ dateFormat(new Date(transaction.date), 'hh.mm')}}</p>
        </div>
        
        <div class="col-3">
          <p class="m-0">{{ $t('ticket_price') }}</p>
          <span>{{ transaction.qty }} &times; <span class="font-weight-bold">Rp {{ currencyFormat(transaction.price) }}</span></span>
          <v-divider class="my-2 mx-0"/>
          <p class="m-0">{{ $t('total_payment') }}</p>
          <span class="font-weight-bold">Rp {{ currencyFormat(transaction.qty * transaction.price) }}</span>
        </div>

        <div class="px-4 col-3 text-right">
          <button class="btn btn-primary btn-block" type="button" @click="handleQr(transaction.id)">
            {{ $t('see_qr') }}
          </button>
          <v-divider style="opacity: 0;"/>
          <button class="btn btn-white text-primary mt-4 pb-0 btn-block" type="button" @click="handleEventUrl(transaction.event_id)">
            {{ $t('see_event_detail') }}
          </button>
        </div>
      </div>

      <Ticket
        class="d-md-none"
        :image="transaction.image"
        :title="transaction.title"
        :name="transaction.name"
        :date="transaction.date"
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

export default {
  middleware: 'auth',

  components: {
    QrcodeVue,
  },

  data: () => ({
    id: ''
  }),

  computed: {
    ...mapGetters ({
      transactions: 'transaction/transactions'
    }),

    qrUrl () {
      return `${BASE_URL}/transaction/${this.id}`
    }
  },

  methods: {
    handleTransactionUrl (id) {
      if(md.mobile()) this.$router.push({ name: 'transaction.detail', params: { id: encrypt(id) } })
    },

    currencyFormat: currencyFormat,

    dateFormat: dateFormat,

    handleEventUrl (id) {
      this.$router.push({ name: 'event.detail', params: { id: encrypt(id) } })
    },

    handleQr (id) {
      $('#qrCode').modal('show')
      this.id = encrypt(id)
    }
  }
}
</script>