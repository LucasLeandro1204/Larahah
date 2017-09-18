import axios from 'axios';
import { getItem as get, setItem as set, rescue } from '../core/helpers';

class Auth {
  static async check () {
    if (! this.user().auth.checked) {
      const auth = { auth: { checked: true, ok: false, } };

      if (! await rescue(() => axios.get('/api/auth/check'), () => false)) {
        auth.ok = true;
      }

      set('user', Object.assign(this.user(true), auth));
    }

    return this.user().auth.ok;
  }

  static login (data) {
    data = set('user', Object.assign(data, { auth: { checked: true, ok: true, } }));
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;

    return this.user();
  }

  static user (force = false) {
    return get('user', () => ({
      token: '',
      auth: {
        checked: false,
        ok: false,
      },
    }), force);
  }

  static async logout () {
    this.reset();
    await rescue(axios.get('/api/auth/logout'));
  }

  static reset () {
    return set('user', this.user(true));
  }
};

export default Auth;
