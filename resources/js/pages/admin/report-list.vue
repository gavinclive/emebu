<template>
  <div class="col-md-10 py-1 d-flex flex-wrap my-auto">
    <div v-for="(report, index) in reportList" :key="index" class="col-12 col-md-6 card mb-2">
      <div class="card-body">
        <p>
          {{ report.member.name }}
          <span> reports </span>
          <span v-if="report.event && report.event.title">{{ report.event.title }}</span><span> because of</span>
        </p>
        <p><code>{{ report.description }}</code></p>
        <p class="mb-0">{{ dateFormat(new Date(report.created_at), 'ddd, DD MMMM YYYY @ hh:mm:ss')}}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { dateFormat } from '~/utils/dateFormat'

export default {
  beforeRouteEnter (to, from, next) {
    axios.get('/api/report')
    .then(res => next ( vm => {
      vm.reportList = res.data.result
    }))
  },

  data: () => ({
    reportList: {}
  }),

  methods: {
    dateFormat
  },
}
</script>

<style>

</style>