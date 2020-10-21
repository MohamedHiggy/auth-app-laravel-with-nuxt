<template>
  <AddPost />
</template>

<script>
import AddPost from "@/components/user-post-form"
export default {
  middleware: "auth",
  name: "addPost",
  components: {
    AddPost
  }
};
</script>

<style scoped>
</style>
