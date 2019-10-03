<?php
// src/OC/CoreBundle/DataFixtures/ORM/LoadClosingdays.php

namespace OC\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\CoreBundle\Entity\Closingdays;

class LoadClosingdays implements FixtureInterface
{
  // In the argument of the method load ,  the object $manager is the EntityManager
  public function load(ObjectManager $manager)
    {
      date_default_timezone_set('Europe/Paris');
      $year = intval(date('Y'));
     
      $closingdays = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime($year.'-11-01'));
      $manager->persist($closingdays);

      $closingdays  = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime($year.'-12-25'));
      $manager->persist($closingdays);

      $closingdays = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime($year.'-05-01'));
      $manager->persist($closingdays);

      $closingdays = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime(($year+1).'-11-01'));
      $manager->persist($closingdays);

      $closingdays  = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime(($year+1).'-12-25'));
      $manager->persist($closingdays);

      $closingdays = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime(($year+1).'-05-01'));
      $manager->persist($closingdays);

      $closingdays = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime(($year+2).'-11-01'));
      $manager->persist($closingdays);

      $closingdays  = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime(($year+2).'-12-25'));
      $manager->persist($closingdays);

      $closingdays = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime(($year+2).'-05-01'));
      $manager->persist($closingdays);

      $manager->flush();
  }
}