<?php
// src/OC/CoreBundle/ServClosingDays/OCServClosingDays.php

namespace OC\CoreBundle\ServClosingDays;

use Doctrine\ORM\EntityManagerInterface;

class OCServClosingDays
{
  private $em;
  

  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  public function isClosingDay($value)
  {
    // A closing day must be in the table of the table closingdays 
    $test = $this->em
    ->getRepository('OCCoreBundle:Closingdays')
    ->testVisitDay($value) 
    ;

    $day = date_format($value, 'N');
    
    if (!empty($test) OR ($day==2) OR ($day==7)){
      return true;
    } else {
      return false;
    }
      
  }

}
