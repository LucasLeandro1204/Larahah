import { auth } from './guards';
import Home from '../components/Home.vue';

export default [
  { path: '/', name: 'home', component: Home },
]
