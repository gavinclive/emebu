<template>
  <v-card max-width="100%" class="mx-auto">
    <v-card-title class="d-flex justify-content-center">
      {{ title }}
    </v-card-title>
    <v-card-text>
      <slot />
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: 'Card',

  props: {
    title: { type: String, default: null },
    position: { type: String, default: null}
  }
}
</script>
