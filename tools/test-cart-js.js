const fs = require('fs');
const path = require('path');
const vm = require('vm');

const projectRoot = path.resolve(__dirname, '..');
const scriptPath = path.join(projectRoot, 'assets', 'js', 'cart.js');
const script = fs.readFileSync(scriptPath, 'utf8');

const storage = {
  origen_carrito: JSON.stringify([
    null,
    { id: '', cantidad: 'x' },
    { id: 'short-con-calza', nombre: 'Short con calza interna', mostrar_precio: false, cantidad: '2' },
  ]),
};

const addButton = {
  dataset: {
    productId: 'short-con-calza',
    productName: 'Short con calza interna',
    productPrice: '',
    productShowPrice: '0',
    productImage: '/assets/img/cliente/productos/short-con-calza.webp',
  },
  textContent: 'Sumar a tu pedido',
  classList: {
    add() {},
    remove() {},
  },
  querySelector(selector) {
    if (selector === '.catalog-card__add-text') return this;
    return null;
  },
  addEventListener(type, callback) {
    if (type === 'click') this.click = callback;
  },
};

const countNode = {
  textContent: '',
  hidden: true,
};

const context = {
  console,
  Intl,
  Number,
  String,
  JSON,
  Array,
  localStorage: {
    getItem(key) {
      return Object.prototype.hasOwnProperty.call(storage, key) ? storage[key] : null;
    },
    setItem(key, value) {
      storage[key] = String(value);
    },
    removeItem(key) {
      delete storage[key];
    },
  },
  document: {
    querySelectorAll(selector) {
      if (selector === '[data-cart-add]') return [addButton];
      if (selector === '[data-cart-count]') return [countNode];
      if (selector === '[data-cart-clear]') return [];
      return [];
    },
    querySelector() {
      return null;
    },
  },
  window: {
    setTimeout(callback) {
      callback();
    },
  },
};

vm.createContext(context);
vm.runInContext(script, context, { filename: 'cart.js' });

if (typeof addButton.click !== 'function') {
  throw new Error('Add-to-cart listener was not registered');
}

addButton.click();

const cart = JSON.parse(storage.origen_carrito);
const item = cart.find((entry) => entry.id === 'short-con-calza');

if (!item) {
  throw new Error('Existing item was removed unexpectedly');
}

if (item.cantidad !== 3) {
  throw new Error(`Expected sanitized quantity 3, got ${item.cantidad}`);
}

if (cart.some((entry) => !entry || !entry.id)) {
  throw new Error('Malformed entries were not removed');
}

if (countNode.textContent !== '3' || countNode.hidden !== false) {
  throw new Error('Cart count was not updated');
}

console.log('Cart JS behavior OK');
