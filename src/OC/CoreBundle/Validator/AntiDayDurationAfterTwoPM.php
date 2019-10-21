<?php
// src/OC/CoreBundle/Validator/AntiDayDurationAfterTwoPM.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiDayDurationAfterTwoPM extends Constraint
{
  
  
  public $message = "afterTwoPM.msg";

  /**
   * @Const int
   */
  const LIMITHOUR = 14;


  public function validatedBy()
  {
    return 'oc_core_AntiDayDurationAfterTwoPM';
  }
}
