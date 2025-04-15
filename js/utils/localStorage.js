(function($) {
	class LocalStorage {
		/**
		 * Constructor de Local Storage
		 */
		constructor(page) {
			let localStorage = JSON.parse(window.localStorage.getItem('supergiros-theme'));
			this.page = page;
			this.storage = localStorage ? localStorage : {};
		}

		/**
		 * Obtener datos del Local Storage
		 * 
		 * @param {string} attr Atributos de la página
		 * @param {string} defaultValue Valor predeterminado
		 * @returns any|string
		 */
		get(attr, defaultValue = '') {
			let pageValue = this.storage[this.page];
			let value = pageValue && pageValue[attr] || defaultValue;
			return value;
		}

		/**
		 * Obtener datos del Local Storage
		 * 
		 * @param {string} attr Atributos de la página
		 * @param {string} value Valor a almacenar
		 */
		set(attr, value) {
			let pageValue = this.storage[this.page] || {};
			this.storage[this.page] = pageValue;
			this.storage[this.page][attr] = value;
			window.localStorage.setItem('supergiros-theme', JSON.stringify(this.storage));
		}
	}

	window.LocalStorage = LocalStorage;
})(jQuery)
