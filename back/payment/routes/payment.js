// This is your test secret API key.
const stripe = require("stripe")(
  "sk_test_51L5sDXHrcd5OygkvTDqSqb2o841hw59IckZBD8WPOA4iCK9yxQoWihb6IpI1A0HWi5eVTI9FA7JnmiN6S4ztJRR300BHQAvEMu"
);

var express = require("express");
var router = express.Router();

router.post("/create-checkout-session", async (req, res) => {
  // req.body = {
  //   success_url: "http://test",
  //   cancel_url: "http://test",
  //   line_items: [
  //     {
  //       price_data: {
  //         currency: "EUR",
  //         product_data: {
  //           name: "name",
  //         },
  //         unit_amount_decimal: 100, //1€
  //       },
  //       quantity: 1,
  //     },
  //   ],
  // };
  console.log(req.body);
  console.log(req.body.line_items);

  const { line_items, success_url, cancel_url } = req.body;

  const session = await stripe.checkout.sessions.create({
    line_items,
    mode: "payment",
    success_url,
    cancel_url,
  });
  // console.log(session);

  res.json(session.url);
});

module.exports = router;
