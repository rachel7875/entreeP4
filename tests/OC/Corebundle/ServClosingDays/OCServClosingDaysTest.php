<?php
// src/OC/CoreBundle/ServClosingDays/OCServClosingDays.php

namespace Tests\OC\CoreBundle\ServClosingDays;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use OC\CoreBundle\ServClosingDays\OCServClosingDays;

class OCServClosingDaysTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp():void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testIsChristmas()
    {  
        $servClosingDays = new OCServClosingDays($this->entityManager);
        $result=$servClosingDays ->isClosingDay(new \DateTime('2020-12-25'));
       
        $this->assertEquals(true, $result);
    }

    public function testIsClosingDayTuesday()
    {  
        $servClosingDays = new OCServClosingDays($this->entityManager);
        $result=$servClosingDays ->isClosingDay(new \DateTime('2019-10-22'));
       
        $this->assertEquals(true, $result);
    }

    public function testIsClosingDaySunday()
    {
       
        $servClosingDays = new OCServClosingDays($this->entityManager);
        $result=$servClosingDays ->isClosingDay(new \DateTime('2019-10-27'));
       
        $this->assertEquals(true, $result);
    }

    public function testIsNotClosingDayOther()
    {
       
        $servClosingDays = new OCServClosingDays($this->entityManager);
        $result=$servClosingDays ->isClosingDay(new \DateTime('2019-12-23'));
       
        $this->assertEquals(false, $result);
    }


}