<?php
// src/OC/CoreBundle/Validator/AntiBookingAfterClosingTime.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiBookingAfterClosingTime extends Constraint
{
  
  
  public $message = "afterClosingTime.msg"; 




  public function validatedBy()
  {
    return 'oc_core_AntiBookingAfterClosingTime';
  }
}
