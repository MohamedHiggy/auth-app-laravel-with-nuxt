<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <h2 class="title mb-0 text-center">Login</h2>
        </div>
        <div class="card-body">
          <form @submit.prevent="login">
            <div class="form-group">
              <label for="inputemail">Email</label>
              <input
                type="email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                placeholder="Email"
                id="inputemail"
                v-model="form.email"
              />
              <p class="invalid-feedback" v-if="errors.email">
                <span>{{ errors.email[0] }}</span>
              </p>
            </div>
            <div class="form-group">
              <label for="inputpassword">Password</label>
              <input
                :type="passwordFieldType"
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                placeholder="Password"
                id="inputpassword"
                v-model="form.password"
              /><button
                class="show-password"
                type="button"
                @click="switchVisibility"
              >
                <img src="@/assets/show-password.svg" alt="" />
              </button>
              <p class="invalid-feedback" v-if="errors.password">
                <span>{{ errors.password[0] }}</span>
              </p>
            </div>
            <div class="form-group">

              <button class="btn btn-dark w-100" type="button" disabled v-if="Loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </button>
              <button class="btn btn-dark w-100" type="submit"  v-else>Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "login",
  data() {
    return {
      Loading:false,
      passwordFieldType: "password",
      form: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    async login() {
      this.Loading = true;
      try {
        await this.$auth.login({ data: this.form });
        this.Loading = false;
        this.$router.push(his.$route.query.redirect ? this.$route.query.redirect : "/");
      }
      catch (e) {
        this.Loading = false;
      }
    },
    switchVisibility() {
      this.passwordFieldType =
        this.passwordFieldType === "password" ? "text" : "password";
    }
  }
};
</script>

<style scoped>
.form-group {
  position: relative;
}
.show-password {
  background-color: transparent;
  position: absolute;
  top: 35px;
  right: 25px;
  border-radius: 15px;
  border: none;
}

.show-password img {
  width: 100%;
  height: 100%;
}

.show-password:focus {
  outline: none;
}
</style>
