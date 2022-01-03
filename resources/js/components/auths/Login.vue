<template>
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="POST" @submit.prevent="Login">
                    <div class="form-group">
                      <input
                        type="email"
                        v-model="email"
                        :class="{
                          error: $v.password.$error,
                        }"
                        class="form-control form-control-user"
                        id="exampleInputEmail"
                        aria-describedby="emailHelp"
                        placeholder="Enter Email Address..."
                        @blur="$v.email.$touch()"
                      />
                      <div v-if="$v.email.$error">
                        <p v-if="!$v.email.email" style="color: blue">
                          Please enter a valid email
                        </p>
                        <p v-if="!$v.email.required" style="color: blue">
                          This field is required
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        v-model="password"
                        :class="{
                          error: $v.password.$error,
                        }"
                        class="form-control form-control-user"
                        id="exampleInputPassword"
                        placeholder="Password"
                        @blur="$v.password.$touch()"
                      />
                      <div v-if="$v.password.$error">
                        <!-- <p v-if="!$v.password.required" style="color:blue;">
                                                Please enter a valid Password
                                            </p> -->
                        <p v-if="!$v.password.required" style="color: blue">
                          This field is required
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          id="customCheck"
                        />
                        <label class="custom-control-label" for="customCheck"
                          >Remember Me</label
                        >
                      </div>
                    </div>
                    <input
                      :disabled="$v.$invalid"
                      type="submit"
                      name="submit"
                      class="btn btn-primary btn-user btn-block"
                      value="Login"
                    />
                    <p v-if="$v.$anyError">
                      Please Fill all the required field
                    </p>

                    <hr />
                    <a href="#" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i>
                      Login with Google
                    </a>
                    <a href="#" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i>
                      Login with Facebook
                    </a>
                  </form>
                  <hr />
                  <div class="text-center">
                    <router-link to="/forget" class="nav-link">
                      <i class="fas fa-fw fa-tachometer-alt"></i>
                      <span>Forget Password</span>
                    </router-link>
                  </div>
                  <div class="text-center">
                    <router-link to="/register" class="nav-link">
                      <i class="fas fa-fw fa-tachometer-alt"></i>
                      <span>Register</span>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { email, required } from "vuelidate/lib/validators";
export default {
  name: "Login",
  // mounted() {
  //     console.log("Component mounted.");
  // },
  data() {
    return {
      email: "",
      password: "",
      csrf: "",
      logindata: "",
    };
  },
  validations: {
    email: {
      email,
      required,
    },
    password: {
      required,
    },
  },
  methods: {
    Login() {
      let csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
      axios
        .post("api/login", {
          email: this.email,
          password: this.password,
          device_name: csrf,
        })
        .then((response) => {
          this.logindata = this.response;
          this.$router.push("/content");
          flash("Login Successfully", "success");

          // console.log(response);
          // location.href = "/content";
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
            flash("Please fill Valid Email & Password", "error");
          }
        });
    },
  },
};
</script>

<style></style>
 