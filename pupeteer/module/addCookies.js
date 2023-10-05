const axios = require("axios");
const url = `http://127.0.0.1:8090/api/collections/cookies/records`;

async function sendCookies(data) {
  try {
    const response = await axios.post(url, data);
    return response.data.items;
  } catch (error) {
    throw new Error(`Can't Fetch Cookies`);
  }
}

module.exports = sendCookies;
