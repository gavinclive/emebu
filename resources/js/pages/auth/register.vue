<template>
  <div class="row">
    <div class="col-lg-5 col-md-7 m-auto">
      <card v-if="mustVerifyEmail" :title="$t('register')" class="mt-5">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else class="pt-3" :title="$t('register')">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Role -->
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-11">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img src="/dist/assets/type.svg" max-width="25" max-height="25" class="mr-2" contain/>
                <select v-model="form.role" :class="{ 'is-invalid': form.errors.has('role') }" class="custom-select col-md-11 py-0">
                  <option selected disabled value="">{{ $t('register_as') }}</option>
                  <option value="3">{{ $t('organizer') }}</option>
                  <option value="1">{{ $t('member') }}</option>
                </select>
              </div>
              <has-error :form="form" field="role" class="d-block pl-5 text-left"/>
            </div>
          </div>

          <!-- Full Name -->
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-11">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img :src="form.role === '3' ? '/dist/assets/users.svg' : '/dist/assets/user.svg'" max-width="25" max-height="25" class="mr-2" contain/>
                <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control col-md-11" type="text" name="name" :placeholder="form.role === '' ? $t('name') : form.role === '1' ? $t('full_name') : $t('organizer_name')">
              </div>
              <has-error :form="form" field="name" class="d-block pl-5 text-left"/>
            </div>
          </div>

          <!-- Email -->
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-11">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img src="/dist/assets/mail.svg" max-width="25" max-height="25" class="mr-2" contain/>
                <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control col-md-11" type="email" name="email" :placeholder="$t('email')">
              </div>
              <has-error :form="form" field="email" class="d-block pl-5 text-left"/>
            </div>
          </div>

          <!-- Password -->
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-11">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img src="/dist/assets/key.svg" max-width="25" max-height="25" class="mr-2" contain/>
                <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control col-md-11" type="password" name="password" :placeholder="$t('password')">
              </div>
              <has-error :form="form" field="password" class="d-block pl-5 text-left"/>
            </div>
          </div>


          <!-- Confirm Password -->
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-11">
              <div class="col-md-12 d-flex align-items-center py-1">
                <v-img src="/dist/assets/key.svg" max-width="25" max-height="25" class="mr-2" contain/>
                <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control col-md-11" type="password" name="password_confirmation" :placeholder="$t('confirm_password')">
              </div>
              <has-error :form="form" field="password_confirmation" class="d-block pl-5 text-left"/>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-11 d-flex pl-5">
              <!-- Submit Button -->
              <v-button :loading="form.busy" class="ml-3">
                {{ $t('register') }}
              </v-button>
            </div>
          </div>
        </form>
      </card>
      <div class="position-fixed" style="left: 0; bottom: -17.5px; transform: rotate(35deg);"><img src="/dist/assets/wayang.png" height="200"></div>
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
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      role: '',
      status: 'active'
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
      } 
    }
  }
}
</script>
