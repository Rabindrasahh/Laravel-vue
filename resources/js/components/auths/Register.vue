<template>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div
                        class="col-lg-5 d-none d-lg-block bg-register-image"
                    ></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">
                                    Create an Account!
                                </h1>
                            </div>
                            <form
                                class="user"
                                method="POST"
                                @submit.prevent="RegiserHandle"
                            >
                                <div class="form-group">
                                    <input
                                        type="text"
                                        name="name"
                                        v-model="name"
                                        :class="{ error: $v.name.$error }"
                                        class="form-control form-control-user"
                                        id="exampleFullName"
                                        placeholder="Full Name"
                                        @blur="$v.name.$touch()"
                                    />
                                    <div v-if="$v.name.$error">
                                        <p
                                            v-if="!$v.name.required"
                                            style="color: blue"
                                        >
                                            This field is required
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input
                                        type="email"
                                        name="email"
                                        v-model="email"
                                        :class="{ error: $v.email.$error }"
                                        class="form-control form-control-user"
                                        id="exampleInputEmail"
                                        placeholder="Email Address"
                                        @blur="$v.email.$touch()"
                                    />
                                    <div v-if="$v.email.$error">
                                        <p
                                            v-if="!$v.email.email"
                                            style="color: blue"
                                        >
                                            Please enter Valid email
                                        </p>
                                        <p
                                            v-if="!$v.email.required"
                                            style="color: blue"
                                        >
                                            This field is required
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input
                                            type="password"
                                            name="password"
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
                                            <p
                                                v-if="!$v.password.required"
                                                style="color: blue"
                                            >
                                                This field is required
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            v-model="password_confirmation"
                                            :class="{
                                                error: $v.password_confirmation
                                                    .$error,
                                            }"
                                            class="form-control form-control-user"
                                            id="exampleConfirmPassword"
                                            placeholder="Confirm Password"
                                            @blur="
                                                $v.password_confirmation.$touch()
                                            "
                                        />
                                        <div
                                            v-if="
                                                $v.password_confirmation.$error
                                            "
                                        >
                                            <p
                                                v-if="
                                                    !$v.password_confirmation
                                                        .required
                                                "
                                                style="color: blue"
                                            >
                                                This field is required
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <input
                                    :disabled="$v.$invalid"
                                    type="submit"
                                    name="submit"
                                    class="btn btn-primary btn-user btn-block"
                                    value="Register"
                                />
                                <p v-if="$v.$anyError" style="color: blue">
                                    Please fill all the required field
                                </p>
                                <hr />
                                <a
                                    href="#"
                                    class="btn btn-google btn-user btn-block"
                                >
                                    <i class="fab fa-google fa-fw"></i> Register
                                    with Google
                                </a>
                                <a
                                    href="#"
                                    class="btn btn-facebook btn-user btn-block"
                                >
                                    <i class="fab fa-facebook-f fa-fw"></i>
                                    Register with Facebook
                                </a>
                            </form>
                            <hr />

                            <div class="text-center">
                                <router-link to="/login" class="nav-link">
                                    <i class="fas fa-fw fa-tachometer-alt"></i>
                                    <span>Login</span>
                                </router-link>
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
import { email, required, sameAs } from "vuelidate/lib/validators";
export default {
    // mounted() {
    //     console.log("Hello from the register ");
    // },
    name: "Register",
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            registerData: "",
        };
    },
    validations: {
        name: {
            required,
        },
        email: {
            email,
            required,
        },
        password: {
            required,
        },
        password_confirmation: {
            required,
            sameAs: sameAs(function () {
                return this.password;
            }),
        },
    },
    methods: {
        RegiserHandle() {
            axios
                .post("/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                .then((response) => {
                    this.registerData = this.response;
                    this.$router.push("/content");
                    flash("Registered Sucessfully", "success");
                    
                });
        },
    },
};
</script>

<style></style>
