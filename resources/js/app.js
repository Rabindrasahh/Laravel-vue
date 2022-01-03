/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;
import router from "./router.js";
import Vuelidate from "vuelidate";

Vue.use(Vuelidate);

window.events = new Vue();

window.flash = function (message) {
    window.events.$emit("flash", message);
};

// vue cropper
// import Vue from "vue";
import VueCroppie from "vue-croppie";
import "croppie/croppie.css"; // import the croppie css manually

Vue.use(VueCroppie);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component("flash", require("./components/auths/flash.vue").default);
// Vue.component(
//     "crop-upload",
//     require("./components/contents/Cropper.vue").default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    // mode: "history",
    el: "#app",
    router,
});
