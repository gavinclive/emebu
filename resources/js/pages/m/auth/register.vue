<template>
  <div>
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

      <div class="form-group row d-flex justify-content-center px-3">
        <div class="d-flex col-md-12 justify-content-center">
          <!-- Submit Button -->
          <v-button class="col-md-9" :loading="form.busy">
            {{ $t('register') }}
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
