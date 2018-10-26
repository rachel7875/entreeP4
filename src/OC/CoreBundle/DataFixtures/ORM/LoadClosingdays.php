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
      $closingdays = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime("2018-11-01"));
      $manager->persist($closingdays);

      $closingdays  = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime("2018-12-25"));
      $manager->persist($closingdays);

      $closingdays = new Closingdays();
      $closingdays ->setClosingDay(new \DateTime("2019-05-01"));
      $manager->persist($closingdays);

      $manager->flush();
  }
}