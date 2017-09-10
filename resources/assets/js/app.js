import './core/bootstrap';

import Vue from 'vue';
import VueRouter from 'vue-router';

import store from './core/store';
import routes from './core/routes';
import App from './components/App.vue';

const router = new VueRouter({
  routes
});

window.App = new Vue({
  router,
  data: {
    store,
  },
  render: h => h(App),
}).$mount('#larahah');
