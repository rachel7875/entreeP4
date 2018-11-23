<?php
// src/OC/CoreBundle/Controller/BookingController.php

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Booking;
use OC\CoreBundle\Entity\Ticket;
use OC\CoreBundle\Form\BookingType;
use OC\CoreBundle\Form\BookingBisType;
use OC\CoreBundle\Form\BookingThirdStepType;
use OC\CoreBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OC\CoreBundle\ServStripe;
//use OC\CoreBundle\ServEmail;
use SendGrid;
use Swift_Mailer;
use Swift_Message;
use Wilczynski\Mailer\SendGridTransport;

class BookingController extends Controller
{


  public function addAction(Request $request)
  {
    $booking = new Booking();
    $form   = $this->get('form.factory')->create(BookingType::class, $booking);
 

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($booking);
        $em->flush();
  
        $id=$booking->getId();

        $session = $request->getSession();
        $bookingId=$session->set('bookingId', $id);


    return $this->redirectToRoute('oc_core_visitors');
    }

    return $this->render('OCCoreBundle:Booking:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }  


  public function visitorsAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    //Collection of the booking & the tickets number 
    $session = $request->getSession();
    $bookingId=$session->get('bookingId');
    $booking=$em->getRepository('OCCoreBundle:Booking')->find($bookingId);

    $visitorsNumber= $booking->getTicketsNumber();


    
    //Creation of the $visitorsNumber tickets 
    for($i=1; $i<=$visitorsNumber; $i++)
    {
      $ticket= new Ticket(); 
      $booking->addTicket($ticket);
    }
    
    $tickets = $booking->getTickets();

     //Creation of the general form
     $form = $this->createForm(BookingBisType::class, $booking);

     //Management of the data
      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
      {

        foreach ($tickets as $ticket)
        {
        
          $duration= $booking->getDuration();
          $durationValue= $duration->getDurationValue();

          $reducedRate= $ticket->getReducedRate();

          if(!empty($reducedRate)){
            $rate=$em->getRepository('OCCoreBundle:Rate')->findOneBy(array('rateName' => 'réduit'));
          }
          else 
          {

            $visitor=$ticket->getVisitor();

            $birthday=$visitor->getBirthday();

            $visitDay=$booking->getVisitDay();
            $age=$visitDay->diff($birthday)->format('%y');

            if($age< 4) {
              $rate=$em->getRepository('OCCoreBundle:Rate')->findOneBy(array('rateName' => 'gratuit'));
            }
            elseif($age< 12){
              $rate=$em->getRepository('OCCoreBundle:Rate')->findOneBy(array('rateName' => 'enfant'));
            }
            elseif($age< 60){
              $rate=$em->getRepository('OCCoreBundle:Rate')->findOneBy(array('rateName' => 'normal'));
            }
            elseif($age>= 60){
              $rate=$em->getRepository('OCCoreBundle:Rate')->findOneBy(array('rateName' => 'senior'));
            }

          }

          $ticket->setRate($rate);
          $rateValue=$rate->getRateValue();
          $price=$rateValue*$durationValue;
          $ticket->setPrice($price);

        }
        $em->persist($booking);
        $em->flush();
       return $this->redirectToRoute('oc_core_recap'); 
    }

    return $this->render('OCCoreBundle:Booking:visitors.html.twig', array(
      'form' => $form->createView(),
      'visitorsNumber' => $visitorsNumber,
    ));

  }


  public function recapAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    //Collection of the booking, the tickets & the durationName
    $session = $request->getSession();
    $bookingId=$session->get('bookingId');
    $booking=$em->getRepository('OCCoreBundle:Booking')->find($bookingId);
    $tickets = $booking->getTickets();

    $duration= $booking->getDuration();
    $durationName= $duration->getDurationName();

    
    //Creation of the general form
    $form = $this->createForm(BookingThirdStepType::class);

    //Management after the validation by the internet user
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
    {
     return $this->redirectToRoute('oc_core_payment'); 
    }

    //View
    return $this->render('OCCoreBundle:Booking:recap.html.twig', array(
      'form' => $form->createView(),
      'booking' => $booking,
      'durationName' => $durationName,
      'tickets' => $tickets,
    ));
  }
  
  public function paymentAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    //Collection of the booking
    $session = $request->getSession();
    $bookingId=$session->get('bookingId');
    $booking=$em->getRepository('OCCoreBundle:Booking')->find($bookingId);


    //Obtaining total cost
    $tickets = $booking->getTickets();
    $somme = 0;
    foreach ($tickets as $ticket)
    {
      $price=$ticket->getPrice();
      $somme += $price;
    }
    $totalPrice =$somme *100;
    $email = $booking->getEmail();

    if ($request->isMethod('POST')) {
      // Creating a charge to complete the payment
        //Obtaining the service ServStripe 
        $servStripe = $this->container->get('oc_core.servstripe');

        //Implementation of the service ServStripe 
          // Set your secret key: remember to change this to your live secret key in production
          $secretStripeKey=$this->container->getParameter('stripe_secretKey');
          $servStripe->chargeCreation($request, $totalPrice, $bookingId, $secretStripeKey);
        
        //In case of error for the payment
        $stripeErrorMsg=$session->get('stripeErrorMsg');
          if (!empty($stripeErrorMsg)) {
            $session->getFlashBag()->add('info', $stripeErrorMsg);
          } 
          //In case of no error for the payment
          else {
            // Creating a unique reference and recording of data
            $bookingCode=uniqid();
            $booking->setBookingCode($bookingCode);
            $em->persist($booking);
            $em->flush();


            
            // Redirection  
            return $this->redirectToRoute('oc_core_confirmation'); 
          }
      

    }

      //View
      $publicStripeKey=$this->container->getParameter('stripe_publicKey');

      return $this->render('OCCoreBundle:Booking:payment.html.twig', array(
        'booking' => $booking,
        'totalPrice' => $totalPrice,
        'publicStripeKey' => $publicStripeKey,
      ));
 
  }

  public function confirmationAction(Request $request)
  {
    
    $em = $this->getDoctrine()->getManager();

    //Collection of the booking and the tickets
    $session = $request->getSession();
    $bookingId=$session->get('bookingId');
    $booking=$em->getRepository('OCCoreBundle:Booking')->find($bookingId);
    $tickets = $booking->getTickets();

    
    //Sending a confirmation email with the tickets
   // $mailer = $this->container->get('mailer')
    //$emailServ = $this->container->get('oc_core.servemail');
    $sendgridKey=$this->container->getParameter('sendgrid_Key');
  //  $emailServ -> sendNewConfirmationEmail($booking, $sendgridKey);
   // $message = (new \Swift_Message('Confirmation & Billet(s) pour le Musée du Louvre'))
     // ->setTo($booking->getEmail()) 
      //->setFrom('rachelmabire778@gmail.com')
      //->setBody(
     //   $this->renderView(
      //    'OCCoreBundle:Booking:email.html.twig',
    //      array('booking'=>$booking)
    //    ),
     //   'text/html'
   // );

    //$this->get('mailer')->send($message)

    // Create the Transport
    $transport = SendGridTransport::create($sendgridKey);
    // Create the Mailer using SendGrid Transport
    $mailer = new Swift_Mailer($transport);
    // Create a Swift Message
    $message = (new Swift_Message())
        ->setSubject('Confirmation & Billet(s) pour le Musée du Louvre')
        ->setFrom(['rachelmabire778@gmail.com' => 'Billetterie du Musée du Louvre'])
        ->setTo($to = $booking->getEmail() )
        ->setContentType('text/html')
        ->setBody(
          $this->renderView(
            'OCCoreBundle:Booking:email.html.twig',
            array(
              'booking'=>$booking, 
              'tickets' => $tickets,)
            )
        );
    // Send the message
    $result = $mailer->send($message);
    

    //View
    return $this->render('OCCoreBundle:Booking:confirmation.html.twig', array(
        'booking' => $booking,
    ));
    //  return new Response("<body>Je suis une page de test, je n'ai rien à dire</body>");
  }

}