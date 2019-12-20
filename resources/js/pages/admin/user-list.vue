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
    <div
      class="col-12 col-md-10 mx-auto"
      v-infinite-scroll="loadMore"
      infinite-scroll-distance="0">
      <div class="col-12 d-flex px-0 mx-auto" :class="{ 'border-top': index > 0 }" v-for="(user, index) in pageList" :key="index">
        <div>
          <v-img :src="user.image" width="75" height="75" class="rounded-circle" cover/>
        </div>
        <v-divider vertical class="my-0 mx-2"/>
        <div class="py-0 px-0 col-6">
          <p class="text-truncate mb-0">{{ user.name }}</p>
          <p class="text-truncate mb-0">{{ user.email }}</p>
        </div>
        <v-divider vertical class="my-0 mx-2"/>
        <div class="flex-grow-1">
          <p class="text-center">{{ role[user.role-1] }}</p>
          <div class="d-flex justify-content-around">
            <img v-if="!user.deleted_at" src="/dist/assets/slash.svg" @click="ban(user.id)">
            <img v-if="user.deleted_at" src="/dist/assets/refresh-ccw.svg" @click="restore(user.id)">
            <img src="/dist/assets/trash-2.svg" @click="remove(user.id)">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '~/store'
import axios from 'axios'

export default {
  middleware: 'auth',

  data: () => ({
    userData: [],
    searchName: '',
    page: 1,
    lastPage: null,
    role: ['Member', 'Admin', 'EO', 'EO Premium'],
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
    loadMore () {
      if (this.page <= this.lastPage) {
        this.page++
        setTimeout( () => {
          store.dispatch('admin/fetchUsers', this.page)
        }, 750)
      }
    },

    search () {
      this.page = 1
      this.userData = []
      this.lastPage = null
      store.dispatch('admin/fetchUsersByName', { page: this.page, param: this.searchName })
    },

    ban (id) {
      axios.post('/api/ban-user', {
        id: id
      })
        .then(() => store.dispatch('admin/fetchUsers'))
    },

    restore (id) {
      axios.post('/api/restore-user', {
        id: id
      })
        .then(() => store.dispatch('admin/fetchUsers'))
    },

    remove (id) {
      axios.post('/api/delete-user', {
        id: id
      })
        .then(() => store.dispatch('admin/fetchUsers'))
    }
  }

}
</script>