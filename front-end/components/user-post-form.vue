<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <h2 class="title mb-0 text-center">post</h2>
        </div>
        <div class="card-body">
          <form @submit.prevent="sendData">
            <div class="form-group">
              <label for="inputtitle">Title</label>
              <input
                type="text"
                class="form-control"
                placeholder="Title"
                :class="{ 'is-invalid': errors.title }"
                id="inputtitle"
                v-model="form.title"
              />
              <p class="invalid-feedback" v-if="errors.title">
                <span>{{ errors.title[0] }}</span>
              </p>
            </div>
            <div class="form-group">
              <label for="inputdescription">Description</label>
              <input
                type="text"
                class="form-control"
                placeholder="Description"
                :class="{ 'is-invalid': errors.description }"
                id="inputdescription"
                v-model="form.description"
              />
              <p class="invalid-feedback" v-if="errors.description">
                <span>{{ errors.description[0] }}</span>
              </p>
            </div>
            <div class="form-group">
              <button
                class="btn btn-dark w-100"
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
              <button class="btn btn-dark w-100" type="submit" v-else>
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      Loading: false,
      form: {
        title: "",
        description: ""
      }
    };
  },
  computed: {
    postId() {
      return +this.$route.params.id;
    },
    btnText() {
      return this.postId ? "Edit" : "submit";
    }
  },
  mounted() {
    this.postId && this.getPost();
  },

  methods: {
    sendData() {
      this.Loading = true;
      const action  = this.postId
      ?
      {name: "editPost", payload: {...this.form, id: this.postId}}
      :
      {name: "addPost", payload: this.form}
      this.$store
        .dispatch(action.name, action.payload)
        .then(() => {
          this.$router.push("/dashboard/user-posts");
        })
        .finally(() => {
          this.Loading = false;
        });
    },
    getPost() {
      this.$store.dispatch("getPost", this.postId).then(post => {
        (this.form.title = post.title), (this.form.description = post.description);
      });
    }
  }
};
</script>

<style scoped></style>
