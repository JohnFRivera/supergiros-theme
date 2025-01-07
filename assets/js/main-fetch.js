const HOSTNAME = '/wordpress/wp-json';

const getData = async (api = '') => {
  try {
    const response = await fetch(api);
    const data = await response.json();
    if (data.status !== 200) {
      throw new Error(data.message);
    }
    return data;
  } catch (error) {
    console.error(error);
    return null;
  }
};
const postData = async (api = '', body = {}) => {
  try {
    const response = await fetch(api, {
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
    throw new Error(error);
  }
};
