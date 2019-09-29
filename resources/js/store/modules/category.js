import axios from 'axios'
import {
  FETCH_CATEGORY
} from '../mutation-types'

export const state = {
  categories: null
}

export const getters = {
  getCategories: state => state.categories
}

export const mutations = {
  [FETCH_CATEGORY] (state, { data }) {
    state.categories = data.result
  }
}

export const actions = {
  async fetchCategories ({ commit }) {
    try {
      const { data } = await axios.get('/api/event-category')
      commit(FETCH_CATEGORY, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
