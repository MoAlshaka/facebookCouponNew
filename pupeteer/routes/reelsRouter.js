const express = require("express");
const reelsController = require("../controller/reelsController");

const router = express.Router();

router.route("/").post(reelsController.startSession);

// router.route("/").post((req, res) => {
//   console.log(req.body);
//   res.send(req.body);
// });

module.exports = router;
