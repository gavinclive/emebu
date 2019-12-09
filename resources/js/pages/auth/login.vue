<template>
  <div class="row d-flex justify-content-center col-12 mx-0">
    <div class="col-lg-5 col-md-7 m-auto">
      <card :title="$t('login')" class="pt-3">

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

          <!-- Remember Me -->
          <div class="form-group row d-flex justify-content-center mt-3 text-center">
            <div class="col-12 col-md-8 d-md-flex align-items-space-between align-center">
              <checkbox v-model="remember" name="remember" class="login-ckbox mx-m-auto">
                <span>{{ $t('remember_me') }}</span>
              </checkbox>

              <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto">
                {{ $t('forgot_password') }}
              </router-link>
            </div>
          </div>
          
          <div class="form-group row d-flex justify-content-center">
            <div class="d-flex pl-5 col-md-9">
              <!-- Submit Button -->
              <v-button class="ml-3" :loading="form.busy">
                {{ $t('login') }}
              </v-button>
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'
import { md } from '~/utils/mobileDetect'

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

  beforeRouteEnter (to, from, next) {
    if (md.ua.includes('Wolvpack')) {
      next({ name: 'm.login' })
    } else if (md.mobile()) {
      next({ name: 'download' })
    } else {
      next()
    }
  },

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
