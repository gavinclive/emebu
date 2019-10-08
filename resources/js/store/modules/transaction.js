import axios from 'axios'
import {
  FETCH_TRANSACTION,
  FETCH_TRANSACTION_BY_ID
} from '../mutation-types'

export const state = {
  // transactions: null,
  transactions: [
    {
      id: '44401',
      image: 'https://s.yimg.com/os/creatr-uploaded-images/2018-11/bb1e57e0-ed98-11e8-bbbe-f413dd5587e9',
      title: 'TwitchCon Europe',
      name: 'General Admission',
      date: '2020-01-05 09:30',
      price: '4440020',
      qty: '3'
    },
    {
      id: '212121',
      image: 'https://cdn.idntimes.com/content-images/post/20181202/aksi-reuni-212-021218-gid-1-8ebcb30137f3991d84307b6d4dd39736_600x400.jpg',
      title: 'Reuni Akbar 212',
      name: 'Take a Beer',
      date: '2019-12-02 10:30',
      price: '212',
      qty: '212'
    }
  ],
  // transactionDetail: null
  transactionDetail: {
    id: '44401',
    image: 'https://s.yimg.com/os/creatr-uploaded-images/2018-11/bb1e57e0-ed98-11e8-bbbe-f413dd5587e9',
    title: 'TwitchCon Europe',
    name: 'General Admission',
    date: '2020-01-05 09:30',
    price: '4440020',
    qty: '3'
  }
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
