<?php
// src/OC/CoreBundle/ServEmail/OCServEmail.php

namespace OC\CoreBundle\ServEmail;

use OC\CoreBundle\Entity\Booking;
use SendGrid;
use Swift_Mailer;
use Swift_Message;
use Wilczynski\Mailer\SendGridTransport;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

 
class OCServEmail 
{
  private $templating;

  public function __construct(EngineInterface $templating)
  {
      $this->templating = $templating;
  }

  public function sendNewConfirmationEmail(Booking $booking, $sendgridKey)
  {
    // Create the Transport
    $transport = SendGridTransport::create($sendgridKey);
    // Create the Mailer using SendGrid Transport
    $mailer = new Swift_Mailer($transport); 

    //Collection of the tickets
    $tickets = $booking->getTickets();


    // Create a Swift Message
    $message = (new Swift_Message())
        ->setSubject('Confirmation & Billet(s) pour le Musée du Louvre')
        ->setFrom(['rachelmabire778@gmail.com' => 'Billetterie du Musée du Louvre'])
        ->setTo($to = $booking->getEmail() )
        ->setContentType('text/html')
        ->setBody(
          $this->templating -> render(
            'OCCoreBundle:Booking:email.html.twig',
            array(
              'booking'=>$booking, 
              'tickets' => $tickets,)
            )
        );

    // Send the message
    $result = $mailer->send($message);

  }
}

