<template>
  <div class="col-12">
    <div class="ticket col-12 p-0">
      <div class="ticket-header">
        <v-img cover :src="eventImageUrl(image)" height="200" :class="{ 'gray-out': !settled_at }"/>
      </div>
    </div>
    <div class="ticket-content-wrapper bg-primary col-12 p-0 text-light">
      <div class="ticket-content row mx-auto">
        <div class="col-6">
          <div class="event-name col-12 p-0 font-weight-bold">{{ title }}</div>
          <div class="ticket-name col-12 font-weight-light p-0">{{ name }}</div>
        </div>
        <div class="col-6">
          <p class="text-right mb-0 font-weight-light">{{ dateFormat(new Date(date), 'dd, DD MMM YYYY') }}</p>
          <p class="text-right mb-0 font-weight-light">{{ dateFormat(new Date(date), 'hh.mm') }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { dateFormat } from '~/utils/dateFormat'
import { eventImageUrl } from '~/utils/image'

export default {
  name: 'Ticket',

  props: {
    title: { type: String, default: null },
    image: { type: String, default: null },
    name: { type: String, default: null },
    date: { type: String, default: null},
    settled_at: { type: String, default: null }
  },

  methods: {
    dateFormat,

    eventImageUrl
  },
}
</script>