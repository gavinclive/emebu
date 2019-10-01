<template>
  <form @submit.prevent="update" @keydown="form.onKeydown($event)">
    <alert-success :form="form" :message="$t('password_updated')" />

    <!-- Password -->
    <div class="form-group row d-flex justify-content-center mb-0">
      <div class="col-md-10 py-0">
        <label class="col-3 pt-0 col-form-label">{{ $t('password') }}</label>
        <div class="col-md-12 d-flex align-items-center py-1">
          <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control col-md-11" type="password" name="password">
        </div>
        <has-error :form="form" field="password" class="d-block pl-3 text-left"/>
      </div>
    </div>

    <!-- Password Confirmation -->
    <div class="form-group row d-flex justify-content-center mb-0">
      <div class="col-md-10 pb-0">
        <label class="col-12 pt-0 col-form-label">{{ $t('confirm_password') }}</label>
        <div class="col-md-12 d-flex align-items-center py-1">
          <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control col-md-11" type="password" name="password_confirmation">
        </div>
        <has-error :form="form" field="password_confirmation" class="d-block pl-3 text-left"/>
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

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('change_password') }
  },

  data: () => ({
    form: new Form({
      password: '',
      password_confirmation: ''
    })
  }),

  computed: {
    routeName () {
      return this.$route.name
    }
  },

  methods: {
    async update () {
      await this.form.patch('/api/settings/password')

      this.form.reset()
    }
  }
}
</script>
