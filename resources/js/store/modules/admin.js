import axios from 'axios'
import {
  FETCH_USERS,
  FETCH_STATIC_PAGE_BY_ID
} from '../mutation-types'

export const state = {
  users: null,
  staticPage: null
}

export const getters = {
  users: state => state.users,
  staticPage: state => state.staticPage
}

export const mutations = {
  [FETCH_USERS] (state, { data }) {
    state.users = {}
    state.users = data.result
  },
  [FETCH_STATIC_PAGE_BY_ID] (state, { data }) {
    state.staticPage = data.result
  }
}

export const actions = {
  async fetchUsers ({ commit }, page = 1) {
    try {
      const { data } = await axios.get(`/api/users?page=${page}`)
      commit(FETCH_USERS, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchUsersByName ({ commit }, { page = 1, param }) {
    try {
      const { data } = await axios.get(`/api/users/${param}?page=${page}`)
      commit(FETCH_USERS, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchStaticPageById ({ commit }, id) {
    try {
      const { data } = await axios.get(`/api/static/${id}`)
      commit(FETCH_STATIC_PAGE_BY_ID, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
