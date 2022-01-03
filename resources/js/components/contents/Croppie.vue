<template>
  <div>
    <input type="file" @change="croppie" />
    <vue-croppie
      ref="croppieRef"
      :enableOrientation="true"
      :boundary="{ width: 450, height: 300 }"
      :viewport="{ width: 450, height: 300, type: 'square' }"
    >
    </vue-croppie>
    <!-- the result -->
    <img :src="cropped" />
    <button type="button" class="btn btn-primary" @click="crop">Crop</button>
  </div>
</template>

<script>
import VueCroppie from "vue-croppie";
import "croppie/croppie.css"; // import the croppie css manually

export default {
  name: "Croppie",
  data() {
    return {
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
        console.log(this.croppieImage);
      });
    },
  },
};
</script>
