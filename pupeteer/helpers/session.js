const { delay } = require("../utilities/utilies");
const {
  oldPicArClass,
  oldUploadImgArClass,
  oldCheckImgArClass,
  oldTextareaArClass,
  oldPostBtnArClass,
  oldPostLinkID,
} = require("../config/elementSelectors");
const regex = /(\d+)(?=\/\?)/;
let fbidValue;

const session = async (
  page,
  cookies = [{}],
  groupId = "",
  postMassage = "Posted Via BundyBujet",
  filePath = "",
  delayTime = 4,
  postDelay= 1
) => {
  try {
    //perfomramce depugger
    const startTime = performance.now();
    // Delete all cookies
    await page.deleteCookie();
    // await page.reload();
    await page.setCookie(...cookies.value);
    await page.reload();
    await delay(delayTime);

    // Navigate to the specific link
    await page.goto(`https://mbasic.facebook.com/groups/${groupId}`);
    await delay(delayTime);

    await page.click(oldPicArClass);
    await delay(delayTime);
    //click iput[type='file'] & wait for file selection
    const [fileChooser] = await Promise.all([
      page.waitForFileChooser(),
      page.click(oldUploadImgArClass),
    ]);
    //select file from assests
    await fileChooser.accept([filePath]);

    await delay(delayTime);
    //wait for page load then click
    await Promise.all([
      page.waitForNavigation(), // The promise resolves after navigation has finished 
      page.click(oldCheckImgArClass),
    ]);
    await delay(delayTime);

    // Fill out a form (replace with actual selectors and data)
    await page.type(oldTextareaArClass, postMassage);
    await delay(delayTime);

    await page.click(oldPostBtnArClass);
    await delay(delayTime)

    //go to groupe
    await page.goto(`https://mbasic.facebook.com/allactivity/?category_key=groupposts`);
    await delay(delayTime);

    //get the post ID
    await page.click(oldPostLinkID);
    await delay(delayTime);

    const currentUrl = await page.url();
    const match = currentUrl.match(regex);

    if (match) {
      fbidValue = match[1];
    } else {
      console.log("fbid value not found in the URL.");
    }
    // Calculate elapsed time in seconds
    const endTime = performance.now();
    // performance debugging
    const elapsedTimeInSeconds = (endTime - startTime) / 1000;
    console.log(`Elapsed time: ${elapsedTimeInSeconds.toFixed(2)} seconds`);

    await delay(postDelay*60)

    return fbidValue;
  } catch (error) {
    if (error.message.includes(oldPicArClass)) {
      throw new Error(
        `HTML Selector Error => check GROUP ID or Cookies formate id $${cookies.id}`
      );
    }
    if (error.message.includes(oldCheckImgArClass)) {
      throw new Error(`HTML Selector Error => check FILE SIZE,TYPE`);
    }
    if (error.message.includes(".setCookies")) {
      throw new Error(
        `COOKIE ERROR => Check your Cookies formate id $${cookies.id}`
      );
    } else {
      throw new Error(`SESSION => ${error.message}`);
    }
  }
};

module.exports = session;
