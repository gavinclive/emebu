<template>
  <form @submit.prevent="update" @keydown="form.onKeydown($event)">
    <alert-success :form="form" :message="$t('info_updated')" />

    <!-- Name -->
    <div class="form-group row d-flex justify-content-center mb-0">
      <div class="col-md-10 py-0">
        <label class="col-3 pt-0 col-form-label">{{ $t('name') }}</label>
        <div class="col-md-12 d-flex align-items-center py-1">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control col-md-11" type="text" name="name">
        </div>
        <has-error :form="form" field="name" class="d-block pl-3 text-left"/>
      </div>
    </div>

    <!-- Email -->
    <div class="form-group row d-flex justify-content-center mb-0">
      <div class="col-md-10 pb-0">
        <label class="col-3 col-form-label">{{ $t('email') }}</label>
        <div class="col-md-12 d-flex align-items-center py-1">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control col-md-11" type="text" name="name">
        </div>
        <has-error :form="form" field="email" class="d-block pl-3 text-left"/>
      </div>
    </div>

    <!-- Profile Picture -->
    <div v-if="!routeName.includes('m.')" class="form-group row d-flex justify-content-center mb-0">
      <div class="col-md-10 pb-0">
        <label class="col-12 col-form-label">{{ $t('profile_picture') }}</label>
        <div class="col-md-12 d-flex align-items-center py-1 custom-file">
          <div class="custom-file col-md-11">
            <input type="file" accept="image/*" class="custom-file-input" @change="imageUpload($event.target.files[0])">
            <label class="custom-file-label">{{ $t('choose_file') }}</label>
          </div>
        </div>
        <label v-if="imagePreview" class="col-3 col-form-label">{{ $t('image_preview') }}</label>
        <div class="col-12 py-0">
          <img :src="imagePreview" class="col-6 px-0">
        </div>
        <has-error :form="form" field="email" class="d-block pl-3 text-left"/>
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
    return { title: this.$t('edit_profile') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      img: ''
    }),
    imagePreview: ''
  }),

  computed: {
    routeName () {
      return this.$route.name
    },
    ...mapGetters({
      user: 'auth/user'
    })
  },

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  methods: {
    imageUpload (image) {
      let fileReader = new FileReader()
      if(image && image.type.match('image.*')) {
        fileReader.readAsDataURL(image)
        fileReader.onload = () => {
          this.imagePreview = fileReader.result
        }
        this.form.img = image
      }
    },

    async update () {
      this.form._method = 'PATCH'
      try {
        await this.form.submit('post', '/api/settings/profile', {
          transformRequest: [(data, headers) => objectToFormData(data)]
        })
        this.$store.dispatch('auth/fetchUser')
      } catch (e) {
        console.log(e)
      } 
    }
  }
}
</script>
