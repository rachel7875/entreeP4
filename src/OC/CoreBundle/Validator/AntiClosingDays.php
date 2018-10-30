<?php
// src/OC/CoreBundle/Validator/AntiClosingDays.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiClosingDays extends Constraint
{
  public $message = "Jour fermé, merci de choisir un jour disponible.";

  public function validatedBy()
  {
    return 'oc_core_AntiClosingDays';
  }

}
