<?php
// src/OC/CoreBundle/ServEmail/OCServEmail.php

namespace OC\CoreBundle\ServEmail;

use OC\CoreBundle\Entity\Booking;
use SendGrid;
use Swift_Mailer;
use Swift_Message;
use Wilczynski\Mailer\SendGridTransport;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

 
class OCServEmail 
{
  private $templating;
  private $translator;

  public function __construct(EngineInterface $templating,TranslatorInterface $translator )
  {
      $this->templating = $templating;
      $this->translator = $translator ;
  }

  public function sendNewConfirmationEmail(Booking $booking, $sendgridKey, $locale, $ticketsNb)
  {
    //Collection of the adequate template 
    if ($locale =="en") 
    { $template='OCCoreBundle:Booking:email_En.html.twig';
    } else 
    {$template='OCCoreBundle:Booking:email_Fr.html.twig';
    }

    // Create the Transport
    $transport = SendGridTransport::create($sendgridKey);
    // Create the Mailer using SendGrid Transport
    $mailer = new Swift_Mailer($transport); 

    //Collection of the tickets
    $tickets = $booking->getTickets();


    // Create a Swift Message
    $message = (new Swift_Message())
        ->setSubject($this->translator->transChoice('email.subject', $ticketsNb))
        ->setFrom(['rachelmabire778@gmail.com' =>  $this->translator->trans('email.sender')])
        ->setTo($to = $booking->getEmail() )
        ->setContentType('text/html')
        ->setBody(
          $this->templating -> render($template,
            array(
              'booking'=>$booking, 
              'tickets' => $tickets,
              'ticketsNb' => $ticketsNb,)
            )
        );

    // Send the message
    $result = $mailer->send($message);

  }

}

