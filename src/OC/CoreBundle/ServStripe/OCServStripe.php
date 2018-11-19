<?php
// src/OC/CoreBundle/StripeServ/OCServStripe.php

namespace OC\CoreBundle\ServStripe;

class OCServStripe
{
    public function chargeCreation($request, $totalPrice, $bookingId, $secretStripeKey)
    {
      // Token is created using Checkout 
      $token = $request->request->get('stripeToken');

      //Stripe API key
        \Stripe\Stripe::setApiKey($secretStripeKey);

      // Get the payment token ID submitted by the form:
        $charge = \Stripe\Charge::create([
          'amount' => $totalPrice,
          'currency' => 'eur',
          'description' => 'Billet(s) Musée du Louvre',
          'source' => $token,
          "metadata" => ["bookingId" => $bookingId]
      ]);
    }

}
