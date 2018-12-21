<?php
// src/OC/CoreBundle/Validator/AntiMaxTicketsNb.php

namespace OC\CoreBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AntiMaxTicketsNb extends Constraint
{
  public $message = "Le nombre maximal de billets a été atteint pour le jour choisi. Merci de sélectionner un autre jour. ";

  public function validatedBy()
  {
    return 'oc_core_AntiMaxTicketsNb';
  }

}
