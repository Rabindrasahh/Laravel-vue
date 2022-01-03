<template>
  <div class="container">
    <h2 class="text-center">User Information</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Firstname</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users.data" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <a
              href="javascript:void(0)"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
              data-bs-dismiss="modal"
              v-on:click="editUser(user.id)"
            >
              Edit
            </a>
            ||<a href="javascript:void(0)" v-on:click="deleteUser(user.id)"
              >Delete</a
            >
          </td>
        </tr>
      </tbody>
    </table>
    <pagination :data="users" @pagination-change-page="getResults"></pagination>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Update Information</h1>
            </div>
            <form method="post">
              <div class="form-group">
                <input
                  type="text"
                  name="name"
                  v-model="editname"
                  class="form-control form-control-user"
                  id="exampleFullName"
                  placeholder="Full Name"
                  @blur="$v.editname.$touch()"
                />
                <div v-if="$v.editname.$error">
                  <p v-if="!$v.editname.required" style="color: blue">
                    This field is required
                  </p>
                </div>
                <input type="hidden" name="id" v-model="id" />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  name="email"
                  v-model="editemail"
                  class="form-control form-control-user"
                  id="exampleInputEmail"
                  placeholder="Email Address"
                  @blur="$v.editemail.$touch()"
                />
                <div v-if="$v.editemail.$error">
                  <p v-if="!$v.editemail.email" style="color: blue">
                    Please enter a valid email
                  </p>
                  <p v-if="!$v.editemail.required" style="color: blue">
                    This field is required
                  </p>
                </div>
              </div>

              <input
                type="submit"
                :disabled="$v.$invalid"
                name="submit"
                class="btn btn-primary btn-user btn-block"
                value="Update"
                v-on:click.prevent="Updateuser()"
                data-bs-dismiss="modal"
              />
            </form>
            <p v-if="$v.$anyError">Please Fill all the required field</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { required, email } from "vuelidate/lib/validators";
export default {
  name: "UserInfo",

  data() {
    return {
      id: "",
      name: "",
      email: "",
      users: "",
      editname: "",
      editemail: "",
      updated: "",
      users: {},
    };
  },
  validations: {
    editname: {
      required,
    },
    editemail: {
      required,
      email,
    },
  },
  created() {
    this.getUser();
  },
  methods: {
    getUser() {
      axios.get("http://127.0.0.1:8000/api/getUser").then((response) => {
        this.users = response.data;
      });
    },
    editUser(id) {
      axios.get("http://127.0.0.1:8000/api/editUser/" + id).then((response) => {
        (this.id = response.data.id),
          (this.editname = response.data.name);
          (this.editemail = response.data.email);
      });
    },
    Updateuser() {
      let self = this;
      axios
        .put("http://127.0.0.1:8000/api/updateUser", {
          id: this.id,
          name: this.editname,
          email: this.editemail,
        })
        .then(function (response) {
          self.getUser();
          flash(" Successfully Updated", "success");
        });
    },
    deleteUser(id) {
      if (confirm("Do you really want to delete?")) {
        axios
          .delete("http://127.0.0.1:8000/api/deleteUser/" + id)
          .then((response) => {
            this.getUser();
            flash(" Successfully Deleted", "success");
          });
      }
    },
    getResults(page = 1) {
      axios
        .get("http://127.0.0.1:8000/api/getUser?page=" + page)
        .then((response) => {
          this.users = response.data;
          flash("Your are redirected to other page", "success");
        });
    },
  },
};
</script>

<style></style>
