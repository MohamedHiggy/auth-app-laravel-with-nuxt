<template>
  <div>
    <navbar />
    <Nuxt />
  </div>
</template>
<script>
import navbar from "@/components/appNav"
export default {
  components: {
    navbar,
  }
}
</script>
<style>
html {
  font-family:
    'Source Sans Pro',
    -apple-system,
    BlinkMacSystemFont,
    'Segoe UI',
    Roboto,
    'Helvetica Neue',
    Arial,
    sans-serif;
  font-size: 16px;
  word-spacing: 1px;
}

*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}

</style>
