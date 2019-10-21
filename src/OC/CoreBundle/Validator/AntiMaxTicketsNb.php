<?php
// src/OC/CoreBundle/Validator/AntiMaxTicketsNb.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiMaxTicketsNb extends Constraint
{
  public $message = "maxTicketsNb.msg"; 

  public function validatedBy()
  {
    return 'oc_core_AntiMaxTicketsNb';
  }

}
