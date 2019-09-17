<template>
  <card :title="$t('home')"  style="height: 2400px;">
    {{ $t('you_are_logged_in') }}
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
