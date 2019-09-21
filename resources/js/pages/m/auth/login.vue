<template>
  <div class="mobile-login">
    <form @submit.prevent="login" @keydown="form.onKeydown($event)">
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

      <!-- Password -->
      <div class="form-group row d-flex justify-content-center mb-0">
        <div class="col-md-9">
          <div class="col-md-12 d-flex align-items-center py-1">
            <v-img src="/dist/assets/key.svg" max-width="25" max-height="25" class="mr-2" contain/>
            <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control col-md-11" type="password" name="password" :placeholder="$t('password')">
          </div>
          <has-error :form="form" field="password" class="d-block pl-5 text-left"/>
        </div>
      </div>
      <div class="col-md-9 d-flex mx-auto my-0 position-relative">
        <router-link :to="{ name: 'm.password.request' }" class="medium mobile-forget position-absolute pr-4">
          {{ $t('forgot_password') }}
        </router-link>
      </div>
      
      <div class="form-group row d-flex justify-content-center px-3">
        <div class="d-flex col-md-12 justify-content-center">
          <!-- Submit Button -->
          <v-button class="col-md-9" :loading="form.busy">
            {{ $t('login') }}
          </v-button>
        </div>
      </div>

      <div class="form-group row d-flex justify-content-center px-3">
        <div class="d-flex col-md-12 justify-content-center">
          {{ $t('no_account') }}
          <router-link :to="{ name: 'm.register' }" class="ml-1">{{ $t('register') }}</router-link>
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
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push({ name: 'home' })
    }
  }
}
</script>