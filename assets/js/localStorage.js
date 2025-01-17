const localStorage = window.localStorage;

/**
 * Obtener datos del almacenamiento local
 * @param {String} key
 */
function getLocalStorage(key) {
  return JSON.parse(localStorage.getItem(key));
}
/**
 * Guardar datos en el almacenamiento local
 * @param {String} key
 * @param {any} value
 */
function setLocalStorage(key, value) {
  localStorage.setItem(key, JSON.stringify(value));
}
/**
 * Eliminar elemento del almacenamiento local
 * @param {String} key
 */
function removeLocalStorage(key) {
  localStorage.removeItem(key);
}
