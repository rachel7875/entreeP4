<?php
// src/OC/CoreBundle/DataFixtures/ORM/LoadRate.php

namespace OC\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Rate;

class LoadRate implements FixtureInterface
{
  // In the argument of the method load ,  the object $manager is the EntityManager
  public function load(ObjectManager $manager)
    {
      $rate = new Rate();
      $rate->setRateName('gratuit');
      $rate->setRateValue(0);
      $manager->persist($rate);

      $rate = new Rate();
      $rate->setRateName('enfant');
      $rate->setRateValue(8);
      $manager->persist($rate);

      $rate = new Rate();
      $rate->setRateName('normal');
      $rate->setRateValue(16);
      $manager->persist($rate);

      $rate = new Rate();
      $rate->setRateName('senior');
      $rate->setRateValue(12);
      $manager->persist($rate);

      $rate = new Rate();
      $rate->setRateName('réduit');
      $rate->setRateValue(10);
      $manager->persist($rate);

      $manager->flush();
  }
}

