import axios from 'axios'
import {
  FETCH_TYPE
} from '../mutation-types'

export const state = {
  types: null
}

export const getters = {
  getTypes: state => state.types
}

export const mutations = {
  [FETCH_TYPE] (state, { data }) {
    state.types = data.result
  }
}

export const actions = {
  async fetchTypes ({ commit }) {
    try {
      const { data } = await axios.get('/api/event-type')
      commit(FETCH_TYPE, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
