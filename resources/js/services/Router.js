import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./Routes.js";
Vue.use(VueRouter);
const router=new VueRouter({
    mode:"history",
    routes:routes

})
export default router;
