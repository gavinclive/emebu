import axios from 'axios'
import {
  FETCH_TICKET,
  FETCH_TICKET_BY_ID
} from '../mutation-types'

export const state = {
  tickets: null,
  ticketDetail: null
}

export const getters = {
  tickets: state => state.tickets,
  ticketDetail: state => state.ticketDetail
}

export const mutations = {
  [FETCH_TICKET] (state, { data }) {
    state.tickets = data.result
  },
  [FETCH_TICKET_BY_ID] (state, { data }) {
    state.ticketDetail = data.result
  }
}

export const actions = {
  async fetchTicket ({ commit }, params) {
    try {
      const { data } = await axios.get(`api/ticket/${params}`)
      commit(FETCH_TICKET, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchTicketById ({ commit }, id) {
    try {
      const { data } = await axios.get(`/api/ticket/${id}`)
      commit(FETCH_TICKET_BY_ID, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
