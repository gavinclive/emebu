<template>
  <div>
    <div class="row col-12 mx-0 pt-0 px-2">
      <div class="input-group col-md-6 pb-2 px-0 px-md-1 mx-auto bg-light" :class="{ 'fixed-top d-md-none px-2': offsetY > 100}">
        <input v-model="searchName" class="form-control">
        <div class="input-group-append" @click="search">
          <span class="input-group-text"><img src="/dist/assets/search.svg"></span>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-10 mx-auto">
      <div class="col-12 d-flex px-0 mx-auto" :class="{ 'border-top': index > 0 }" v-for="(user, index) in pageList" :key="index">
        <div>
          <v-img :src="user.image" width="75" height="75" class="rounded-circle" cover/>
        </div>
        <v-divider vertical class="my-0 mx-2"/>
        <div class="py-0 px-0 col-6">
          <p class="text-truncate mb-0">{{ user.name ? user.name : '-' }}</p>
          <p class="text-truncate mb-0">{{ user.username ? user.username : '-' }}</p>
          <p class="text-truncate mb-0">{{ user.email }}</p>
        </div>
        <v-divider vertical class="my-0 mx-2"/>
        <div class="flex-grow-1">
          <p class="text-center">{{ role[user.role-1] }}</p>
          <div class="d-flex justify-content-around">
            <img src="/dist/assets/slash.svg">
            <img src="/dist/assets/trash-2.svg">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '~/store'
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',

  data: () => ({
    userData: [],
    searchName: '',
    page: 1,
    lastPage: null,
    role: ['EO', 'User'],
    offsetY: ''
  }),

  async beforeRouteEnter (to, from, next) {
    try {
      await store.dispatch('admin/fetchUsers')
    } catch (e) {
      console.log(e)
    }
    next()
  },

  mounted () {
    this.scroll()
  },

  computed: {
    users () {
      const data = this.$store.getters['admin/users']
      return data
    },

    pageList () {
      if (this.page === 1) {
        this.userData = []
        this.lastPage = null
      }

      if (this.users.current_page === this.page) {
        this.lastPage = this.lastPage ? this.lastPage : this.users.last_page
        this.users.data.forEach( arr => {
          this.userData.push(arr)
        })
      }

      return this.userData
    }
  },

  methods: {
    scroll () {
      window.onscroll = () => {
        this.offsetY = window.pageYOffset
        let bottomOfWindow = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) + window.innerHeight === document.documentElement.offsetHeight

        if (bottomOfWindow  && this.page <= this.lastPage) {
          this.page++
          setTimeout( () => {
            store.dispatch('admin/fetchUsers', this.page)
          }, 1500)
        }
      }
    },
    search () {
      this.page = 1
      this.userData = []
      this.lastPage = null
      store.dispatch('admin/fetchUsersByName', { page: this.page, param: this.searchName })
    }
  }

}
</script>