
<!-- <p><label for="">
   Username or email  
<span class="required">*</span>
</label>
<input name="username" type="text" required="" placeholder="Username">
</p>
<p><label>
  Password
<span class="required">*</span>
</label>
<input name="username" type="text" required="" placeholder="Username">
</p>
<button type="submit" data-button-action="" class="btn btn-primary btn-block w-100 mt-1">Login</button> -->
<form class="bedove-login-form-ajax" data-toggle="validator">
            <p>
                <label>Username or email <span class="required">*</span></label>
                <input name="username" type="text" required="" placeholder="Username">
            </p>
            <p>
                <label>Password <span class="required">*</span></label>
                <input name="password" type="password" required="" placeholder="Password">
            </p>
            <button type="submit" data-button-action="" class="btn btn-primary btn-block w-100 mt-1">Login</button>
            <input type="hidden" name="action" value="bedove_login">
            <input type="hidden" id="security-login" name="security-login" value="9e44fbe64c">
            <input type="hidden" name="_wp_http_referer" value="/my-account/">        
        </form>


        <form name="registerform" id="registerform" action="https://facetedfragrances.com/wp-login.php?action=register" method="post" novalidate="novalidate">
			<p>
				<label for="user_login">Username</label>
				<input type="text" name="user_login" id="user_login" class="input" value="" size="20" autocapitalize="off">
			</p>
			<p>
				<label for="user_email">Email</label>
				<input type="email" name="user_email" id="user_email" class="input" value="" size="25">
			</p>
						<p id="reg_passmail">
				Registration confirmation will be emailed to you.			</p>
			<br class="clear">
			<input type="hidden" name="redirect_to" value="">
			<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Register">
			</p>
		</form>

        function  myFunction() {
   var link = document.getElementsByClassName('register-link')[0].setAttribute('href','');
var formm = document.createElement("form");
document.getElementsByClassName("bedove-login-form-ajax")[0].style.display="none";
formm.setAttribute("method", "post");
formm.setAttribute("action", "https://facetedfragrances.com/wp-login.php?action=register");
 var br = document.createElement("br");
var FN=document.createElement("input");
FN.setAttribute("type","text");
FN.setAttribute("name","user_login");
var Email=document.createElement("input");
Email.setAttribute("type","email");
Email.setAttribute("name","user_email");
var s=document.createElement("input");
s.setAttribute("type","submit");
s.setAttribute("name","wp-submit");
s.setAttribute("id","wp-submit");
formm.appendChild(FN);
  formm.appendChild(br.cloneNode()); 
formm.appendChild(Email);
formm.appendChild(s);
document.getElementsByClassName("register-link")[0]
               .appendChild(formm);
};


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
                    v-on:change="onFileChange"
                    name="proImage"
                    required
                  />
                </div>
              </div>
              <div v-if="imagepreview" class="mt-6">
                <img
                  :src="imagepreview"
                  class="figure-img img-fluid rounded"
                  style="max-height: 100px; width: 100px"
                />
              </div>

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
      proImage: "",

      proData: "",

      imagepreview: "",
    };
  },
  methods: {
    onFileChange(e) {
      this.proImage = e.target.files[0];
      console.log(e.target.files[0]);
      let reader = new FileReader();
      reader.readAsDataURL(this.proImage);
      reader.onload = (e) => {
        this.imagepreview = e.target.result;
      };
    },
    ProductUploads() {
      let self = this;
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      const formData = new FormData();
      formData.append("proImage", this.proImage);
      _.each(this.formData, (value, key) => {
        formData.append(key, value);
      });
      console.log(formData);
      axios
        .post("api/productUpload", formData, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then(function (response) {
          //  self.proData = this.response.FormData;
          flash("Product Inserted  Successfully", "success");
        })
        .catch(function (error) {
          flash("Please Fill valid Value", "error");
        });
    },
  },
};
</script>

<style>
</style>
https://chafikgharbi.com/image-crop-upload/


<!-- <template>
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
                    v-on:change="onFileChange"
                    name="proImage"
                    required
                  />
                </div>
              </div>
              <div v-if="imagepreview" class="mt-6">
                <img
                  :src="imagepreview"
                  class="figure-img img-fluid rounded"
                  style="max-height: 100px; width: 100px"
                />
              </div>
              <div
                v-if="this.imagepreview"
                class="
                  my-3
                  d-flex
                  align-items-center
                  justify-content-center
                  mx-auto
                "
              >
                <vue-cropper
                  class="mr-2 w-50"
                  ref="cropper"
                  :guides="true"
                  :src="imagepreview"
                ></vue-cropper>

                <!-- Cropped image previewer -->
                <img class="ml-2 w-50 bg-light" :src="croppedImageSrc" />
              </div>
              <button v-if="this.imagepreview" @click="cropImage">Crop</button>

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
import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";

export default {
  components: {
    VueCropper,
  },
  name: "Product",
  data() {
    return {
      formData: {
        proName: "",
        proPrice: "",
        proQuanity: "",
      },
      proImage: "",

      proData: "",

      imagepreview: "",
      croppedImageSrc: "",
    };
  },
  methods: {
    onFileChange: function (e) {
      this.proImage = e.target.files[0];
      console.log(e.target.files[0]);
      // let reader = new FileReader();
      // reader.readAsDataURL(this.proImage);
      // reader.onload = (e) => {
      //   this.imagepreview = e.target.result;
      // };
      if (typeof FileReader === "function") {
        const reader = new FileReader();
        reader.onload = (event) => {
          this.imagepreview = event.target.result;

          // Rebuild cropperjs with the updated source
          this.$refs.cropper.replace(event.target.result);
        };
        reader.readAsDataURL(this.proImage);
      } else {
        alert("Sorry, FileReader API not supported");
      }
    },
    cropImage() {
      // Get image data for post processing, e.g. upload or setting image src
      this.croppedImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL();
    },

    ProductUploads() {
      let self = this;
      this.$refs.cropper.getCroppedCanvas().toBlob(function (blob) {
        let formData = new FormData();
        formData.append("proImage", blob);
        _.each(this.formData, (value, key) => {
          formData.append(key, value);
        });
        console.log(formData);
        axios
          .post("api/productUpload", formData, {
            headers: { "Content-Type": "multipart/form-data" },
          })
          .then(function (response) {
            //  self.proData = this.response.FormData;
            flash("Product Inserted  Successfully", "success");
          })
          .catch(function (error) {
            flash("Please Fill valid Value", "error");
          });
      });

      // const formData = new FormData();
      // formData.append("proImage", this.proImage);
      // _.each(this.formData, (value, key) => {
      //   formData.append(key, value);
      // });
      // console.log(formData);
      // axios
      //   .post("api/productUpload", formData, {
      //     headers: { "Content-Type": "multipart/form-data" },
      //   })
      //   .then(function (response) {
      //     //  self.proData = this.response.FormData;
      //     flash("Product Inserted  Successfully", "success");
      //   })
      //   .catch(function (error) {
      //     flash("Please Fill valid Value", "error");
      //   });
    },
  },
};
</script>

<style>
</style> -->

<!-- Croppoie
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
      proImage: "",

      proData: "",

      croppieImage: "",
      cropped: null,
    };
  },
  methods: {
    croppie(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;

      var reader = new FileReader();
      reader.onload = (e) => {
        this.$refs.croppieRef.bind({
          url: e.target.result,
        });
      };

      reader.readAsDataURL(files[0]);
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
      console.log(formData);
      axios
        .post("api/productUpload", formData, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then(function (response) {
          //  self.proData = this.response.FormData;
          flash("Product Inserted  Successfully", "success");
        })
        .catch(function (error) {
          flash("Please Fill valid Value", "error");
        });
    },
  },
};
</script>

<style>  \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
       $model = new User();
       $model->scenario = User:: SCENARIO_CREATE;
       $model->attributes = \yii::$app->request->post();
       if($model->validate())
       {
        $attributes = \yii::$app->request->post();
        $ImageData = $attributes['avatar'];
        list($type, $ImageData) = explode(';', $ImageData);
        list(, $ImageData)      = explode(',', $ImageData);
        $pos  = strpos($attributes['avatar'], ';');
        $type = explode(':', substr($attributes['avatar'], 0, $pos))[1];
        $ImageData = base64_decode($ImageData);
        $type = explode('/', $type)[1];
        $ImageName = time()."api_.".$type;
        $ImagePath = __DIR__.'/web'.'/'.$ImageName;
        file_put_contents($ImagePath,$ImageData);
        $model->save();
</style>
 -->
 https://www.adoclib.com/blog/multiple-image-uploader-in-vue-js-and-laravel.html

 this.files = e.target.files[0];
      console.log(e.target.files[0]);
      if (!proImage.length) return;

      $request->base64_image //base64 encoded
$data = substr($request->base64_image, strpos($request->base64_image, ',') + 1);
$data = base64_decode($data);
Storage::disk('local')->put("test.png", $da $image = $_POST['image'];

      $location = "upload/";

      $image_parts = explode(";base64,", $image);

      $image_base64 = base64_decode($image_parts[1]);

      $filename = "screenshot_".uniqid().'.png';

      $file = $location . $filename;

      file_put_contents(public_path($file), $image_base64);


      $idauth =Auth::user()->id;

      $data = new Scrnshot;
      
      $data->userid = $idauth;
      $data->screenshot = $files;
      $data->save();

      $data2 = Scrnshot::all();
      return $data2;
      sahrb4645
      0rZ1gNuFqW9aKKQTAT

sahrb45
SPD#0aOB23aXpj5Y$$



newsite
sahrb46451
rY#7MAqe0)D6QuJs^w
