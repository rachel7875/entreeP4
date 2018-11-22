<?php
// src/OC/CoreBundle/ServEmail/OCServEmail.php

namespace OC\CoreBundle\ServEmail;

use OC\CoreBundle\Entity\Booking;
 
class OCServEmail
{
  /**
   * @var \Swift_Mailer
   */
  private $mailer;

  public function __construct(\Swift_Mailer $mailer)
  {
    $this->mailer = $mailer;
  }

  public function sendNewConfirmationEmail(Booking $booking, $sendgridKey)
  {
    $message = (new \Swift_Message(
      'Confirmation & Billet(s) pour le Musée du Louvre'));

    $message
      ->setTo($booking->getEmail()) 
      ->setFrom('rachelmabire778@gmail.com')
    ;

    return $this->mailer->send($message);
  }
}

