/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import VueTypeaheadBootstrap from "vue-typeahead-bootstrap";

// import mixins
import Helpers from "./helpers";
import Filters from "./filters";

// import pages
import AppPage from "./pages/App";
import HomePage from "./pages/Home";
import MembersPage from "./pages/Members";
import PlansPage from "./pages/Plans";

// add modules
Vue.use(VueRouter);
Vue.mixin(Helpers);
Vue.mixin(Filters);

// add components
Vue.component("typeahead-input", VueTypeaheadBootstrap);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context("./", true, /\.vue$/i);
files.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        files(key).default
    )
);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// define router
const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/home", name: "home", component: HomePage },
        { path: "/members", name: "members", component: MembersPage },
        { path: "/plans", name: "plans", component: PlansPage }
    ]
});

const app = new Vue({
    el: "#app",
    router: router,
    components: { AppPage }
});
