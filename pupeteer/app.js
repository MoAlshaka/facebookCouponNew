const express = require("express");
const sessionRouter = require("./routes/sessionRouter");
const groupScrapRouter = require("./routes/groupScrapRouter");
const addCookiesRouter = require("./routes/addCookiesRouter");
const reelsRouter = require("./routes/reelsRouter");

const cors = require("cors"); // Import the cors package
const app = express();
const PORT = 3000;

// Enable CORS for all routes
app.use(cors());
// middleware to add req.body obj  to the req obj
app.use(express.json());
// routes handler
app.use("/api/v1/reels", reelsRouter);
app.use("/api/v1/session", sessionRouter);
app.use("/api/v1/groupscrap", groupScrapRouter);
app.use("/api/v1/addcookies", addCookiesRouter);

app.listen(PORT, () => {
  console.log(`App runing on post${PORT}`);
});
