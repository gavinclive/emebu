<template>
  <v-card max-width="100%" class="mx-auto">
    <v-img v-if="image" class="white--text" height="200px" :src="image">
      <v-card-title v-if="title">
        {{ title }}
      </v-card-title>
    </v-img>
    <v-card-title v-if="!image && title">
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
    image: { type: String, default: null }
  }
}
</script>
