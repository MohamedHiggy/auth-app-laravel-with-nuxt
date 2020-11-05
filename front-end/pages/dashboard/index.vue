<template>
  <div class="container">
    <div class="text-center pt-5">
      <h4>Your name is : <span class="sub-title">{{ auth.user.name }}</span></h4>
      <h4>Your email is :<span class="sub-title">{{ auth.user.email }}</span></h4>
      <nuxt-link to="dashboard/user-posts" class="btn btn-dark w-50 mt-5">Your posts</nuxt-link>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  middleware: "auth",
  computed: {
    ...mapState(["auth"])
  }
};
</script>

<style>
.sub-title {
  font-size: 20px;
  color: #555555;
}
</style>
