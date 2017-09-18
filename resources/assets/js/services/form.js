import axios from 'axios';

class Form {
  constructor ({ fields, route }) {
    this.keys = [];
    this.fields = fields;
    this._errors = {};
    this.errors = this.proxyErrors();
    this.route = route;
  }

  post () {
    return this.request('post');
  }

  request (method = 'get', sufix = '') {
    this._errors = {};

    return new Promise((resolve, reject) => {
      axios.request({
        method: method,
        url: this.route + sufix,
        data: this.fields,
      })
      .then((response) => {
        resolve(response);
      })
      .catch(({ response }) => {
        const { data: { errors } } = response;
        this._errors = Object.keys(errors).reduce((obj, err) => Object.assign({}, obj, { [err]: errors[err] }), {});
        reject(response);
      });
    });
  }

  set fields (fields) {
    this.keys = Object.keys(fields);
    this.keys.forEach(field => this[field] = fields[field]);
  }

  get fields () {
    return this.keys.reduce((obj, field) => Object.assign({}, obj, { [field]: this[field] }), {});
  }

  proxyErrors () {
    const self = this;

    return new Proxy({}, {
      get (obj, prop) {
        const err = self._errors[prop];

        return err ? err[0] : null;
      }
    })
  }
}

export default Form;
