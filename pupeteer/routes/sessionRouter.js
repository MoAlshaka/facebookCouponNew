const express = require("express");
const sessionCotroller = require("../controller/sessionController");

const router = express.Router();

router.route("/").post(sessionCotroller.startSession);

// router.route("/").post((req, res) => {
//   console.log(req.body);
//   res.send(req.body);
// });

module.exports = router;
