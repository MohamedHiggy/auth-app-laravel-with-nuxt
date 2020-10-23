<template>
  <div class="container">
    <h1>{{$route.params.id}}</h1>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  validate({ params }) {
    return isNaN(params.id);
  },
};
</script>

<style scoped>
</style>
