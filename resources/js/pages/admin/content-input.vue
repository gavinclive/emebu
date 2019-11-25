<template>
  <div>
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
              <div v-for="(feat, index) in form.id" :key="index" class="col-12 form-group py-1 px-0 my-0 d-flex align-items-center">
                <label class="col-3 mb-0">Event #{{ index }}</label>
                <input class="form-control expand" v-model="form.id[index]">
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

export default {
  data: () => ({
    form: new Form({
      id: []
    })
  }),

  beforeRouteEnter (to, from, next) {
    store.dispatch('event/fetchFeaturedEvents')
    .then( () => next( vm => {
      vm.setFeaturedEvent()
    }))
  },

  computed: mapGetters({
    featuredEvents: 'event/events'
  }),

  methods: {
    setFeaturedEvent() {
      this.featuredEvents.forEach( data => this.form.id.push(data.content))
      this.form.id.length = 5
    },

    saveFeaturedEvent() {
      this.form.post('/api/featured')
    }
  }
}
</script>
