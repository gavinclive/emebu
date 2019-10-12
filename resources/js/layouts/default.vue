<template>
  <div class="main-layout px-0 mx-0">
    <navbar />

    <div class="container mt-md-4 page-control pt-5 px-0 pb-0">
      <child />
    </div>
    <BottomNav class="position-fixed"/>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import BottomNav from '~/components/BottomNavigation'

export default {
  name: 'MainLayout',

  components: {
    Navbar,
    BottomNav
  }
}
</script>
