<template>
  <div class="container">
    <div class="col-md-6 offset-md-3">
      <div class="card mt-4">
        <div class="card-header">
          <h2 class="title mb-0 text-center">Register</h2>
        </div>
        <div class="card-body">
          <form @submit.prevent="register">
            <div class="form-group">
              <label for="inputname">Name</label>
              <input
                type="text"
                class="form-control"
                :class="{ 'is-invalid': errors.name }"
                placeholder="Name"
                id="inputname"
                v-model="form.name"
                required
              />
              <p class="invalid-feedback" v-if="errors.name">
                <span>{{errors.name[0]}}</span>
              </p>
            </div>
            <div class="form-group">
              <label for="inputemail">Email</label>
              <input
                type="email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                placeholder="Email"
                id="inputemail"
                v-model="form.email"
                required
              />
              <p class="invalid-feedback" v-if="errors.email">
                <span>{{errors.email[0]}}</span>
              </p>
            </div>
            <div class="form-group">
              <label for="inputpassword">Password</label>
              <input
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                placeholder="Password"
                id="inputpassword"
                v-model="form.password"
                :type="show === true ? 'text' : 'password'"
                required
              />
              <div class="strength" :class="'level_' + strengthLevel"></div>
              <i class="fas fa-eye show-icon" v-if="show" @click="show = !show"></i>
              <i class="fas fa-eye-slash hide-icon" v-else  @click="show = !show"></i>
              <i class="fas fa-frown level-icon" v-if="strengthLevel === 1"></i>
              <i class="fas fa-meh level-icon" v-if="strengthLevel === 2"></i>
              <i class="fas fa-smile level-icon" v-if="strengthLevel === 3"></i>
              <i class="fas fa-grin-stars level-icon" v-if="strengthLevel === 4"></i>
              <p class="invalid-feedback" v-if="errors.password">
                <span>{{errors.password[0]}}</span>
              </p>
            </div>
            <div class="form-group">
              <button class="btn btn-dark w-100" type="button" disabled v-if="Loading">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
              </button>
              <button class="btn btn-dark w-100" type="submit" v-else>Register</button>
            </div>
          </form>
          <div class="text-center" style="margin-top: 20px">
            Already got an account? <nuxt-link to="/auth/login">Login</nuxt-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      Loading:false,
      show: false,
      form: {
        name: "",
        email: "",
        password: ""
      },
    };
  },
  methods: {
    async register() {
      this.Loading = true;
      try {
        await this.$axios.post("register", this.form);
        this.Loading = false;
        this.$toast.success('successfuly created account');
      } catch (e) {
        return;
      }
      this.$router.push("/auth/login");
    },
  },

  computed: {
    scorePassword() {
      let score = 0;
      if (this.form.password === '') return score;
      let letters = {};
      for (let i = 0; i < this.form.password.length; i++) {
        letters[this.form.password[i]] = (letters[this.form.password[i]] || 0) + 1;
        score += 5.0 / letters[this.form.password[i]];
      }
      let variations = {
        digits: /\d/.test(this.form.password),
        lower: /[a-z]/.test(this.form.password),
        upper: /[A-Z]/.test(this.form.password),
        special: /\W/.test(this.form.password)
      }
      let variationCount = 0;
      for (let check in variations) {
        variationCount += (variations[check] == true) ? 1 : 0;
      }
      score += (variationCount - 1) * 10;
      return parseInt(score);
    },
    strengthLevel() {
      let pass = this.scorePassword;
      if(pass === 0) return 0;
      if(pass < 25) return 1;
      if(pass < 50) return 2;
      if(pass < 75) return 3;
      if(pass >= 75) return 4;
    }
  }
};
</script>

<style scoped>
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css");
.form-group {
  position: relative;
}

.show-password:focus{
  outline: none;
}
.form-control {
  position: relative;
  z-index: 10 !important;
}

.strength {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  display: block;
  width: 25%;
  height: 50%;
  background-color: #a5df41;
  border-radius: 40px;
  overflow: hidden;
  z-index: 9;
  transition: all .5s linear;
}

.level_0 {
  bottom: 0;
  width: 25%;
  background-color: #BB4440;
}

.level_1 {
  bottom: -10px;
  width: 25%;
  background-color: #BB4440;
}

.level_2 {
  bottom: -10px;
  width: 50%;
  background-color: #E17D30;
}

.level_3 {
  bottom: -10px;
  width: 75%;
  background-color: #F0B03F;
}

.level_4 {
  bottom: -10px;
  width: 100%;
  background-color: #a5df41;
}

.level-icon {
  font-size: 22px;
  position: absolute;
  right: 20px;
  top: 40px;
  z-index: 11;
}

.show-icon {
  font-size: 22px;
  position: absolute;
  right: 50px;
  top: 40px;
  z-index: 11;
  cursor: pointer;
}

.hide-icon {
  font-size: 22px;
  position: absolute;
  right: 50px;
  top: 40px;
  z-index: 11;
  cursor: pointer;
  color: #555;
}


</style>
