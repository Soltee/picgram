/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { VueMasonryPlugin } from 'vue-masonry';
Vue.use(VueMasonryPlugin);
export const serverBus = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue-pomponent(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('welcome-view', require('./components/Welcome.vue').default);
Vue.component('home-posts', require('./components/Home.vue').default);
Vue.component('upload', require('./components/UploadPost.vue').default);
Vue.component('search-model', require('./components/SearchModel.vue').default);
Vue.component('browse-posts', require('./components/Browse.vue').default);
Vue.component('browse-post', require('./components/Post.vue').default);
Vue.component('follow-profile', require('./components/FollowProfile.vue').default);
Vue.component('user-profile', require('./components/UserProfile.vue').default);

Vue.component('logout-modal', require('./components/Logout.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
