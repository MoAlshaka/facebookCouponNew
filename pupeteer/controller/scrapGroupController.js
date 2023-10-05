const puppeteer = require("puppeteer");
const session = require("../helpers/sessionScrap");
const { fetchCookies } = require("../module/fetchcookies");

exports.startSession = async (req, res) => {
  let browser;
  const searchGroup = req.body.searchGroup;
  const delayTime = req.body.delay;
  const groupNumber = req.body.groupNumber;

  try {
    browser = await puppeteer.launch({ headless: false, devtools: true });
    const page = await browser.newPage();
    await (await browser.pages())[0].close();
    const getCookies = await fetchCookies();

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

    try {
      // Simulate typing the message with the corresponding ID
      // console.log(`Typing message "${groupID}" to ID ${currentCookies.id}`);
      await session(
        page,
        getCookies[1],
        searchGroup,
        groupNumber,
        delayTime
      ).then((result) => {
        console.log("session LOG:", result);
        res.send({ message: result });
      });
      await browser.close();
      // Move to the next ID, and if we reach the end, start from the beginning
    } catch (error) {}

    console.log(
      ` ${fbidValue.length} Post Publish,Numbers of unpublished groups ${
        groupIDs - fbidValue.length
      } | Id Puplished -> ${fbidValue} | Cookie with id ${notWorking} not Working cookies`
    );
    await browser.close();
    // res.send("Session Completed");
  } catch (error) {}
};
