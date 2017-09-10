import Auth from './auth';

const authenticated = (to, from, next) => {
  if (! Auth.check()) {
    next({
      path: '/login',
      query: { redirect: to.fullPath },
    });
  } else {
    next();
  }
}

const logout = (to, from, next) => {
  Auth.logout();
  next('/');
}

export default {
  logout,
  authenticated,
}