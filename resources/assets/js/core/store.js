import Auth from '../services/auth';

const Store = {
  user: Auth.user(),
  messages: {
    received: {
      data: [],
      meta: {
        current_page: 0,
      },
    },
    sent: {
      data: [],
      meta: {
        current_page: 0,
      },
    },
    favorited: {
      data: [],
      meta: {
        current_page: 0,
      },
    },
  },
}

export default Store;
