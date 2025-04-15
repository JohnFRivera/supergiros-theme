(function($) {
	class Query {
		#HOSTNAME;

		/**
		 * Constructor de Fetch
		 */
		constructor() {
			this.#HOSTNAME = HOSTNAME;
		}

		/**
		 * Obtener datos del API
		 * 
		 * @param {string} endpoint
		 * @returns Object|Error
		 */
		async get(endpoint) {
			try {
				const response = await fetch(this.#HOSTNAME + endpoint);
				const data = await response.json();
				if (!response.ok) throw new Error(data.message);
				return data;
			} catch (error) {
				throw new Error(error.message);
			}
		}

		/**
		 * Enviar datos al API
		 * 
		 * @param {string} endpoint
		 * @param {Object} body
		 * @returns Object|Error
		 */
		async post(endpoint, body) {
			try {
				const response = await fetch(this.#HOSTNAME + endpoint, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						Accept: 'application/json',
					},
					body: JSON.stringify(body),
				});
				const data = await response.json();
				if (!response.ok) throw new Error(data.message);
				return data;
			} catch (error) {
				throw new Error(error.message);
			}
		}
 
		/**
		 * Eliminar datos del API
		 * 
		 * @param {string} endpoint
		 * @param {Object} nonce
		 * @param {Object} body
		 * @returns Object|Error
		 */
		async delete(endpoint, nonce, body) {
			try {
				const response = await fetch(this.#HOSTNAME + endpoint, {
					method: 'DELETE',
					headers: {
						'Content-Type': 'application/json',
						'X-WP-Nonce': nonce
					},
					body: JSON.stringify(body)
				});
				const data = await response.json();
				if (!response.ok) throw new Error(data.message);
				return data;
			} catch (error) {
				throw new Error(error.message);
			}
		}
	}

	window.Query = Query;
})(jQuery)
