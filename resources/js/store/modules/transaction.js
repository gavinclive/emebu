import axios from 'axios'
import {
  FETCH_TRANSACTION,
  FETCH_TRANSACTION_BY_ID
} from '../mutation-types'

export const state = {
  transactions: null,
  transactionDetail: null
}

export const getters = {
  transactions: state => state.transactions,
  transactionDetail: state => state.transactionDetail
}

export const mutations = {
  [FETCH_TRANSACTION] (state, { data }) {
    state.transactions = data.result
  },
  [FETCH_TRANSACTION_BY_ID] (state, { data }) {
    state.transactionDetail = data.result
  }
}

export const actions = {
  async fetchTransaction ({ commit }, params) {
    try {
      const { data } = await axios.get(`api/transaction/${params}`)
      commit(FETCH_TRANSACTION, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchTransactionById ({ commit }, id) {
    try {
      const { data } = await axios.get(`api/transaction/${id}`)
      commit(FETCH_TRANSACTION_BY_ID, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
