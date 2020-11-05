<template>
  <div class="container">
    <div v-if="allPosts == 0" class="pt-5">
      <div class="text-center">
        <h2 class="text-center">There is no posts to load</h2>
      </div>
    </div>
    <div class="row" v-else>
      <div class="col-md-12 text-center">
        <h2 class="main-title mt-5 mb-5">All posts of all users</h2>
      </div>
      <div class="col-sm-12 mb-5" v-for="post in allPosts" :key="post.id">
        <div class="card">
          <div class="card-header">
            <ul class="list-style">
              <li class="list">
                <p class="name">
                  Added this post by:
                  <nuxt-link
                    :to="`/user/${post.user.name}`"
                    class="text-muted"
                    >{{ post.user.name }}</nuxt-link
                  >
                </p>
              </li>
              <li class="list">
                <p class="time">
                  from :
                  <span class="text-muted">{{
                    $moment(post.created_at).fromNow()
                  }}</span>
                </p>
              </li>
              <li class="list">
                <button
                  class="btn btn-outline-info btn-sm"
                  type="button"
                  disabled
                  v-if="Loading"
                >
                  <span
                    class="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                  ></span>
                  saving...
                </button>

                <button @click="savePost" class="btn btn-outline-info btn-sm">
                  Save post
                </button>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <footer class="blockquote-footer">{{ post.description }}</footer>
          </div>
        </div>
      </div>
      <div class="col-md-12 text-center">
        <div
          class="spinner-grow"
          style="width: 3rem; height: 3rem"
          role="status"
        >
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  middleware: "auth",
  name: "index",
  data() {
    return {
      Loading: false,
      page: 1,
      scrollTimout: null,
    };
  },
  computed: {
    ...mapState(["allPosts"]),
  },
  fetch({ $axios, store }) {
    return $axios.$get(`/allposts?page=1`).then((res) => {
      store.commit("updateAllPosts", res.data.data);
    });
  },
  methods: {
    savePost() {
      console.log("saved");
    },
  },
};
</script>

<style scoped>
.list-style {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  justify-content: space-between;
}
.list p {
  margin: 0;
  font-weight: bold;
}
</style>
