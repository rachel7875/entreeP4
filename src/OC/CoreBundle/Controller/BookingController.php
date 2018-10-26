<?php
// src/OC/CoreBundle/Controller/BookingController.php

namespace OC\CoreBundle\Controller;

use OC\CoreBundle\Entity\Booking;
use OC\CoreBundle\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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
  

      $request->getSession()->getFlashBag()->add('notice', 'etape 1 ok.');
    }




    return $this->render('OCCoreBundle:Booking:add.html.twig', array(
    'form' => $form->createView(),
    ));
  }  
}  

