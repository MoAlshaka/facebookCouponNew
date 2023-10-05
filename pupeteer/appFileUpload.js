const express = require("express");
const multer = require("multer");
const cors = require("cors");
const path = require("path");

const app = express();
const port = 3000;

app.use(express.json());
app.use(cors());
app.use(express.static("public"));

// store the files in local storage usin disk storage engin
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, "./public");
  },
  filename: function (req, file, cb) {
    cb(null, file.originalname);
  },
});

const upload = multer({ storage: storage });

// const upload = multer({ dest: "./public" });
app.post("/upload", upload.single("image"), function (req, res) {
  // req.file is the name of your file in the form above, here 'uploaded_file'
  // req.body will hold the text fields, if there were any
  console.log(req.file, req.body);
  res.send("Send");
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
