<?php
// src/OC/CoreBundle/Validator/AntiDayDurationAfterTwoPM.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiDayDurationAfterTwoPM extends Constraint
{
  
  
  public $message = "Vous ne pouvez pas acheter de billet journée après 14h.";

  /**
   * @Const int
   */
  const LIMITHOUR = 14;


  public function validatedBy()
  {
    return 'oc_core_AntiDayDurationAfterTwoPM';
  }
}
