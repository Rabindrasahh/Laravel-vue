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
                    <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input
                        type="password"
                        v-model="current_password"
                        class="form-control form-control-user"
                        id="exampleInputPassword"
                        aria-describedby="emailHelp"
                        placeholder="Old Password"
                        name="current_password"
                        @blur="$v.current_password.$touch()"
                      />
                      <div v-if="$v.current_password.$error">
                        <p
                          v-if="!$v.current_password.required"
                          style="color: blue"
                        >
                          This field is required
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        v-model="new_password"
                        name="new_password"
                        class="form-control form-control-user"
                        id="exampleInputNewPassword"
                        aria-describedby="emailHelp"
                        placeholder="New Password"
                        @blur="$v.new_password.$touch()"
                      />
                      <div v-if="$v.new_password.$error">
                        <p v-if="!$v.new_password.required" style="color: blue">
                          This field is required
                        </p>
                      </div>
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        v-model="new_confirm_password"
                        name="new_confirm_password"
                        class="form-control form-control-user"
                        id="exampleInputNewConfirmPassword"
                        placeholder=" Confirm New Password"
                        @blur="$v.new_confirm_password.$touch()"
                      />
                      <div v-if="$v.new_confirm_password.$error">
                        <p
                          v-if="!$v.new_confirm_password.required"
                          style="color: blue"
                        >
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
                      </div>
                    </div>
                    <input
                      :disabled="$v.$invalid"
                      type="submit"
                      name="submit"
                      class="btn btn-primary btn-user btn-block"
                      value="Change Password"
                      v-on:click.prevent="changePassword()"
                    />
                  </form>
                  <p v-if="$v.$anyError" style="color: blue">
                    Please insert Valid Input
                  </p>
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
import { required, sameAs } from "vuelidate/lib/validators";

export default {
  // mounted() {
  //     console.log("Password change");
  // },
  name: "Changepassword",
  data() {
    return {
      current_password: "",
      new_password: "",
      new_confirm_password: "",
    };
  },
  validations: {
    current_password: {
      required,
    },
    new_password: {
      required,
    },
    new_confirm_password: {
      required,
      sameAs: sameAs(function () {
        return this.new_password;
      }),
    },
  },
  methods: {
    changePassword() {
      axios
        .post("http://127.0.0.1:8000/api/changePassword", {
          current_password: this.current_password,
          new_password: this.new_password,
          new_confirm_password: this.new_confirm_password,
        })
        .then(function (response) {
          // console.log("Hello");
          // this.current_password = "";
          // this.new_password = "";
          // this.new_confirm_password = "";
          this.$router.push("/content");
          flash("Password Changed  Sucessfully", "success");
        });
    },
  },
};
</script>

<style></style>
