var express = require("express");
var cookieParser = require("cookie-parser");
var cors = require("cors");

var indexRouter = require("./routes/index");
var paymentRouter = require("./routes/payment");

var app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(cors());

app.use("/", indexRouter);
app.use("/", paymentRouter);

module.exports = app;
