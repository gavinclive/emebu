<template>
  <div class="pb-5">
    <div class="accordion" id="accordionExample">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Featured Event
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
            <form @submit.prevent="saveFeaturedEvent" @keydown="form.onKeydown($event)">
              <div v-for="(feat, index) in form.img" :key="index" class="col-12 form-group p-0">
                <div class="py-1 px-0 my-0 d-flex align-items-center">
                  <label class="col-3 mb-0">Event #{{ index + 1 }}</label>
                  <div class="custom-file col-9 mx-auto">
                    <input type="file" accept="image/*" class="custom-file-input" @change="imageUpload($event.target.files[0], index)">
                    <label class="custom-file-label">{{ $t('choose_file') }}</label>
                  </div>
                </div>
                <div v-if="imagePreview[index]" class="col-12 d-flex align-items-center py-0">
                  <img :src="imagePreview[index]" class="col-12 px-0">
                </div>
              </div>
              <button type="submit" class="btn col-12 py-2 btn-primary">
                {{ $t('save') }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import store from '~/store'
import Form from 'vform'
import { featImageUrl } from '~/utils/image'

export default {
  data: () => ({
    form: new Form({
      img: [],
      media_upload: [false, false, false, false, false]
    }),
    imagePreview: []
  }),

  beforeRouteEnter (to, from, next) {
    store.dispatch('event/fetchFeaturedEvents')
    .then( () => next( vm => {
      vm.setFeaturedEvent()
    }))
  },

  computed: {
    ...mapGetters({
      featuredEvents: 'event/events'
    }),
  },

  methods: {
    setFeaturedEvent() {
      this.featuredEvents.forEach( data => {
        this.form.img.push(data.content)
        this.imagePreview.push(featImageUrl(data.content))
      })
      while (this.form.img.length < 5) {
        this.form.img.push('')
      }
      this.imagePreview.length = 5
    },

    saveFeaturedEvent() {
      this.form.submit('post', '/api/featured', {
        transformRequest: [(data, headers) => objectToFormData(data)]
      })
    },

    imageUpload (image, index) {
      let fileReader = new FileReader()
      if(image && image.type.match('image.*')) {
        fileReader.readAsDataURL(image)
        fileReader.onload = () => {
          this.imagePreview[index] = fileReader.result
          this.form.media_upload[index] = true
          const temp = this.form.img
          this.form.img = []
          this.form.img = temp
        }
        this.form.img[index] = image
      }
    }
  }
}
</script>
