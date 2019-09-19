<template>
  <div>
    {{ $t('you_are_logged_in') }}
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
