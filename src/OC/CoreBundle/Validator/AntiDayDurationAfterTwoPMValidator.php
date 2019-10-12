<?php
// src/OC/CoreBundle/Validator/AntiDayDurationAfterTwoPMValidator.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use OC\CoreBundle\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AntiDayDurationAfterTwoPMValidator extends ConstraintValidator
{

  private $em;
  protected $requestStack;


    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
      $this->requestStack = $requestStack;
      $this->em           = $em;
    }

    public function validate($value, Constraint $constraint)
    {
      $request = $this->requestStack->getCurrentRequest();

      $session = $request->getSession();
        
      //Collection of the desired visitDay 
      if (isset($request->request->get('oc_corebundle_booking')['visitDay'])) {
        $visitDay=$request->request->get('oc_corebundle_booking')['visitDay'];
      } 
      else {
        $visitDay=$session->get('sessionVisitDay');
      }
       
      date_default_timezone_set('Europe/Paris');
     
      $today = date('Y-m-d');
      if($visitDay==$today){
        $time = date('H');
         
        $durationName=$value->getDurationName();
        
   
        if($time >= $constraint::LIMITHOUR && ($durationName=='Journée' || $durationName=='Day') ) {
          $this->context->addViolation($constraint->message);
        }

      }
      


        


        
    }
}
