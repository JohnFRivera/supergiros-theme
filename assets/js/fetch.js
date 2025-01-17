const HOSTNAME = '/wordpress/wp-json/supergiros/v1/';

/**
 * Solo obtener datos del API
 * @param {string} api
 * @returns object
 */
const getData = async (api) => {
  try {
    const response = await fetch(HOSTNAME + api);
    const data = await response.json();
    if (!response.ok) {
      throw new Error(data.message);
    }
    return data;
  } catch (error) {
    throw new Error(error.message);
  }
};

/**
 * Obtener datos permitiendo el ingreso de parametros
 * @param {string} api
 * @param {object} body
 * @returns object
 */
const postData = async (api, body) => {
  try {
    const response = await fetch(HOSTNAME + api, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
      },
      body: JSON.stringify(body),
    });
    const data = await response.json();
    if (!response.ok) {
      throw new Error(data.message);
    }
    return data;
  } catch (error) {
    throw new Error(error.message);
  }
};
