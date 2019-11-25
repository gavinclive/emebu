<template>
  <div class="col-12 col-md-6 m-auto p-0">
    
  </div>
</template>

<script>
import { decrypt, encrypt } from '~/utils/simpleCrypto'
import store from '~/store'
import { mapGetters } from 'vuex'
export default {
  beforeRouteEnter (to, from, next) {
    store.dispatch('transaction/fetchTransactionById', decrypt(to.params.id))
    .then(() => next())
  },

  computed: mapGetters({
    transaction: 'transaction/transactionDetail'
  })
}
</script>
