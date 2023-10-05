const axios = require("axios");

async function fetchCookies() {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8090/api/collections/cookies/records`
    );
    return response.data.items;
  } catch (error) {
    throw new Error(`Can't Fetch Cookies`);
  }
}
async function fetchSingleCookies(id) {
  try {
    const response = await axios.get(
      `http://127.0.0.1:8090/api/collections/cookies/records/${id}`
    );
    return response.data;
  } catch (error) {
    throw new Error(`Can't Fetch Cookies`);
  }
}

module.exports = { fetchCookies, fetchSingleCookies };
