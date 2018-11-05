<?php
// src/OC/CoreBundle/Controller/BookingController.php

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Booking;
use OC\CoreBundle\Entity\Ticket;
use OC\CoreBundle\Form\BookingType;
use OC\CoreBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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


      $request->getSession()->getFlashBag()->add('notice', 'etape 1 ok.');

    return $this->redirectToRoute('oc_core_visitors');
    }

    return $this->render('OCCoreBundle:Booking:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }  


  public function visitorsAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    //Collection of the tickets number 
    $session = $request->getSession();
    $bookingId=$session->get('bookingId');
    $booking=$em->getRepository('OCCoreBundle:Booking')->find($bookingId);

    $visitorsNumber= $booking->getTicketsNumber();

    //Form for a ticket
    $ticket= new Ticket();
    $form   = $this->get('form.factory')->create(TicketType::class, $ticket);

    //Data processing
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
    {
      $ticket->setBooking($booking);

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

      $em->persist($ticket);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'etape 2 ok.');

      // return $this->redirectToRoute('oc_core_visitors');
      return new Response("<body>Je suis une page de test, je n'ai rien à dire</body>");
    }

    return $this->render('OCCoreBundle:Booking:visitors.html.twig', array(
      'form' => $form->createView(),
    ));

  }
}