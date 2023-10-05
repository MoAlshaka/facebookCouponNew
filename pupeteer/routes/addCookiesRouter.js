const express = require("express");
const scrapGroupController = require("../controller/addCookiesController");

const router = express.Router();

router.route("/").post(scrapGroupController.startSession);

// router.route("/").post((req, res) => {
//   console.log(req.body);
//   res.send(req.body);
// });

module.exports = router;
