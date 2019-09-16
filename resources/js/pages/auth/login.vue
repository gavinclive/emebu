<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card :title="$t('login')" image="https://image.freepik.com/free-photo/hand-crowd-disco_23-2147717087.jpg" position="50% 65%">

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
          <div class="form-group row d-flex justify-content-center mt-3">
            <div class="col-md-9 d-flex align-items-space-between">
              <checkbox v-model="remember" name="remember" class="pl-5">
                {{ $t('remember_me') }}
              </checkbox>

              <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto pr-3">
                {{ $t('forgot_password') }}
              </router-link>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-9 d-flex pl-5">
              <!-- Submit Button -->
              <v-button :loading="form.busy" class="ml-3">
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

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

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
