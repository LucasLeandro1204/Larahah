import Auth from '../services/auth';

const authenticated = async (to, from, next) => {
  if (! await Auth.check()) {
    next({
      path: '/login',
      query: { redirect: to.fullPath },
    });
  } else {
    next();
  }
}

const guest = async (to, from, next) => {
  if (! await Auth.check()) {
    next();
  } else {
    next('/');
  }
}

const logout = async (to, from, next) => {
  await Auth.logout();
  await Auth.check();
  location.reload();
  next('/');
}

export {
  guest,
  logout,
  authenticated,
}
