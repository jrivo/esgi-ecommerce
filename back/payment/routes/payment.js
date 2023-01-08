// This is your test secret API key.
const stripe = require("stripe")(process.env.STRIPE_API_KEY);

// Find your endpoint's secret in your Dashboard's webhook settings
// const endpointSecret = process.env.STRIPE_WEBHOOK_KEY;
const endpointSecret =
  "whsec_d7f84cc65321414ce7acf251c9da17b19315e8c92754835826b34c0c8efffdea";

var express = require("express");
var router = express.Router();
const bodyParser = require("body-parser");

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

router.post(
  "/webhook",
  bodyParser.raw({ type: "application/json" }),
  (request, response) => {
    const payload = request.body;

    console.log("Got payload: " + payload);
    console.log({ payload });

    const sig = request.headers["stripe-signature"];

    let event;

    try {
      event = stripe.webhooks.constructEvent(request.body, sig, endpointSecret);
    } catch (err) {
      response.status(400).send(`Webhook Error: ${err.message}`);
      return;
    }
    console.log({ event });

    // Handle the event
    switch (event.type) {
      case "checkout.session.completed":
        const session = event.data.object;
        console.log({ session });
        // Then define and call a function to handle the event checkout.session.completed
        break;
      // ... handle other event types
      default:
        console.log(`Unhandled event type ${event.type}`);
    }

    response.status(200);
  }
);

module.exports = router;
