<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card v-if="mustVerifyEmail" :title="$t('register')">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else :title="$t('register')" image="https://images.unsplash.com/photo-1559223669-e0065fa7f142" position="50% 45%">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Role -->
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-9">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img src="/dist/assets/type.svg" max-width="25" max-height="25" class="mr-2" contain/>
                <select v-model="form.role" :class="{ 'is-invalid': form.errors.has('username') }" class="custom-select col-md-11">
                  <option selected disabled value="">{{ $t('register_as') }}</option>
                  <option value="1">{{ $t('organizer') }}</option>
                  <option value="2">{{ $t('attendee') }}</option>
                </select>
              </div>
              <has-error :form="form" field="role" class="d-block pl-5 text-left"/>
            </div>
          </div>

          <!-- Username -->
          <div v-if="form.role !== '1'" class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-9">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img src="/dist/assets/gitlab.svg" max-width="25" max-height="25" class="mr-2" contain/>
                <input v-model="form.username" :class="{ 'is-invalid': form.errors.has('username') }" class="form-control col-md-11" type="text" name="username" :placeholder="$t('username')">
              </div>
              <has-error :form="form" field="username" class="d-block pl-5 text-left"/>
            </div>
          </div>

          <!-- Full Name -->
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-9">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img :src="form.role === '1' ? '/dist/assets/users.svg' : '/dist/assets/user.svg'" max-width="25" max-height="25" class="mr-2" contain/>
                <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control col-md-11" type="text" name="name" :placeholder="form.role === '' ? $t('name') : form.role === '2' ? $t('full_name') : $t('organizer_name')">
              </div>
              <has-error :form="form" field="name" class="d-block pl-5 text-left"/>
            </div>
          </div>

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


          <!-- Confirm Password -->
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-9">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img src="/dist/assets/key.svg" max-width="25" max-height="25" class="mr-2" contain/>
                <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control col-md-11" type="password" name="password_confirmation" :placeholder="$t('confirm_password')">
              </div>
              <has-error :form="form" field="password_confirmation" class="d-block pl-5 text-left"/>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-9 d-flex pl-5">
              <!-- Submit Button -->
              <v-button :loading="form.busy" class="ml-3">
                {{ $t('register') }}
              </v-button>

              <!-- GitHub Register Button -->
              <login-with-github />
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
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      username: '',
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      role: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
