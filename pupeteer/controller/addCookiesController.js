const puppeteer = require("puppeteer");
const session = require("../helpers/sessionAddCookies");
const { sendCookies } = require("../module/addCookies");

exports.startSession = async (req, res) => {
  let browser;

  try {
    browser = await puppeteer.launch({ headless: false, devtools: true });
    const page = await browser.newPage();
    await (await browser.pages())[0].close();
    const formEmails = req.body.emails;
    const delayTime = req.body.delay;
    console.log("controler", formEmails);

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

    for (let i = 0; i < formEmails.length; i++) {
      try {
        await session(page, formEmails[i], delayTime);
      } catch (error) {
        console.log(error);
      }
    }
    // await browser.close();

    console.log(
      ` ${fbidValue.length} Post Publish,Numbers of unpublished groups ${
        groupIDs - fbidValue.length
      } | Id Puplished -> ${fbidValue} | Cookie with id ${notWorking} not Working cookies`
    );
    await browser.close();
    // res.send("Session Completed");
  } catch (error) {}
};
