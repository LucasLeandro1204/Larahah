import { getItem } from './helpers';

const Store = {
  user: getItem('user', () => ({
    name: '',
  })),
}

export default Store;
