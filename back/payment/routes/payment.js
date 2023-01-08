// This is your test secret API key.
const stripe = require("stripe")(process.env.STRIPE_API_KEY);

var express = require("express");
var router = express.Router();

router.post("/create-checkout-session", async (req, res) => {
  const { line_items, success_url, cancel_url } = req.body;

  try {
    const session = await stripe.checkout.sessions.create({
      line_items,
      mode: "payment",
      success_url,
      cancel_url,
    });
    res.json(session.url);
  } catch (error) {
    res.json(console.error());
  }
});

module.exports = router;
