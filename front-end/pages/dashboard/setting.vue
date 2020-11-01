<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card mt-4">
          <div class="card-header">
            <h2 class="title mb-0 text-center">settings</h2>
          </div>
          <div class="card-body">
            <form @submit.prevent="updateUserData">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Your Email"
                  v-model="userdata.email"
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Your Name"
                  v-model="userdata.name"
                />
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
                  Update
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  middleware: "auth",
  name: "updateUser",
  data() {
    return {
      Loading: false,
      userdata: {
        email: "",
        name: ""
      }
    };
  },

  methods: {
    updateUserData() {
      console.log(this.userdata);
    }
  },
  computed: {
    ...mapState(["auth"]),
    getUserData() {
      return this.auth
    },
  },
};
</script>

<style scoped></style>
