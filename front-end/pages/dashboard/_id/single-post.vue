<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card mt-5">
          <div class="card-body">
            <h5 class="card-title">
              {{ $store.state.userSelectedPost.title }}
            </h5>
            <p class="card-text">
              {{ $store.state.userSelectedPost.description }}
            </p>
            <nuxt-link to="/dashboard/user-posts" class="btn btn-primary">
              go back to your posts
            </nuxt-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  validate({ params }) {
    return !isNaN(params.id);
  },
  //store to vuex
  fetch({ $axios, store, params }) {
    if (
      store.state.userSelectedPost &&
      store.state.userSelectedPost.id == params.id
    )
      return true;
    return $axios.$get(`/posts/${params.id}`).then(res => {
      store.commit("updateSelectedPost", res.data);
      console.log(res)
    });
  }
};
</script>
