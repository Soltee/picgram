/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/*
// Vue.component('browse-posts', require('./components/Browse.vue').default);
// Vue.component('browse-post', require('./components/Post.vue').default);

*/

import { createApp } from 'vue'
const app = createApp({});

//Components
import Browse from './components/Browse';
import FollowProfile from './components/FollowProfile';
import Home from './components/Home';
import LogoutModal from './components/Logout';
import Post from './components/Post';
import SearchModel from './components/SearchModel';
import UploadPost from './components/UploadPost';
import UserProfile from './components/UserProfile';
import WelcomeView from './components/Welcome';

app.component('welcome-view', WelcomeView);
app.component('search-model', SearchModel);
app.component('logout-modal', LogoutModal);
app.component('home-posts', Home);
app.component('upload', UploadPost);
app.component('user-profile', UserProfile);
app.component('follow-profile', FollowProfile);
app.component('browse-posts', Browse);
app.component('browse-post', Post);


//Paste to DOM
app.mount('#app');

    