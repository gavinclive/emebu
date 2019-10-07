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
  // eventDetail: null
  eventDetail: {
    img: 'https://s.yimg.com/os/creatr-uploaded-images/2018-11/bb1e57e0-ed98-11e8-bbbe-f413dd5587e9',
    title: 'TwitchCon Europe',
    img_3d: 'http://emebu.test/storage/8hw0clw-360-panorama-miami.jpg',
    category: '4',
    type: '11',
    organizer: 'Admin',
    startTime: '2020-01-05 09:30',
    endTime: '2020-01-06 18:30',
    location: '52.5186, 13.3762',
    summary: 'Paint the town purple',
    description: '<h1>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting English</h1><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><ol><li>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li><li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ol><ul><li>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li><li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ul><table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\"><tbody><tr><td>No</td><td>Name</td><td>Description</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><p><strong>Lorem Ipsum</strong>&nbsp;<em>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it</em> t<u>o make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</u></p><p><tt><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</tt></p><p><code><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</code></p><p><code><img alt=\"\" src=\"http://cdn.dota2.com/apps/dota2/images/blogfiles/planetfall_blog_zxgim.jpg\" style=\"height:550px; width:810px\" /></code></p><p><tt><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</tt></p><p><code><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</code></p>'
  }
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
