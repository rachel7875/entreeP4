<?php
// src/OC/CoreBundle/Validator/AntiMaxTicketsNbValidator.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AntiMaxTicketsNbValidator extends ConstraintValidator
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
        if ($request->isMethod('POST'))  {

          $session = $request->getSession();
          
          //Collection of the desired visitDay 
          if (isset($request->request->get('oc_corebundle_booking')['visitDay'])) {
            $testVisitDay=$request->request->get('oc_corebundle_booking')['visitDay'];
          } 
          else {
            $testVisitDay=$session->get('sessionVisitDay');
          }
         
          
          //Collection of the number of sold tickets for the desired visitDay 
          $TicketsNbforaDay = $this->em
          ->getRepository('OCCoreBundle:Ticket')
          ->getTicketsNbforaDay($testVisitDay) 
          ;

          
          //Addition of the desired number of tickets to the number of sold tickets for the desired visitDay & Test of the max limit
          $totalTicketsforaDay=$TicketsNbforaDay +$value;

          //Test & addition of a violation
          if ($totalTicketsforaDay > 12)  {
            $this->context->addViolation($constraint->message);
          } 

          
      }  
    }
}
