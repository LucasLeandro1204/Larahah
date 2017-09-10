const getItem = (item, cb = () => null) => localStorage.getItem(item) || cb();

export {
  getItem,
}
