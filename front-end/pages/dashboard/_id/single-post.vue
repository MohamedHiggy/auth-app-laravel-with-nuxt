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
            <ul class="list-style">
              <li class="list">
                <nuxt-link
                  :to="
                    `/dashboard/${$store.state.userSelectedPost.id}/edit-post`
                  "
                  class="btn btn-info btn-sm"
                >
                  Edit
                </nuxt-link>
              </li>
              <li class="list">
                <button class="btn btn-danger btn-sm" @click="modal = !modal">
                  Delete
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="deleted-model-container" v-if="modal">
        <div class="card deleted-model">
          <div class="card-body">
            <h5 class="card-title">Are you sure to delete this post ?</h5>
            <button
              type="button"
              class="btn btn-outline-primary"
              @click="modal = !modal"
            >
              Cancel
            </button>

            <button
              class="btn btn-outline-danger"
              type="button"
              disabled
              v-if="Loading"
            >
              <span
                class="spinner-border spinner-border-sm"
                role="status"
                aria-hidden="true"
              ></span>
              Loading...
            </button>
            <button
              type="button"
              class="btn btn-outline-danger"
              @click="deletePost($store.state.userSelectedPost.id)"
              v-else
            >
              Yes
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",
  data() {
    return {
      Loading: false,
      modal: false
    };
  },
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
    });
  },
  methods: {
    deletePost(postId) {
      this.Loading = true;
      this.$store
        .dispatch("deletePost", postId)
        .then(res => {
          this.$router.push("/dashboard/user-posts");
        })
        .finally(() => {
          this.Loading = false;
        });
    }
  }
};
</script>

<style scoped>
.list-style {
  list-style: none;
  padding: 10px;
  position: absolute;
  top: 0;
  right: 0;
  display: flex;
  width: auto;
}
.list {
  margin: 5px;
}
.deleted-model-container{
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: rgba(187, 187, 187, 0.78);
    top: 0;
    left: 0;
}
.deleted-model {
  height: auto;
  width: 30%;
  text-align: center;
  margin: 400px auto;
  box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1), 1px 2px 8px rgba(0, 0, 0, 0.1);
}
</style>
