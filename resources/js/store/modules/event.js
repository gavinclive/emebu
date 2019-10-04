import axios from 'axios'
import {
  FETCH_EVENT, 
  FETCH_EVENT_BY_ID,
  FETCH_EVENT_BY_UID
} from '../mutation-types'

export const state = {
  // events: null,
  events: [
    {
      id: '42',
      title: 'TwitchCon Europe',
      img: 'https://s.yimg.com/os/creatr-uploaded-images/2018-11/bb1e57e0-ed98-11e8-bbbe-f413dd5587e9',
      startDate: '2020-01-05 09:30',
      sold: '420',
      qty: '808',
      status: '1'
    },
    {
      id: '212',
      title: 'Reuni Akbar 212',
      img: 'https://cdn.idntimes.com/content-images/post/20181202/aksi-reuni-212-021218-gid-1-8ebcb30137f3991d84307b6d4dd39736_600x400.jpg',
      startDate: '2019-12-02 10:30',
      sold: '212',
      qty: '666',
      status: '3'
    }
  ],
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
  },
  [FETCH_EVENT_BY_UID] (state, { data }) {
    state.events = data.result
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
  async fetchEventByUid ({ commit }, uid) {
    try {
      const { data } = await axios.get(`/api/event/${uid}`)
      commit(FETCH_EVENT, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
