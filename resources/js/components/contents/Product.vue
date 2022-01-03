<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Product Upload</div>

          <div class="card-body">
            <form
              method="POST"
              action=""
              @submit.prevent="ProductUploads"
              enctype="multipart/form-data"
            >
              <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-right"
                  >Product Name</label
                >

                <div class="col-md-6">
                  <input
                    id="name"
                    type="text"
                    class="form-control"
                    name="proName"
                    v-model="formData.proName"
                    required
                    autofocus
                  />
                </div>
              </div>

              <div class="row mb-3">
                <label
                  for="proQuantity"
                  class="col-md-4 col-form-label text-md-right"
                  >Product Price</label
                >

                <div class="col-md-6">
                  <input
                    id="proPrice"
                    type="number"
                    class="form-control"
                    name="proPrice"
                    v-model="formData.proPrice"
                    required
                  />
                </div>
              </div>

              <div class="row mb-3">
                <label
                  for="proQuanity"
                  class="col-md-4 col-form-label text-md-right"
                  >Product Quantity</label
                >

                <div class="col-md-6">
                  <input
                    id="proQuanity"
                    type="number"
                    class="form-control"
                    name="proQuanity"
                    v-model="formData.proQuanity"
                    required
                  />
                </div>
              </div>

              <div class="row mb-3">
                <label
                  for="proImage"
                  class="col-md-4 col-form-label text-md-right"
                  >Product Image</label
                >

                <div class="col-md-6">
                  <input
                    id="proImage"
                    type="file"
                    class="form-control"
                    @change="croppie"
                    name="proImage"
                    required
                  />
                </div>
              </div>
              <vue-croppie
                ref="croppieRef"
                :enableOrientation="true"
                :boundary="{ width: 450, height: 300 }"
                :viewport="{ width: 450, height: 300, type: 'square' }"
              >
              </vue-croppie>
              <!-- the result -->
              <img :src="cropped" />
              <button type="button" class="btn btn-primary" @click="crop">
                Crop
              </button>

              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <input
                    type="submit"
                    class="btn btn-primary"
                    value="Upload Products"
                  />
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Product",
  data() {
    return {
      formData: {
        proName: "",
        proPrice: "",
        proQuanity: "",
      },
      files: "",

      proData: "",

      croppieImage: "",
      cropped: null,
    };
  },
  methods: {
    croppie(e) {
      var files = e.target.files || e.target.files[0] || e.dataTransfer.files;
      // console.log(files[0].name);
      if (!files.length) return;

      var reader = new FileReader();
      reader.onload = (e) => {
        this.$refs.croppieRef.bind({
          url: e.target.result,
        });
      };

      var images = reader.readAsDataURL(files[0]);
    },
    crop() {
      // Options can be updated.
      // Current option will return a base64 version of the uploaded image with a size of 600px X 450px.
      let options = {
        type: "base64",
        size: { width: 600, height: 450 },
        format: "jpeg",
      };
      this.$refs.croppieRef.result(options, (output) => {
        this.cropped = this.croppieImage = output;
        //  console.log(this.croppieImage);
        // if (!this.croppieImage) {
        //   this.croppieImage === images;
        // }
      });
    },
    ProductUploads() {
      let self = this;
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      const formData = new FormData();
      formData.append("files", this.croppieImage);
      _.each(this.formData, (value, key) => {
        formData.append(key, value);
      });
      // console.log(formData);
      axios
        .post("api/productUpload", formData, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then(function (response) {
          // self.proData = this.response.FormData;
          flash("Product Inserted  Successfully", "success");
        });
    },
  },
};
</script>

<style>
</style>

