import axios from 'axios'
import {
  FETCH_EVENT,
  FETCH_EVENT_BY_ID
} from '../mutation-types'

export const state = {
  events: null,
  eventDetail: null
}

export const getters = {
  events: state => state.events,
  eventDetail: state => state.eventDetail
}

export const mutations = {
  [FETCH_EVENT] (state, { data }) {
    state.events = data.result
  },
  [FETCH_EVENT_BY_ID] (state, { data }) {
    state.eventDetail = data.result
  }
}

export const actions = {
  async fetchEvents ({ commit }) {
    try {
      const { data } = await axios.get('/api/event')
      commit(FETCH_EVENT, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchEventById ({ commit }, id) {
    try {
      const { data } = await axios.get(`/api/event/${id}/edit`)
      commit(FETCH_EVENT_BY_ID, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchEventsByParams ({ commit }, params) {
    try {
      const { data } = await axios.get(`/api/event/${JSON.stringify(params)}`)
      commit(FETCH_EVENT, { data })
    } catch (e) {
      console.log(e)
    }
  },

  async removeEvent ({ dispatch }, id) {
    axios.delete(`/api/event/${id}`)
  },

  async fetchFeaturedEvents ({ commit }, id) {
    try {
      const { data } = await axios.get('/api/featured')
      commit(FETCH_EVENT, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
