<template>
  <div class="container">
    <Loading v-if="posts == 0"></Loading>
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="main-title mt-5 mb-5">All posts of all users</h2>
      </div>
    </div>
    <InfiniteScroll :items="posts" @refetch="fetchPosts">
      <template v-slot:item="{ item }">
        <div class="card mt-2 mb-2">
          <div class="card-header">
            <ul class="list-style">
              <li class="list">
                <p class="name">
                  Added this post by:
                  <nuxt-link
                    :to="`/user/${item.user.name}`"
                    class="text-muted"
                    >{{ item.user.name }}</nuxt-link
                  >
                </p>
              </li>
              <li class="list">
                <p class="time">
                  from :
                  <span class="text-muted">{{
                    $moment(item.created_at).fromNow()
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
            <h5 class="card-title">{{ item.title }}</h5>
            <footer class="blockquote-footer">{{ item.description }}</footer>
          </div>
        </div>
      </template>
    </InfiniteScroll>
  </div>
</template>

<script>
import InfiniteScroll from "@/components/InfiniteScroll";
import Loading from "@/components/loading";
export default {
  middleware: "auth",
  name: "index",
  components: {
    InfiniteScroll,
    Loading
  },
  data() {
    return {
      Loading: false,
      posts: [],
      lastPage: 1,
    };
  },
  methods: {
    savePost() {
      console.log("saved");
    },
    async fetchPosts(page) {
      if (page > this.lastPage) {
        return;
      }
      let posts = await this.$axios.$get(
        `http://localhost/api/v1/allposts?page=${page}`
      );
      this.posts.push(...posts.data.data);
      this.lastPage = posts.data.last_page;
    },
  },
  mounted() {
    this.fetchPosts(1);
  },
};
</script>

