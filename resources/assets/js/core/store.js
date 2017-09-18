import Auth from '../services/auth';

const Store = {
  user: Auth.user(),
  messages: {
    sent: {},
    received: {},
    favorited: {},
  },
}

export default Store;
