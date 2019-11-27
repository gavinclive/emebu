import axios from 'axios'
import {
  FETCH_RATING_DETAIL,
  FETCH_RATING_STATUS,
  FETCH_EO_RATING
} from '../mutation-types'

export const state = {
  ratingStatus: null,
  ratingDetail: null,
  eoRating: null
}

export const getters = {
  ratingStatus: state => state.ratingStatus,
  ratingDetail: state => state.ratingDetail,
  eoRating: state => state.eoRating
}

export const mutations = {
  [FETCH_RATING_DETAIL] (state, { data }) {
    state.ratingDetail = data.result
  },
  [FETCH_RATING_STATUS] (state, { data }) {
    state.ratingStatus = data.result
  },
  [FETCH_EO_RATING] (state, { data }) {
    state.eoRating = data.result
  }
}

export const actions = {
  async fetchRatingDetail ({ commit }, id) {
    try {
      const { data } = await axios.get(`/api/rating/${id}`)
      commit(FETCH_RATING_DETAIL, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchRatingStatus ({ commit }, values) {
    try {
      const { data } = await axios.post('/api/check-rating', values)
      commit(FETCH_RATING_STATUS, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchEoRating ({ commit }, id) {
    try {
      const { data } = await axios.get(`/api/eo-score?id=${id}`)
      commit(FETCH_EO_RATING, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
