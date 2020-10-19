<template>
  <div>
    <h1>this is title of post {{$route.params.id}}</h1>
  </div>
</template>


<script>
export default {
  middleware: "auth",
  validate({params}) {
    return !isNaN(params.id)
  }
};
</script>
