<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarNav">
        <!--Left nav-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <nuxt-link to="/" class="nav-link">Home</nuxt-link>
          </li>
            <template v-if="$auth.loggedIn">
              <li class="nav-item">
                <nuxt-link to="/dashboard/add-post" class="btn btn-outline-info btn-sm mt-1">Add post</nuxt-link>
              </li>
            </template>
        </ul>
        <!--right nav-->
        <ul class="navbar-nav ml-auto">
          <template v-if="$auth.loggedIn">
            <li class="nav-item">
              <nuxt-link to="/dashboard" class="nav-link">Dashboard</nuxt-link>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link disabled">{{$auth.user.name}}</a>
            </li>
            <li class="nav-item">
              <button class="btn btn-outline-success" @click.prevent="signOut">Sign Out</button>
            </li>
          </template>
          <template v-else>
            <li class="nav-item">
              <nuxt-link to="/auth/login" class="nav-link">Login</nuxt-link>
            </li>
            <li class="nav-item">
              <nuxt-link to="/auth/register" class="nav-link"
                >Register</nuxt-link
              >
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
  methods: {
    signOut() {
      this.$auth.logout();
    },
  },
};
</script>
