<template>
  <EditPost />
</template>

<script>
import EditPost from "@/components/user-post-form"
export default {
  middleware: "auth",
  name: "editPost",
  components: {
    EditPost
  }
};
</script>

