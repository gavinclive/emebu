<template>
  <div class="camera text-center text-white">
    <qrcode-stream @decode="onDecode" class="scanner">
      You can scan attendees ticket here.
    </qrcode-stream>
  </div>
</template>

<script>
import { QrcodeStream } from 'vue-qrcode-reader'

export default {
  components: {
    QrcodeStream
  },

  methods: {
    onDecode (decodedString) {
      window.location.href = decodedString
    }
  }
}
</script>