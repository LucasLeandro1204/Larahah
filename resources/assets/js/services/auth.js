import axios from 'axios';
import { getItem, setItem } from '../core/helpers';

let checked = false;
let user = getItem('user', () => ({
  name: '',
  token: '',
  checked: false,
}));

class Auth {
  static async check (force = false) {
    if ((!user.checked && !checked) || force) {
      try {
        await axios.get('/api/auth/check');
        user.checked = true;
      } catch (e) {
        this.reset();
        user.checked = false;
      }
    }
    checked = true;

    return user.checked;
  }

  static login (data) {
    user = Object.assign(user, data, { checked: true });
    setItem('user', data);
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

    return user;
  }

  static get user () {
    return user;
  }

  static reset () {
    setItem('user', {
      name: '',
      token: '',
      checked: false,
    });
  }

  static async logout () {
    this.reset();
    user.checked = false;
    try {
      await axios.get('/api/auth/logout');
    } catch (e) {
      //
    }
  }
}

export default Auth;
