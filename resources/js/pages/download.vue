<template>
  <div class="col-12 p-0 position-relative" style="margin-top: -3rem !important;">
    <video-bg :sources="['https://www.videvo.net/videvo_files/converted/2016_01/preview/koncert.mp426536.webm']" />
    <div class="detail col-9 col-xl-6 col-lg-7">
      <div class="text-center">
        <div class="content mb-4">
          <img src="/dist/assets/emebu-logo.svg" class="white-svg" height="100">
          <div class="text-center mt-4 mb-1">
            Download now
          </div>
          <a href="/api/android"><img src="/dist/assets/android-logo.svg" height="35" class="white-svg"></a>
          <div class="text-center mt-4 mb-1">
            Coming soon
          </div>
          <img src="/dist/assets/apple.svg" height="35" class="white-svg">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VideoBg from 'vue-videobg'
export default {
  components: {
    VideoBg
  },
}
</script>

<style scoped>
.detail {
  text-align: center;
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-size: 2.75rem;
}

.content {
  font-size: 1rem;
}
</style>