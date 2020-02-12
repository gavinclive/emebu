<template>
  <div class="col-12 d-flex justify-content-center p-0" style="margin-top: -.1rem !important;">
    <div class="col-12 col-md-6 p-0 text-center">
      <div v-if="user.role == 2" class="col-12 text-center">
        {{ $t('you_are_logged_in') }}
      </div>
      <div v-if="user.role == 1" class="col-12 p-0">
        <carousel
          :per-page="1"
          :mouse-drag="false"
          :autoplay="true"
          :loop="true"
          :paginationEnabled="false">
          <slide v-for="(feat, index) in featured" :key="index">
            <img :src="featImageUrl(feat.content)" width="100%" height="350" contain class="feat-slide">
          </slide>
        </carousel>
      </div>
      <div v-if="user.role > 2" class="col-12 text-center">
        <h5>You are rated</h5>
        <div class="d-flex justify-content-center align-items-center">
          <img :src="rating > 3 ? '/dist/assets/thumbs-up.svg' : '/dist/assets/frown.svg'" height="31">
          <star-rating
            v-model="rating"
            active-color="#258efe"
            :read-only="true"
            :round-start-rating="false"
            :rounded-corners="true"
            text-class="rating-score"
            class="d-flex justify-content-center ml-1 mb-3"
            :star-size="40" /> 
        </div>
        <h5>by your event attendees.</h5>
      </div>
      <div v-if="user.role == 3" class="col-12 text-center">
        <v-divider />
        <img src="/dist/assets/smile.svg" width="60">
        <p>{{ $t('lets_premium') }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import store from '~/store'
import { Carousel, Slide } from 'vue-carousel'
import axios from 'axios'
import StarRating from 'vue-star-rating'
import { featImageUrl } from '~/utils/image'

export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },

  components: {
    Carousel,
    Slide,
    StarRating
  },

  beforeRouteEnter (to, from, next) {
    if (store.getters['auth/user'].role === '2') next({ name: 'content.admin' })
    else if (store.getters['auth/user'].role === '1'){
      axios.get('/api/featured')
      .then(res => next( vm => vm.featured = res.data.result))
    } else {

      store.dispatch('rating/fetchEoRating', store.getters['auth/user'].id)
      .then(() => next())
    }
  },

  data: () => ({
    featured: null
  }),

  computed: {
    ...mapGetters ({
      user: 'auth/user',
      score: 'rating/eoRating'
    }),

    rating () {
      const rating = this.score
      return parseFloat(rating).toFixed(2)
    }
  },

  methods: {
    featImageUrl
  },
}
</script>
