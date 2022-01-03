<template>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div
                                class="col-lg-6 d-none d-lg-block bg-password-image"
                            ></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">
                                            Forgot Your Password?
                                        </h1>
                                    </div>
                                    <form
                                        class="user"
                                        @submit.prevent="Forget()"
                                    >
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                v-model="email"
                                                :class="{
                                                    error: $v.email.$error,
                                                }"
                                                class="form-control form-control-user"
                                                id="exampleInputEmail"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..."
                                                @blur="$v.email.$touch()"
                                            />
                                            <div v-if="$v.email.$error">
                                                <p
                                                    v-if="!$v.email.email"
                                                    style="color: blue"
                                                >
                                                    Please enter a valid email
                                                </p>
                                                <p
                                                    v-if="!$v.email.required"
                                                    style="color: blue"
                                                >
                                                    This field is required
                                                </p>
                                            </div>
                                        </div>
                                        <input
                                            :disabled="$v.$invalid"
                                            type="submit"
                                            class="btn btn-primary btn-user btn-block"
                                            value="Reset Password"
                                        />
                                        <p v-if="$v.$anyError">
                                            Please fill all the Required field
                                        </p>
                                    </form>
                                    <hr />

                                    <div class="text-center">
                                        <router-link
                                            to="/login"
                                            class="nav-link"
                                        >
                                            <i
                                                class="fas fa-fw fa-tachometer-alt"
                                            ></i>
                                            <span>Login</span>
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
import { required, email } from "vuelidate/lib/validators";
export default {
    // mounted() {
    //     console.log("Hello from the forget");
    // },
    name: "Forget",
    data() {
        return {
            email: "",
        };
    },
    validations: {
        email: {
            required,
            email,
        },
    },
    methods: {
        Forget() {
            axios
                .post("http://127.0.0.1:8000/password/email", {
                    email: this.email,
                })
                .then(function (response) {
                    flash("Reset Password link is sent", "success");
                    // this.email='',
                    // this.password='',
                    console.log(response);
                });
        },
    },
};
</script>

<style></style>
