const getItem = (item, cb = () => null) => {
  const data = JSON.parse(localStorage.getItem(item));
  if (data && data.data != null && data.data != 'undefined') {
    return data.data;
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
