<?php
// src/OC/CoreBundle/Validator/AntiClosingDaysValidator.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use OC\CoreBundle\ServClosingDays\OCServClosingDays;
use Doctrine\ORM\EntityManagerInterface;

class AntiClosingDaysValidator extends ConstraintValidator
{
    private $em;
    private $servClosingDays ;

    public function __construct(EntityManagerInterface $em, OCServClosingDays $servClosingDays)
    {
      $this->em = $em;
      $this->servClosingDays= $servClosingDays;
    }
  
    public function validate($value, Constraint $constraint)
    {
      
      $ClosingDayAnswer = $this->servClosingDays->isClosingDay($value);
        if ($ClosingDayAnswer==true) {
          $this->context->addViolation($constraint->message);
        }
    }
}
