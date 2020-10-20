<template>
  <div class="container">
    <div class="pt-5">
      <template v-if="$auth.user.posts == 0" class="text-center">
        <h2 class="text-center">user has no posts</h2>
      </template>
      <template v-else>
        <h2 class="text-center mb-5">Your Posts</h2>
        <div class="row">
            <div class="col-sm-6 mb-5" v-for="post in $store.state.userPosts" :key="post.id">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{ post.title }}</h5>
                  <p class="card-text">
                    {{ post.description }}
                  </p>
                  <nuxt-link
                    :to="`/dashboard/${post.id}/single-post`"
                    class="btn btn-primary"
                    >
                      <span @click="updateSelectedPost(post)">
                          see more
                      </span>
                    </nuxt-link
                  >
                </div>
              </div>
            </div>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  fetch({$axios, store}) {
    return $axios.$get("/posts").then(res=> {
      store.commit("updatePosts", res.data)
    })
  },
  methods: {
    updateSelectedPost(post) {
      this.$store.commit("updateSelectedPost", post);
    }
  }
};
</script>

<style scoped>
.card {
  height: 100%;
}
</style>
