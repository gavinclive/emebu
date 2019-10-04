<template>
  <div>
    <form class="col-12 mx-auto py-0" @submit.prevent="update" @keydown="form.onKeydown($event)" novalidate>
      <alert-success :form="form" :message="$t('info_updated')" />

      <v-stepper v-model="e1" class="stepper" vertical>
        <v-stepper-step class="px-0 pt-0" :complete="e1 > 1" step="1">{{ $t('basic_info') }}</v-stepper-step>

        <v-stepper-content class="px-0" step="1">

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-11 d-block pt-0 col-form-label">{{ $t('event_title') }}</label>
              <div class="col-11 d-flex align-items-center py-1">
                <input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control col-12" type="text" name="title" :placeholder="$t('event_title_placeholder')">
              </div>
              <has-error :form="form" field="title" class="d-block pl-3 text-left"/>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-11 d-block pt-0 col-form-label">{{ $t('type') }}</label>
              <div class="col-11 d-flex align-items-center py-1" @click="showTypeModal">
                <input v-model="activeType" class="form-control" name="type">
                <div class="input-group-append">
                  <span class="input-group-text">Choose</span>
                </div>
              </div>
              <has-error :form="form" field="type" class="d-block pl-3 text-left"/>
            </div>
          </div>

          <div class="modal fade" id="eventType" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle">{{ $t('type') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body d-flex justify-content-center flex-wrap">
                  <div class="position-relative text-center" v-for="(type, index) in types" :key="index">
                    <div class="modal-icon-container m-1 rounded-lg" width="140" height="140" data-dismiss="modal" @click="setType(index)">
                      <v-img class="modal-icon" :src="type.image" width="140" height="140" cover></v-img>
                      <span class="position-absolute modal-icon-name">{{ type.name }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-11 d-block pt-0 col-form-label">{{ $t('category') }}</label>
              <div class="col-11 d-flex align-items-center py-1" @click="showCategoryModal">
                <input v-model="activeCategory" class="form-control" name="category">
                <div class="input-group-append">
                  <span class="input-group-text">Choose</span>
                </div>
              </div>
              <has-error :form="form" field="category" class="d-block pl-3 text-left"/>
            </div>
          </div>

          <div class="modal fade" id="eventCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalScrollableTitle">{{ $t('category') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body d-flex justify-content-center flex-wrap">
                  <div class="position-relative text-center" v-for="(category, index) in categories" :key="index">
                    <div class="modal-icon-container m-1 rounded-lg" width="140" height="140" data-dismiss="modal" @click="setCategory(index)">
                      <v-img class="modal-icon" :src="category.image" width="140" height="140" cover></v-img>
                      <span class="position-absolute modal-icon-name">{{ category.name }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </v-stepper-content>

        <v-stepper-step class="px-0" :complete="e1 > 2" step="2">{{ $t('date_n_time') }}</v-stepper-step>
        
        <v-stepper-content class="px-0" step="2">

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-12 d-block pt-0 col-form-label mx-auto">{{ $t('event_start') }}</label>
              <div class="col-11 d-flex align-items-center py-1">
                <datetime type="datetime" :week-start="1" :minute-step="30" v-model="form.startTime" :class="{ 'is-invalid': form.errors.has('endTime') }" class="form-control theme-blue col-md-11 mx-auto"></datetime>
              </div>
              <has-error :form="form" field="startTime" class="d-block pl-3 text-left"/>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-12 d-block pt-0 col-form-label mx-auto">{{ $t('event_end') }}</label>
              <div class="col-11 d-flex align-items-center py-1">
                <datetime type="datetime" :week-start="1" :minute-step="30" v-model="form.endTime" :class="{ 'is-invalid': form.errors.has('endTime') }" class="form-control theme-blue col-md-11 mx-auto"></datetime>
              </div>
              <has-error :form="form" field="endTime" class="d-block pl-3 text-left"/>
            </div>
          </div>
        </v-stepper-content>

        <v-stepper-step class="px-0" :complete="e1 > 3" step="3">{{ $t('location') }}</v-stepper-step>
        
        <v-stepper-content class="px-0" step="3">
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-12 d-block pt-0 col-form-label mx-auto">{{ $t('venue') }}</label>
              <div class="col-11 d-flex align-items-center py-1 px-0">
               <GmapMap
                class="mx-auto col-11"
                :center="latLng"
                :zoom="zoom"
                style="width: 100%; height: 425px"
                :options="{
                  streetViewControl: false,
                  mapTypeControl: false,
                  fullscreenControl: false,
                  zoomControl: false
                }"
              >
                <GmapMarker
                  v-if="showMarker"
                  :position="marker.position"
                  :clickable="true"
                  :draggable="false"
                />
              </GmapMap>
              </div>
              <div class="col-11 d-flex align-items-center py-1">
                <gmap-autocomplete class="form-control col-12 mx-auto" @place_changed="setPlace" :placeholder="$t('venue_placeholder')" name="venue"/>
              </div>
              <has-error :form="form" field="location" class="d-block pl-3 text-left"/>
            </div>
          </div>

        </v-stepper-content>

        <v-stepper-step class="px-0" :complete="e1 > 4" step="4">{{ $t('main_event_img') }}</v-stepper-step>
         
        <v-stepper-content class="px-0" step="4">

          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-10 py-0 justify-content-center">
              <div class="col-11 d-flex align-items-center py-1 px-0">
                <div class="custom-file col-11 mx-auto">
                  <input type="file" accept="image/*" class="custom-file-input" @change="imageUpload($event.target.files[0])">
                  <label class="custom-file-label">{{ $t('choose_file') }}</label>
                </div>
              </div>
              <label v-if="imagePreview" class="col-12 d-block col-form-label mx-auto">{{ $t('image_preview') }}</label>
              <div class="col-12 d-flex align-items-center py-0">
                <img :src="imagePreview" class="col-12 px-0">
              </div>
              <has-error :form="form" field="type" class="d-block pl-3 text-left"/>
            </div>
          </div>

        </v-stepper-content>

        <v-stepper-step class="px-0" :complete="e1 > 5" step="5">{{ $t('summary') }}</v-stepper-step>
        
        <v-stepper-content class="px-0" step="5">
          
          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-10 py-0 justify-content-center">
              <div class="col-11 d-flex align-items-center pt-1 pb-0">
                <textarea v-model="form.summary" class="form-control col-md-11 mx-auto" maxlength="150" rows="4" style="resize: none;" placeholder="Write a short event summary to get attendees excited." name="summary"></textarea>
              </div>
              <div class="col-11 py-1" v-if="form.summary && form.summary.length">
                <div class="col-md-11 mx-auto py-0 px-0 text-right" :class="{ 'text-danger': form.summary.length === 150 }">{{ form.summary.length }}/150</div>
              </div>
              <has-error :form="form" field="title" class="d-block pl-3 text-left"/>
            </div>
          </div>

        </v-stepper-content>

        <v-stepper-step class="px-0" :complete="e1 > 6" step="6">{{ $t('description') }}</v-stepper-step>
        
        <v-stepper-content class="px-0" step="6">

          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-10 py-0 justify-content-center">
              <div class="col-11 d-flex align-items-center py-1">
                <div class="col-11 mx-auto px-0">
                  <vue-editor v-model="form.description" useCustomImageHandler @image-added="handleImageAdded" :editorToolbar="customToolbar" />
                  <has-error :form="form" field="description" />
                </div>
              </div>
            </div>
          </div>

        </v-stepper-content>

        <v-stepper-step class="px-0" :complete="e1 > 7" step="7">{{ $t('tickets') }}</v-stepper-step>

        <v-stepper-content class="px-0" step ="7">

          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-10 py-0 justify-content-center">
              <div class="col-11 d-flex align-items-center py-1">
                <div v-if="!form.ticket || form.ticket.length < 1" class="col-md-11 mx-auto text-center">
                  <img src="/dist/assets/movie-tickets.svg" width="100" class="my-4"/>
                  <h5>{{ $t('no_ticket_set') }}</h5>
                </div>
                <div v-else class="col-11 mx-auto text-center">
                  <v-card v-for="(ticket, index) in form.ticket" :key="index" class="ticket mb-2">
                    <v-card-title>{{ ticket.name }}</v-card-title>
                    <v-card-text class="pb-0">
                      <p class="text-left">{{ ticket.desc }}</p>
                      <h5><p class="text-right my-0">{{ ticket.price === 0 ? 'FREE' : 'Rp ' + ticket.price }}</p></h5>
                    </v-card-text>
                    <v-card-actions class="d-flex align justify-content-end">
                      <img class="mx-3" src='/dist/assets/edit-2.svg' height="20" @click="editTicket(index)">
                      <img class="mx-1" src='/dist/assets/trash-2.svg' height="20" @click="removeTicket(index)">
                    </v-card-actions>
                  </v-card>
                </div>
              </div>
              <has-error :form="form" field="title" class="d-block pl-3 text-left"/>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center mt-3 mx-0 col-11">
            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addTicket" @click="initAddTicket">
              {{ $t('add') + ' ' + $t('ticket') }}
            </button>
          </div>

          <div class="modal fade" id="addTicket" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addTicketTitle">{{ $t('tickets') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <ul class="nav nav-pills nav-fill">
                    <li class="nav-item" @click="tempTicket.type = 1, tempTicket.price = 1000">
                      <a class="nav-link" :class="{ 'active': tempTicket.type === 1 }">{{ $t('paid') }}</a>
                    </li>
                    <li class="nav-item" @click="tempTicket.type = 2, tempTicket.price = 0">
                      <a class="nav-link" :class="{ 'active': tempTicket.type === 2 }">{{ $t('free') }}</a>
                    </li>
                  </ul>
                  <div class="col-12 form-group pt-4 pb-1 px-0 my-0">
                    <label>{{ $t('ticket_name') }}</label>
                    <input v-model="tempTicket.name" class="form-control col-12 mx-auto" type="text" maxlength="50" required>
                  </div>
                  <div class="col-12 form-group px-0 py-1 my-0">
                    <label>{{ $t('quantity') }}</label>
                    <input v-model="tempTicket.qty" class="form-control col-12 mx-auto" type="number" required>
                  </div>
                  <div v-if="tempTicket.type === 1" class="col-12 form-group px-0 py-1 my-0">
                    <label>{{ $t('price') }}</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input v-model="tempTicket.price" type="number" class="form-control" min="1000" required>
                    </div>
                  </div>
                  <div class="col-12 form-group px-0 py-1 my-0">
                    <label>{{ $t('sales_start') }}</label>
                    <VueCtkDateTimePicker right v-model="tempTicket.startTime" :first-day-of-week=1 :locale="language.includes('id') ? 'id' : 'en'" :minute-interval=30 required>
                      <input class="form-control mx-auto">
                    </VueCtkDateTimePicker>
                  </div>
                  <div class="col-12 form-group px-0 py-1 my-0">
                    <label>{{ $t('sales_end') }}</label>
                    <VueCtkDateTimePicker right v-model="tempTicket.endTime" :first-day-of-week=1 :locale="language.includes('id') ? 'id' : 'en'" :minute-interval=30 required>
                      <input class="form-control mx-auto">
                    </VueCtkDateTimePicker>
                  </div>
                  <div class="col-12 form-group px-0 py-1 my-0">
                    <label>{{ $t('description') }}</label>
                    <textarea v-model="tempTicket.desc" class="form-control col-12 mx-auto" maxlength="150" rows="4" style="resize: none;"></textarea>
                    <p class="text-right my-0">{{ tempTicket.desc.length }}/150</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" @click="addTicket" :disabled="ticketInvalid">{{ $t('save') }}</button>
                </div>
              </div>
            </div>
          </div>

        </v-stepper-content>
      
        <v-stepper-step class="px-0" :complete="e1 > 8" step="8">All set, you can create your event now</v-stepper-step>

        <v-stepper-content class="px-0" step="8">
          <div class="form-group row d-flex col-11 mx-0 pl-0 justify-content-center">
            <div class="col-md-10 py-0 justify-content-center">
              <div class="col-12 py-1 px-0 mx-auto">
                <v-button :loading="form.busy" type="success" class="col-12">
                  {{ $t('create') }}
                </v-button>
              </div>
            </div>
          </div>
        </v-stepper-content>

      </v-stepper>
      <div v-if="e1 < 8" class="form-group fixed-bottom row d-flex my-0 mx-0 py-0 col-12 bg-light">
        <div class="d-flex col-12 px-0 d-flex justify-content-between mr-0">
          <button class="btn btn-primary col-5" @click="e1++" type="button">
            {{ $t('continue') }}
          </button>
          <button class="btn btn-secondary col-5" @click="e1 > 1 ? e1-- : $router.go(-1)" type="button">
            {{ $t('cancel') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import $ from 'jquery'
import axios from 'axios'
import store from '~/store'
import Form from 'vform'
import { mapGetters } from 'vuex'
import { VueEditor } from 'vue2-editor'
import { BASE_URL } from '~/utils/constant'

export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('edit_profile') }
  },

  components: {
    VueEditor
  },

  data: () => ({
    e1: 1,
    form: new Form({
      title: '',
      startTime: '',
      endTime: '',
      location: '',
      summary: '',
      description: '',
      img: '',
      ticket: []
    }),
    imagePreview: '',
    latLng: {lat:0.7, lng:118.9},
    address: '',
    zoom: 3.75,
    showMarker: false,
    tempTicket: {
      name: '',
      type: 1,
      qty: '',
      price: 1000,
      startTime: '',
      endTime: '',
      desc: ''
    },
    ticket: [],
    paid: true,
    removeIndex: '',
    type: '',
    category: '',
    customToolbar: [
      ["bold", "italic", "underline"],
      [{ list: "ordered" }, { list: "bullet" }],
      ["image", "video"]
    ]
  }),

  
  mounted () {
    store.dispatch('category/fetchCategories')
    store.dispatch('type/fetchTypes')
  },

  computed: {
    routeName () {
      return this.$route.name
    },

    ...mapGetters({
      user: 'auth/user',
      categories: 'category/getCategories',
      types: 'type/getTypes'
    }),

    marker () {
      return {
        position: this.latLng,
        opacity: 1,
        draggable: true,
        enabled: true,
        dragended: 0
      }
    },

    language () {
      return navigator.language
    },

    activeType () {
      return this.type ? this.types[this.type].name : ''
    },

    activeCategory () {
      return this.category ? this.categories[this.category].name : ''
    },

    ticketInvalid () {
      return (this.tempTicket.name && this.tempTicket.type && this.tempTicket.qty && this.tempTicket.startTime && this.tempTicket.endTime) ? false : true 
    }
  },

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  methods: {
    setType (index) {
      this.type = index
      this.form.type = this.types[index].id
    },

    setCategory (index) {
      this.category = index
      this.form.category = this.categories[index].id
    },

    showTypeModal () {
      $('#eventType').modal('show')
    },

    showCategoryModal () {
      $('#eventCategory').modal('show')
    },

    reverseGeocode (coordinates) {
      axios
        .get()
          .then(response => {
            console.log(response.data)
        })
        .catch(error => {
          console.log(error)
        })
        .finally(() => this.loading = false)
    },

    setPlace (place) {
      if (!place) return
      this.showMarker = true
      this.latLng = {
        lat: place.geometry.location.lat(),
        lng: place.geometry.location.lng(),
      }
      this.zoom = 14
      axios.get(`https://maps.google.com/maps/api/geocode/json?latlng=${this.latLng.lat},${this.latLng.lng}&key=AIzaSyAyhAP-kfAQ9xqD6jEhwnQPkAmxFSNIxZI`)
        .then(response => {
          console.log(response.data)
        })
        .catch(error => {
          console.log(error)
        })
    },

    updateChild (object, field, event) {
      console.log(object)
      return
      if (field === 'position') {
        object.position = {
          lat: event.lat(),
          lng: event.lng()
        }
      }
      this.address = object.position
    },

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

    handleImageAdded (file, Editor, cursorLocation, resetUploader) {
      const form = new Form({
        image: ''
      })
      form.image = file
      if(form.image) {
        form.submit('post', '/api/quill', {
          transformRequest: [(data, headers) => objectToFormData(data)]
        }).then(res => {
          Editor.insertEmbed(cursorLocation, 'image', `${BASE_URL}/storage/quill/${res.data[0]}`)
          resetUploader()
        }).catch(err => {
          console.log(err)
        })
      }
    },

    addTicket () {
      const obj = {
        name: this.tempTicket.name,
        type: this.tempTicket.type,
        qty: this.tempTicket.qty,
        price: this.tempTicket.price,
        startTime: this.tempTicket.startTime,
        endTime: this.tempTicket.endTime,
        desc: this.tempTicket.desc
      }
      if (this.removeIndex) {
        this.ticket.splice(this.removeIndex)
        this.removeIndex = ''
      }
      this.ticket.push(obj)
      this.form.ticket = this.ticket
      setTimeout( () => {
        this.initAddTicket()
      }, 500)
    },

    initAddTicket () {
      this.tempTicket.name = ''
      this.tempTicket.type = 1
      this.tempTicket.qty = ''
      this.tempTicket.price = 1000
      this.tempTicket.startTime = ''
      this.tempTicket.endTime = ''
      this.tempTicket.desc = ''
    },

    editTicket (index) {
      this.tempTicket = this.form.ticket[index]
      $('#addTicket').modal('show')
      this.removeIndex = index
    },

    removeTicket (index) {
      this.ticket.splice(index, 1)
      this.form.ticket = this.ticket
    },

    async update () {
      this.form.location = `${this.latLng.lat}, ${this.latLng.lng}`
      try {
        await this.form.submit('post', '/api/event', {
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
