<?php
// src/OC/CoreBundle/DataFixtures/ORM/LoadDuration.php

namespace OC\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Duration;

class LoadDuration implements FixtureInterface
{
  // In the argument of the method load ,  the object $manager is the EntityManager
  public function load(ObjectManager $manager)
    {
      $duration = new Duration();
      $duration->setDurationName('Journée');
      $duration->setDurationValue(1.0);
      $manager->persist($duration);

      $duration = new Duration();
      $duration->setDurationName('Demi-Journée');
      $duration->setDurationValue(0.5);
      $manager->persist($duration);

      $manager->flush();
  }
}