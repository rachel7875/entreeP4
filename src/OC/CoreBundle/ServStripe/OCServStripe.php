<?php
// src/OC/CoreBundle/StripeServ/OCServStripe.php

namespace OC\CoreBundle\ServStripe;

class OCServStripe
{
    public function chargeCreation($request, $totalPrice, $bookingId, $secretStripeKey)
    {
      $session = $request->getSession();
      $stripeErrorMsg=$session->set('stripeErrorMsg', '');

      // Token is created using Checkout 
      $token = $request->request->get('stripeToken');

      //Stripe API key
        \Stripe\Stripe::setApiKey($secretStripeKey);

      // Get the payment token ID submitted by the form:
       
        try {
          $charge = \Stripe\Charge::create([
            'amount' => $totalPrice,
            'currency' => 'eur',
            'description' => 'Billet(s) Musée du Louvre',
            'source' => $token,
            "metadata" => ["bookingId" => $bookingId]
          ]);
       } catch (\Stripe\Error\Card $e) {
          // Card was declined.
          $e_json = $e->getJsonBody();
          $error = $e_json['error'];

          $stripeErrorMsg=$error["message"];
          
          $stripeErrorMsg=$session->set('stripeErrorMsg', $stripeErrorMsg);

         }
        
    }

}
