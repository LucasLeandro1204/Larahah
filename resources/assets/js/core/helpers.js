const getItem = (key, cb = () => null) => {
  const item = JSON.parse(localStorage.getItem(key));
  if (item && (item.data != null && item != 'undefined')) {
    return item.data;
  }

  return cb();
};

const setItem = (key, item) => {
  localStorage.setItem(key, JSON.stringify({ data: item }));
};

export {
  getItem,
  setItem,
}
