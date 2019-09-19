<template>
  <div>
    <form @submit.prevent="send" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="status" />

      <!-- Email -->
      <div class="form-group row d-flex justify-content-center mb-0">
        <div class="col-md-9">
          <div class="col-md-12 d-flex align-items-center py-1">
            <v-img src="/dist/assets/mail.svg" max-width="25" max-height="25" class="mr-2" contain/>
            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control col-md-11" type="email" name="email" :placeholder="$t('email')">
          </div>
          <has-error :form="form" field="email" class="d-block pl-5 text-left"/>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="form-group row d-flex justify-content-center px-3">
        <div class="d-flex col-md-12 justify-content-center">
          <v-button class="col-md-9" :loading="form.busy">
            {{ $t('send_password_reset_link') }}
          </v-button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/api/password/email')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
