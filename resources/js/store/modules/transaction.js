import axios from 'axios'
import {
  FETCH_TRANSACTION,
  FETCH_TRANSACTION_BY_ID,
  FETCH_PAYMENT_INFO
} from '../mutation-types'

export const state = {
  transactions: null,
  transactionDetail: null,
  paymentInfo: null
}

export const getters = {
  transactions: state => state.transactions,
  transactionDetail: state => state.transactionDetail,
  paymentInfo: state => state.paymentInfo
}

export const mutations = {
  [FETCH_TRANSACTION] (state, { data }) {
    state.transactions = data.result
  },
  [FETCH_TRANSACTION_BY_ID] (state, { data }) {
    state.transactionDetail = data.result
  },
  [FETCH_PAYMENT_INFO] (state, { data }) {
    state.paymentInfo = data.result
  }
}

export const actions = {
  async fetchTransaction ({ commit }) {
    try {
      const { data } = await axios.get('/api/transaction')
      commit(FETCH_TRANSACTION, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchTransactionById ({ commit }, id) {
    try {
      const { data } = await axios.get(`/api/transaction/${id}/edit`)
      commit(FETCH_TRANSACTION_BY_ID, { data })
    } catch (e) {
      console.log(e)
    }
  },
  async fetchPaymentInfo ({ commit }, id) {
    try {
      const { data } = await axios.get(`/api/payment-info/?id=${id}`)
      commit(FETCH_PAYMENT_INFO, { data })
    } catch (e) {
      console.log(e)
    }
  }
}
