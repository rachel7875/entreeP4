<?php
// src/OC/CoreBundle/Validator/AntiBookingAfterClosingTimeValidator.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use OC\CoreBundle\Entity\Booking;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class AntiBookingAfterClosingTimeValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
      $request = $this->requestStack->getCurrentRequest();

      $session = $request->getSession();
          

     date_default_timezone_set('Europe/Paris');
     
     $today = date('Y-m-d');
     $value= $value->format('Y-m-d');
    
      if($value==$today){
        $time = (new \DateTime())->format('H:i:s');
        $weekDay=(new \DateTime())->format('N');
     
        if($weekDay==1){$closingHour=\DateTime::createFromFormat('H:i:s', '18:00:00');}
        if($weekDay==3){$closingHour=\DateTime::createFromFormat('H:i:s', '21:45:00');}
        if($weekDay==4){$closingHour=\DateTime::createFromFormat('H:i:s', '18:00:00');}
        if($weekDay==5){$closingHour=\DateTime::createFromFormat('H:i:s', '14:00:00');}
        if($weekDay==6){$closingHour=\DateTime::createFromFormat('H:i:s', '18:00:00');}
      
        
        if ($time > $closingHour->sub(new \DateInterval('PT1H'))->format('H:i:s'))   {
          $this->context->addViolation($constraint->message);
        }

      }
      


        


        
    }
}
