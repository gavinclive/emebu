<template>
  <div class="main-layout px-0 mx-0">
    <navbar @showReportModal="reportEvent" />

    <div class="container mt-md-4 page-control pt-5 px-0 pb-0">
      <child class="mt-2 mt-md-0"/>
    </div>
    <BottomNav class="position-fixed"/>
    <div class="modal fade" id="report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t('report_event') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {{ $t('report_guide') }}
            <input class="form-control" v-model="report" :placeholder="$t('report_placeholder')">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="handleReport">{{ $t('report') }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import BottomNav from '~/components/BottomNavigation'
import { mapGetters } from 'vuex'
import $ from 'jquery'
import axios from 'axios'

export default {
  name: 'MainLayout',

  components: {
    Navbar,
    BottomNav
  },

  data: () => ({
    report: ''
  }),

  computed: mapGetters({
    event: 'event/eventDetail'
  }),

  methods: {
    reportEvent() {
      $('#report').modal('show')
    },

    handleReport() {
      axios.post('/api/report', {
        event_id: this.event[0].id,
        report: this.report
      })
    }
  },
}
</script>
