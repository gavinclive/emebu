<template>
  <div>
    <div
      v-for="(transaction, index) in transactions"
      :key="index"
      @click="handleTransactionUrl(transaction.id)">
      <div class="row col-12 d-md-flex rounded-lg bg-white m-2" :class="{ 'd-none': isMember}">
        <div class="col-12 p-0">
          <p class="m-0">{{ $t('transaction_id') }}{{ transaction.id }}</p>
        </div>
        <v-img class="col-3 rounded-lg" :src="transaction.image" height="140" width="300" cover :class="{ 'd-none': user.role !== '1'}"/>
        <div class="col-3" :class="{ 'col-6 pl-0': !isMember}">
          <h5 class="m-0 d-block text-truncate">{{ transaction.event.title }}</h5>
          <p class="m-0 d-block text-truncate">{{ transaction.ticket.name }}</p>
          <v-divider class="my-2 mx-0"/>
          <p class="m-0">{{ dateFormat(new Date(transaction.created_at), 'dd, DD MMM YYYY')}}</p>
        <p class="m-0">{{ dateFormat(new Date(transaction.created_at), 'hh.mm')}}</p>
        </div>
        
        <div class="col-3" :class="{ 'col-6': !isMember}">
          <p class="m-0">{{ $t('ticket_price') }}</p>
          <span>{{ transaction.qty }} &times; <span class="font-weight-bold">Rp {{ currencyFormat(transaction.ticket.price) }}</span></span>
          <v-divider class="my-2 mx-0"/>
          <p class="m-0">{{ $t('total_payment') }}</p>
          <span class="font-weight-bold">Rp {{ currencyFormat(transaction.qty * transaction.ticket.price) }}</span>
        </div>

        <div class="px-4 col-3 text-right" v-if="isMember">
          <button class="btn btn-primary btn-block" type="button" @click="handleQr(transaction.id)">
            {{ $t('see_qr') }}
          </button>
          <v-divider style="opacity: 0;"/>
          <button class="btn btn-white text-primary mt-4 pb-0 btn-block" type="button" @click="handleEventUrl(transaction.event.id)">
            {{ $t('see_event_detail') }}
          </button>
        </div>
        <div class="col-12 d-flex p-0" v-if="!isMember">
          <div class="col-6 p-0">
            <p class="m-0">{{ $t('sender_name') }}:</p>
            <p class="m-0">Ucok</p>
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

export default {
  middleware: 'auth',

  components: {
    QrcodeVue,
  },

  data: () => ({
    id: ''
  }),

  beforeRouteEnter (to, from, next) {
    store.dispatch('transaction/fetchTransaction')
    .then(() => next())
  },

  computed: {
    ...mapGetters ({
      transactions: 'transaction/transactions',
      user: 'auth/user'
    }),

    qrUrl () {
      return `${BASE_URL}/transaction/${this.id}`
    },

    isMember () {
      return this.user.role === '1'
    }
  },

  methods: {
    handleTransactionUrl (id) {
      if(md.mobile()) this.$router.push({ name: 'transaction.detail', params: { id: encrypt(id) } })
    },

    currencyFormat,

    dateFormat,

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