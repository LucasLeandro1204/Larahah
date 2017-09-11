import { getItem, setItem } from './helpers';

class Auth {
  static check () {
    return getItem('user', () => false);
  }

  static user () {
    return getItem('user', () => ({
      name: '',
      token: '',
    }))
  }

  static login (user) {
    setItem('user', Object.assign({}, user.data, { token: user.token }));
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + user.token;
  }

  static logout () {
    setItem('user', null);
  }
}

export default Auth;
