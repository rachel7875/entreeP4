<?php
// src/OC/CoreBundle/Validator/AntiClosingDaysValidator.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;


class AntiClosingDaysValidator extends ConstraintValidator
{
    private $em;


    public function __construct(EntityManagerInterface $em)
    {
      $this->em = $em;
    }
  
    public function validate($value, Constraint $constraint)
    {
        // A closing day must be in the table of the table closingdays 
        $test = $this->em
        ->getRepository('OCCoreBundle:Closingdays')
        ->testVisitDay($value) 
        ;

        $day = date_format($value, 'N');
        
        if (!empty($test) OR ($day==2) OR ($day==7)) {
          $this->context->addViolation($constraint->message);
        }
    }
}
