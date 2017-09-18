const getItem = (key, callback = () => null, force = false) => {
  const item = JSON.parse(localStorage.getItem(key));

  return item && !force ? (item.data || callback()) : callback();
};

const setItem = (key, item) => localStorage.setItem(key, JSON.stringify({ data: item })) || item;

const rescue = async (resolve, reject = () => null) => {
  try {
    return await resolve();
  } catch (e) {
    return await reject();
  }
}

export {
  getItem,
  setItem,
  rescue,
}
