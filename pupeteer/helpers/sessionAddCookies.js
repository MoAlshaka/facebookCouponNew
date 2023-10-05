const { delay } = require("../utilities/utilies");
const sendCookies = require("../module/addCookies");
const {
  oldEmailFieldClass,
  oldPassFieldClass,
  oldLoginBtnClass,
  oldprofileName,
} = require("../config/elementSelectors");
const regex = /(\d+|\w+)(?=\/\?)/m;
let myArray = [];

const session = async (page, email = {}, delayTime = 4) => {
  const user = email.email;
  const password = email.pass;

  await page.goto(`https://mbasic.facebook.com/`);
  await delay(delayTime);

  await page.type(oldEmailFieldClass, user);
  await delay(delayTime);

  await page.type(oldPassFieldClass, password);
  await delay(delayTime);

  await page.click(oldLoginBtnClass);
  await delay(delayTime);

  await page.goto("https://mbasic.facebook.com/menu/bookmarks");

  const cookies = await page.cookies("https://mbasic.facebook.com/");
  const profileName = await page.$eval(oldprofileName, (el) => el.textContent);

  const data = {
    name: profileName,
    value: JSON.stringify(cookies),
  };

  sendCookies(data);

  const allCookies = await page.cookies();
  // Delete each cookie
  for (const cookie of allCookies) {
    await page.deleteCookie(cookie);
  }
  return profileName;
};

module.exports = session;
