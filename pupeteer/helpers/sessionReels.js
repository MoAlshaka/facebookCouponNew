const { delay, findValueByName } = require("../utilities/utilies");
const {
  reelUploadClass,
  reelNextBtnClass,
  reelNextBtnEditClass,
  reelWriteClass,
  reelPostBtn,
} = require("../config/elementSelectors");
const regex = /\d+/;
let fbidValue;

const session = async (
  page,
  cookies = [{}],
  postMassage = "Posted Via BundyBujet",
  filePath = "",
  delayTime = 4,
  postDelay = 1
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

    const url = await page.url();

    // Navigate to the specific link
    await page.goto(`https://www.facebook.com/reels/create/`);

    if (!url.includes("https://www.facebook.com/checkpoint/")) {
      await page.waitForSelector(reelUploadClass);

      //click iput[type='file'] & wait for file selection
      const [fileChooser] = await Promise.all([
        page.waitForFileChooser(),
        page.click(reelUploadClass),
      ]);
      //select file from assests
      await fileChooser.accept([filePath]);

      await delay(30);
      await page.click(reelNextBtnClass);

      await delay(delayTime);
      await page.click(reelNextBtnEditClass);

      await delay(delayTime);
      await page.click(reelWriteClass);
      await page.type(reelWriteClass, postMassage);

      await delay(delayTime);
      await page.click(reelPostBtn);

      await page.waitForNavigation();

      const currentUrl = await page.url();

      const match = currentUrl.match(regex);

      if (match) {
        fbidValue = match[0];
      } else {
        console.log("fbid value not found in the URL.");
      }

      // Calculate elapsed time in seconds
      const endTime = performance.now();
      // performance debugging
      const elapsedTimeInSeconds = (endTime - startTime) / 1000;
      console.log(`Elapsed time: ${elapsedTimeInSeconds.toFixed(2)} seconds`);
      await delay(postDelay);
    } else {
      throw new Error(`Email might be Banned $${cookies.id}`);
    }
    return fbidValue;
  } catch (error) {
    if (error.message.includes("Banned")) {
      throw new Error(`${error.message}`);
    }
  }
};

module.exports = session;
