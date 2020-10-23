<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="main-title mt-5 mb-5">All posts of all users</h2>
      </div>
      <div class="col-sm-12 mb-5" v-for="post in $store.state.allPosts" :key="post.id">
        <div class="card">
          <div class="card-header">
            <ul class="list-style">
              <li class="list">
                <p class="name">Added this post by:
                  <nuxt-link :to="`/user/${post.user.name}`" class="text-muted">{{post.user.name}}</nuxt-link>
                </p>
              </li>
              <li class="list">
                <p class="time">
                  from : <span class="text-muted">{{ $moment(post.created_at).fromNow() }}</span>
                </p>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h5 class="card-title">{{post.title}}</h5>
            <footer class="blockquote-footer">{{post.description}}</footer>
          </div>
        </div>
      </div>


      <div class="col-md-12 text-center">
        <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  name: "index",
  data() {
    return {
      page: 1,
    }
  },
  fetch({$axios, store}) {
    return $axios.$get(`/allposts?page=${this.page}`).then(res=> {
      store.commit("updateAllPosts", res.data.data);
    })
  },
};
</script>

<style scoped>
  .list-style{
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: space-between;
  }
  .list p{
    margin: 0;
    font-weight: bold;
  }
</style>
