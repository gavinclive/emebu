<template>
  <div>
    <form class="col-12 mx-auto py-0" @submit.prevent="update" @keydown="form.onKeydown($event)" novalidate>

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
                <input disabled v-model="activeType" class="form-control" name="type">
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
                <input disabled v-model="activeCategory" class="form-control" name="category">
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
              <label class="col-12 d-block pt-0 col-form-label mx-auto">{{ $t('event_publish') }}</label>
              <div class="col-11 d-flex align-items-center py-1">
                <datetime type="datetime" :week-start="1" :minute-step="30" v-model="form.publish_time" :class="{ 'is-invalid': form.errors.has('publish_time') }" class="form-control theme-blue col-md-11 mx-auto d-flex align-items-center"></datetime>
              </div>
              <has-error :form="form" field="publish_time" class="d-block pl-3 text-left"/>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-12 d-block pt-0 col-form-label mx-auto">{{ $t('event_start') }}</label>
              <div class="col-11 d-flex align-items-center py-1">
                <datetime type="datetime" :week-start="1" :minute-step="30" v-model="form.start_time" :class="{ 'is-invalid': form.errors.has('start_time') }" class="form-control theme-blue col-md-11 mx-auto d-flex align-items-center"></datetime>
              </div>
              <has-error :form="form" field="start_time" class="d-block pl-3 text-left"/>
            </div>
          </div>

          <div class="form-group row d-flex justify-content-center">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-12 d-block pt-0 col-form-label mx-auto">{{ $t('event_end') }}</label>
              <div class="col-11 d-flex align-items-center py-1">
                <datetime type="datetime" :week-start="1" :minute-step="30" v-model="form.end_time" :class="{ 'is-invalid': form.errors.has('end_time') }" class="form-control theme-blue col-md-11 mx-auto d-flex align-items-center"></datetime>
              </div>
              <has-error :form="form" field="end_time" class="d-block pl-3 text-left"/>
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
              <div class="col-11 py-1" v-if="address">
                {{ $t('location') }}: {{ address }}
              </div>
              <div class="col-11 d-flex align-items-center py-1">
                <gmap-autocomplete class="form-control col-12 mx-auto" @place_changed="setPlace" :placeholder="$t('venue_placeholder')" name="venue"/>
              </div>
              <has-error :form="form" field="location" class="d-block pl-3 text-left"/>
            </div>

            <div class="form-group col-12 p-0 d-flex justify-content-center">
              <div class="col-md-10 py-0 justify-content-center">
                <div class="col-11 d-flex align-items-center pb-0">
                  <textarea v-model="form.location_guide" class="form-control col-md-11 mx-auto" maxlength="150" rows="4" style="resize: none;" :placeholder="$t('address_placeholder')" name="summary"></textarea>
                </div>
                <div class="col-11 py-1" v-if="form.location_guide && form.location_guide.length">
                  <div class="col-md-11 mx-auto py-0 px-0 text-right" :class="{ 'text-danger': form.location_guide.length === 150 }">{{ form.location_guide.length }}/150</div>
                </div>
                <has-error :form="form" field="location_guide" class="d-block pl-3 text-left"/>
              </div>
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

          <div class="form-group row d-flex justify-content-center mb-0">
            <div class="col-md-10 py-0 justify-content-center">
              <label class="col-12 d-block pt-0 col-form-label mx-auto">{{ $t('panoramic_image') }}</label>
              <div class="col-11 d-flex align-items-center py-1 px-0">
                <div class="custom-file col-11 mx-auto">
                  <input type="file" accept="image/*" class="custom-file-input" @change="imageUpload2($event.target.files[0])">
                  <label class="custom-file-label">{{ $t('choose_file') }}</label>
                </div>
              </div>
              <label v-if="imagePreview2" class="col-12 d-block col-form-label mx-auto">{{ $t('image_preview') }}</label>
              <div class="col-12 d-flex align-items-center py-0">
                <img :src="imagePreview2" class="col-12 px-0">
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
                <div v-else class="col-12 mx-0 p-0 text-center">
                  <v-card v-for="(ticket, index) in form.ticket" :key="index" class="ticket mb-2">
                    <v-card-title>{{ ticket.name }}</v-card-title>
                    <v-card-text class="pb-0">
                      <p class="text-left">{{ ticket.desc }}</p>
                      <h5><p class="text-right my-0">{{ ticket.price === 0 ? 'FREE' : 'Rp ' + ticket.price }}</p></h5>
                    </v-card-text>
                    <v-card-actions class="d-flex align justify-content-end">
                      <img class="mx-3" src='/dist/assets/edit.svg' height="20" @click="editTicket(index)">
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
                    <li class="nav-item" @click="tempTicket.price = 1000">
                      <a class="nav-link" :class="{ 'active': tempTicket.price > 0 }">{{ $t('paid') }}</a>
                    </li>
                    <li class="nav-item" @click="tempTicket.price = 0">
                      <a class="nav-link" :class="{ 'active': tempTicket.price == 0 }">{{ $t('free') }}</a>
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
                  <div v-if="tempTicket.price > 0" class="col-12 form-group px-0 py-1 my-0">
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
                    <datetime type="datetime" :week-start="1" :minute-step="30" v-model="tempTicket.start_time" class="form-control theme-blue mx-auto"></datetime>
                  </div>
                  <div class="col-12 form-group px-0 py-1 my-0">
                    <label>{{ $t('sales_end') }}</label>
                    <datetime type="datetime" :week-start="1" :minute-step="30" v-model="tempTicket.end_time" class="form-control theme-blue mx-auto"></datetime>
                  </div>
                  <div class="col-12 form-group px-0 py-1 my-0">
                    <label>{{ $t('description') }}</label>
                    <textarea v-model="tempTicket.description" class="form-control col-12 mx-auto" maxlength="150" rows="4" style="resize: none;"></textarea>
                    <p class="text-right my-0">{{ tempTicket.description.length }}/150</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" @click="addTicket" :disabled="!ticketValid">{{ $t('save') }}</button>
                </div>
              </div>
            </div>
          </div>

        </v-stepper-content>

      </v-stepper>
      <div class="form-group fixed-bottom row d-flex my-0 mx-0 py-0 col-12 bg-light">
        <div class="d-flex col-12 px-0 d-flex justify-content-between mr-0">
          <button v-if="e1 < 7" class="btn btn-primary col-5" @click="e1++" type="button">
            {{ $t('continue') }}
          </button>
          <v-button :loading="form.busy" class="col-5" type="success" v-if="e1 === 7">
            {{ form.id ? $t('save') : $t('create') }}
          </v-button>
          <button class="btn btn-secondary col-5" @click="e1 > 1 ? e1-- : $router.go(-1)" type="button">
            {{ e1 > 1 ? $t('back') : $t('cancel') }}
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
import router from '~/router'
import Form from 'vform'
import { mapGetters } from 'vuex'
import { VueEditor } from 'vue2-editor'
import { BASE_URL } from '~/utils/constant'
import { encrypt, decrypt } from '~/utils/simpleCrypto'
import { eventImageUrl } from '~/utils/image'

export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('create') }
  },

  components: {
    VueEditor
  },

  data: () => ({
    e1: 1,
    form: new Form({
      id: '',
      title: '',
      publish_time: '',
      start_time: '',
      end_time: '',
      location: '',
      location_guide: '',
      summary: '',
      description: '',
      image: '',
      image_3d: '',
      ticket: [],
      eo_id: '',
      type_id: '',
      category_id: ''
    }),
    imagePreview: '',
    imagePreview2: '',
    latLng: {lat:0.7, lng:118.9},
    zoom: 3.75,
    showMarker: false,
    tempTicket: {
      name: '',
      price: 1000,
      start_time: '',
      end_time: '',
      description: ''
    },
    address: '',
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

  beforeRouteEnter (to, from, next) {
    store.dispatch('category/fetchCategories')
    .then( () => store.dispatch('type/fetchTypes'))
    .then( () => {
      if (to.name.includes('edit')) {
        store.dispatch('event/fetchEventById', decrypt(to.params.id))
        .then(() => next( vm => vm.setEventDetail()))
      } else {
        next (vm => vm.form.id = '')
      }
    })
  },

  computed: {
    routeName () {
      return this.$route.name
    },

    ...mapGetters({
      user: 'auth/user',
      eventDetail: 'event/eventDetail',
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
      return this.type !== '' ? this.types[this.type].name : ''
    },

    activeCategory () {
      return this.category !== '' ? this.categories[this.category].name : ''
    },

    ticketValid () {
      const {
        name,
        qty,
        start_time,
        end_time
      } = this.tempTicket
      return name && qty && start_time && end_time
    }
  },

  methods: {
    setType (index) {
      this.type = index
      this.form.type_id = this.types[index].id
    },

    setCategory (index) {
      this.category = index
      this.form.category_id = this.categories[index].id
    },

    showTypeModal () {
      $('#eventType').modal('show')
    },

    showCategoryModal () {
      $('#eventCategory').modal('show')
    },

    setPlace (place) {
      if (!place) return
      this.showMarker = true
      this.latLng = {
        lat: place.geometry.location.lat(),
        lng: place.geometry.location.lng(),
      }
      this.zoom = 14
    },

    imageUpload (image) {
      let fileReader = new FileReader()
      if(image && image.type.match('image.*')) {
        fileReader.readAsDataURL(image)
        fileReader.onload = () => {
          this.imagePreview = fileReader.result
        }
        this.form.image = image
      }
    },

    imageUpload2 (image) {
      let fileReader = new FileReader()
      if(image && image.type.match('image.*')) {
        fileReader.readAsDataURL(image)
        fileReader.onload = () => {
          this.imagePreview2 = fileReader.result
        }
        this.form.image_3d = image
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
        id: this.tempTicket.id,
        name: this.tempTicket.name,
        qty: this.tempTicket.qty,
        price: this.tempTicket.price.toString(),
        start_time: this.tempTicket.start_time,
        end_time: this.tempTicket.end_time,
        description: this.tempTicket.description
      }
      if (this.removeIndex) {
        this.ticket.splice(this.removeIndex - 1, 1)
        this.removeIndex = ''
      }
      this.ticket.push(obj)
      this.form.ticket = this.ticket
      setTimeout( () => {
        this.initAddTicket()
      }, 500)
    },

    initAddTicket () {
      this.tempTicket.qty = 0
      this.tempTicket.name = ''
      this.tempTicket.qty = ''
      this.tempTicket.price = 1000
      this.tempTicket.start_time = ''
      this.tempTicket.end_time = ''
      this.tempTicket.description = ''
    },

    editTicket (index) {
      this.tempTicket = this.form.ticket[index]
      $('#addTicket').modal('show')
      this.removeIndex = index + 1
    },

    removeTicket (index) {
      this.ticket.splice(index, 1)
      this.form.ticket = this.ticket
    },

    setEventDetail () {
      this.form.keys().forEach( key => this.form[key] = this.eventDetail[0][key])
      this.type = parseInt(this.form['type_id'])
      this.category = parseInt(this.form['category_id'])
      this.form.publish_time = new Date(this.form.publish_time).toISOString()
      this.form.start_time = new Date(this.form.start_time).toISOString()
      this.form.end_time = new Date(this.form.end_time).toISOString()
      const coordinate = this.form.location.split(', ')
      this.showMarker = true
      this.zoom = 14
      this.latLng = {
        lat: parseFloat(coordinate[0]),
        lng: parseFloat(coordinate[1]),
      }
      axios.get(`https://maps.google.com/maps/api/geocode/json?latlng=${this.latLng.lat},${this.latLng.lng}&key=AIzaSyAyhAP-kfAQ9xqD6jEhwnQPkAmxFSNIxZI`)
      .then(response => {
        this.address = response.data.results[0].formatted_address
      })
      .catch(error => {
        console.log(error)
      })
      this.imagePreview = this.form.image ? eventImageUrl(this.form.image) : ''
      this.imagePreview2 = this.form.image_3d ? eventImageUrl(this.form.image_3d) : ''
      this.form.ticket.forEach( ticket => {
        ticket.start_time = new Date(ticket.start_time).toISOString()
        ticket.end_time = new Date(ticket.end_time).toISOString()
      })
    },

    update () {
      if (this.form.id) {
        this.form._method = 'PATCH'
      } else {
        delete this.form.id
      }
      this.form.location = `${this.latLng.lat}, ${this.latLng.lng}`
      this.form.eo_id = this.user.id
      this.form.submit('post', `/api/event${this.form.id ? `/${this.form.id}` : ''}`, {
          transformRequest: [(data, headers) => objectToFormData(data)]
      })
        .then( res => {
          this.$store.dispatch('auth/fetchUser')
          router.push({ name: 'event.detail', params: { id: encrypt(res.data.result ? res.data.result : this.form.id) } })
        })
    }
  }
}
</script>
