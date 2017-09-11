import 'babel-polyfill';

import Vue from 'vue';
import VueStash from 'vue-stash';
import VueRouter from 'vue-router';

Vue.use(VueStash);
Vue.use(VueRouter);

import Axios from 'axios';
import Auth from './auth';

window.axios = Axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + Auth.user();

// import Echo from "laravel-echo"

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
