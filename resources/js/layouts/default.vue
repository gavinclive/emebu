<template>
  <div class="main-layout px-0 mx-0">
    <navbar />

    <div class="container mt-4 page-control pb-0">
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
