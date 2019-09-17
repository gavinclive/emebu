<template>
  <div class="main-layout">
    <navbar />

    <div class="container mt-4 page-control">
      <child />
    </div>
    <BottomNav />
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
