import Vue from "vue";
import Router from "vue-router";
Vue.use(Router);
import Dashboard from "./components/contents/Dashboard.vue";
import Content from "./components/layouts/Content.vue";
import Login from "./components/auths/Login.vue";
import Register from "./components/auths/Register.vue";
import Forget from "./components/auths/Forget.vue";
//import Logout from './components/auths/Logout.vue'
import UserInfo from "./components/contents/UserInfo.vue";
import Product from "./components/contents/Product.vue";
import MultiFile from "./components/contents/MultiFile.vue";
import Cropper from "./components/contents/Cropper.vue";
import Croppie from "./components/contents/Croppie.vue";
import App from "./App.vue";

import Password from "./components/auths/Password.vue";

const routes = [
    { path: "/", redirect: "/login" },
    //{ path: '/home', redirect:'/content'},

    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/forget",
        name: "Forget",
        component: Forget,
    },
    {
        path: "/home",
        name: "App",
        component: App,
        children: [
            { path: "/home", redirect: "/content" },

            {
                path: "/userinfo",
                name: "UserInfo",
                component: UserInfo,
            },

            {
                path: "/dashboard",
                name: "Dashboard",
                component: Dashboard,
            },
            {
                path: "/content",
                name: "Content",
                component: Content,
            },
            {
                path: "/change_password",
                name: "ChangePassword",
                component: Password,
            },
            {
                path: "/product",
                name: "Product",
                component: Product,
            },
            {
                path: "/multiUpload",
                name: "MultiFile",
                component: MultiFile,
            },
            {
                path: "/crop_image",
                name: "Cropper",
                component: Cropper,
            },
            {
                path: "/crops_image",
                name: "Croppie",
                component: Croppie,
            },
        ],
    },
];

const router = new Router({
    routes: routes,
});
export default router;
