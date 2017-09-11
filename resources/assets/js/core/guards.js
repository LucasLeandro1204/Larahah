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

const guest = (to, from, next) => {
  if (! Auth.check()) {
    next();
  } else {
    next('/');
  }
}

const logout = (to, from, next) => {
  if (Auth.check()) {
    Auth.logout();
    location.reload();
  } else {
    next('/');
  }
}

export {
  guest,
  logout,
  authenticated,
}
