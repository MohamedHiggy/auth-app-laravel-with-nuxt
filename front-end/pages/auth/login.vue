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
            <div class="form-group" >
              <label for="inputpassword">Password</label>
              <input
                :type="show === true ? 'text' : 'password'"
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                placeholder="Password"
                id="inputpassword"
                v-model="form.password"
              />
              <i class="fas fa-eye show-icon" v-if="show" @click="show = !show"></i>
              <i class="fas fa-eye-slash hide-icon" v-else  @click="show = !show"></i>
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
          <div class="text-center" style="margin-top: 20px">
            Not have account? <nuxt-link to="/auth/register">Register</nuxt-link>
          </div>
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
      show: false,
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
        let auth = await this.$auth.login({ data: this.form });
        this.Loading = false;
        if(auth.data.success = true) {
          this.$toast.success('successfuly authenticated');
          this.$router.push(this.$route.query.redirect ? this.$route.query.redirect : "/dashboard");
        }
      }
      catch (e) {
        this.Loading = false;
        return;
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
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css");
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

.show-icon {
  font-size: 22px;
  position: absolute;
  right: 30px;
  top: 40px;
  z-index: 11;
  cursor: pointer;
}

.hide-icon {
  font-size: 22px;
  position: absolute;
  right: 30px;
  top: 40px;
  z-index: 11;
  cursor: pointer;
  color: #555;
}

</style>
