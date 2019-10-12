<?php
// src/OC/CoreBundle/Validator/AntiBookingAfterClosingTime.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiBookingAfterClosingTime extends Constraint
{
  
  
  public $message = "Vous ne pouvez pas acheter de billet 1h avant l'heure de fermeture.";




  public function validatedBy()
  {
    return 'oc_core_AntiBookingAfterClosingTime';
  }
}
