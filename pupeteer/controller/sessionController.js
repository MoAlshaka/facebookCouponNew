const path = require("path");
const puppeteer = require("puppeteer");
const session = require("../helpers/session");
const { fetchCookies } = require("../module/fetchcookies");
const relativeFilePath = "../public/image1.jpg";
const absoluteFilePath = path.join(__dirname, relativeFilePath);

exports.startSession = async (req, res) => {
  let browser;
  try {
    browser = await puppeteer.launch({ headless: false });
    const page = await browser.newPage();
    await (await browser.pages())[0].close();
    const getCookies = await fetchCookies();
    const postMsgs = req.body.messages;
    const delay = req.body.delay;
    const groupIDs = req.body.ids;
    const postDelay = req.body.postDelay;

    console.log("cookies in DB", getCookies.length);

    //turn off css,font,image request
    await page.setRequestInterception(true);
    page.on("request", (request) => {
      if (
        ["image", "stylesheet", "font"].indexOf(request.resourceType()) !== -1
      ) {
        request.abort();
      } else {
        request.continue();
      }
    });
    // session start
    let currentIndex = 0;
    let posted = [];
    let fbidValue = [];
    //session cookies needed to post for number of group ids
    let notWorking;

    for (let i = 0; i < groupIDs.length; i++) {
      const groupID = groupIDs[i];
      const currentCookies = getCookies[currentIndex];

      try {
        // Simulate typing the message with the corresponding ID
        // console.log(`Typing message "${groupID}" to ID ${currentCookies.id}`);
        await session(
          page,
          currentCookies,
          groupID,
          postMsgs,
          absoluteFilePath,
          delay,
          postDelay
        ).then((result) => {
          posted.push(currentCookies.id);
          fbidValue.push(result);
        });
        // Move to the next ID, and if we reach the end, start from the beginning
      } catch (error) {
        console.log(`COOKIES-SESSION => ${error.message}`);
        notWorking = error.message.split("$")[1];
      }
      currentIndex = (currentIndex + 1) % getCookies.length;
    }
    await res.send({
      messages: ` ${
        fbidValue.length
      } Post Publish,Numbers of unpublished groups ${
        groupIDs - fbidValue.length
      } | Id Puplished -> ${fbidValue} | Cookie with id ${notWorking} not Working cookies`,
    });
    console.log(
      ` ${fbidValue.length} Post Publish,Numbers of unpublished groups ${
        groupIDs - fbidValue.length
      } | Id Puplished -> ${fbidValue} | Cookie with id ${notWorking} not Working cookies`
    );
    await browser.close();
    // res.send("Session Completed");
  } catch (error) {
    // if (browser) {
    console.log("type", typeof error);
    console.log(`ERROR=> ${error.message}`);

    // }
  }
};
