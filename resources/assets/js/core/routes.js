import Home from '../components/Home.vue';
import Login from '../components/auth/Login.vue';
import Register from '../components/auth/Register.vue';
import Message from '../components/message/Index.vue';
import { logout, guest, authenticated } from './guards';

export default [
  { path: '/', name: 'home', component: Home },
  { path: '/logout', name: 'logout', beforeEnter: logout },
  { path: '/login', name: 'login', component: Login, beforeEnter: guest },
  { path: '/register', name: 'register', component: Register, beforeEnter: guest },
  { path: '/message', name: 'message', component: Message, beforeEnter: authenticated },
];
