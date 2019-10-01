<template>
  <form @submit.prevent="update" @keydown="form.onKeydown($event)">
    <alert-success :form="form" :message="$t('password_updated')" />

    <!-- Bank Name -->
    <div class="form-group row d-flex justify-content-center mb-0">
      <div class="col-md-10 py-0">
        <label class="col-12 pt-0 col-form-label">{{ $t('bank') }}</label>
        <div class="col-md-12 d-flex align-items-center py-1">
          <input v-model="form.bank" :class="{ 'is-invalid': form.errors.has('bank') }" class="form-control col-md-11" type="number" name="bank">
        </div>
        <has-error :form="form" field="bank" class="d-block pl-5 text-left"/>
      </div>
    </div>

    <!-- Atm Number -->
    <div class="form-group row d-flex justify-content-center mb-0">
      <div class="col-md-10 py-0">
        <label class="col-12 pt-0 col-form-label">{{ $t('account_number') }}</label>
        <div class="col-md-12 d-flex align-items-center py-1">
          <input v-model="form.acc_num" :class="{ 'is-invalid': form.errors.has('acc_num') }" class="form-control col-md-11" type="number" name="acc_num">
        </div>
        <has-error :form="form" field="acc_num" class="d-block pl-5 text-left"/>
      </div>
    </div>

    <!-- Submit Button -->
    <div v-if="!routeName.includes('m.')" class="form-group row d-flex justify-content-center mt-3">
      <div class="d-flex col-md-9 px-0">
        <v-button :loading="form.busy" type="success">
          {{ $t('update') }}
        </v-button>
      </div>
    </div>

    <div v-if="routeName.includes('m.')" class="form-group row d-flex justify-content-center mt-3 mx-0 col-12">
      <v-button block :loading="form.busy" type="success">
        {{ $t('update') }}
      </v-button>
    </div>
  </form>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('edit_atm') }
  },

  data: () => ({
    form: new Form({
      bank: '',
      acc_num: '',
    })
  }),

  computed: {
    routeName () {
      return this.$route.name
    },
    ...mapGetters({
      user: 'auth/user'
    })
  },

  methods: {
    async update () {
      await this.form.patch('/api/settings/atm')

      this.form.reset()
    }
  }
}
</script>