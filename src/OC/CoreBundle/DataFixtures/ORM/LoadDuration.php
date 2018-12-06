<?php
// src/OC/CoreBundle/DataFixtures/ORM/LoadDuration.php

namespace OC\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Duration;
use Gedmo\Translatable\Translatable;

class LoadDuration implements FixtureInterface
{
  // In the argument of the method load ,  the object $manager is the EntityManager
  public function load(ObjectManager $manager)
    {
      //$em = $this->getDoctrine()->getManager();
      $repository = $manager->getRepository('Gedmo\\Translatable\\Entity\\Translation');

      $duration = new Duration();
      $duration->setDurationName('Journée');
      $duration->setDurationValue(1.0);
      $repository->translate($duration, 'durationName', 'en', 'Day');
      $manager->persist($duration);

      $duration = new Duration();
      $duration->setDurationName('Demi-Journée');
      $duration->setDurationValue(0.5);
      $repository->translate($duration, 'durationName', 'en', 'Half-day');
      $manager->persist($duration);

      $manager->flush();
  }
}