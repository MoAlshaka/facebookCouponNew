const { delay } = require("../utilities/utilies");
const {
  oldScrapGroupClass,
  oldSeeMoreClass,
  oldScrapGroupNameClass,
} = require("../config/elementSelectors");
const regex = /(\d+|\w+)(?=\/\?)/m;
let myArray = [];

const session = async (
  page,
  cookies = [{}],
  searchGroup = "",
  groupNumber = 1,
  delayTime = 4
) => {
  await page.setCookie(...cookies.value);
  await delay(delayTime);
  await page.goto(
    `https://mbasic.facebook.com/search/groups?q=${searchGroup}&filters=eyJwdWJsaWNfZ3JvdXBzOjAiOiJ7XCJuYW1lXCI6XCJwdWJsaWNfZ3JvdXBzXCIsXCJhcmdzXCI6XCJcIn0ifQ`
  );
  await delay(delayTime);
  let index = 0;
  while (index < groupNumber) {
    if (oldSeeMoreClass) {
      const hrefs = await page.$$eval(oldScrapGroupClass, (anchors) =>
        anchors.map((el) => el.getAttribute("href"))
      );
      const groupNames = await page.$$eval(oldScrapGroupNameClass, (anchors) =>
        anchors.map((el) => el.textContent)
      );
      console.log(hrefs.length, groupNames.length);

      for (let i = 0; i < hrefs.length; i++) {
        const group = {
          groupName: groupNames[i],
          groupId: hrefs[i],
        };
        myArray.push(group);
      }

      await page.click(oldSeeMoreClass);
      await delay(delayTime);
      index++;
    } else {
      const hrefs = await page.$$eval(oldScrapGroupClass, (anchors) =>
        anchors.map((el) => el.getAttribute("href"))
      );
      const groupNames = await page.$$eval(oldScrapGroupNameClass, (anchors) =>
        anchors.map((el) => el.textContent)
      );
      console.log(hrefs.length, groupNames.length);

      for (let i = 0; i < hrefs.length; i++) {
        const group = {
          groupName: groupNames[i],
          groupId: hrefs[i],
        };
        myArray.push(group);
      }
      break;
    }
  }
  let myIDs = myArray.map((str) => {
    const match = str.groupId.match(regex);

    if (match) {
      return {
        groupName: str.groupName,
        groupId: match[1],
      };
    } else {
      console.log("fbid value not found in the URL.");
    }
  });
  return myIDs;
};

module.exports = session;
