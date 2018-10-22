<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Closingdays
 *
 * @ORM\Table(name="closingdays")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\ClosingdaysRepository")
 */
class Closingdays
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closingDay", type="date", unique=true)
     */
    private $closingDay;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set closingDay
     *
     * @param \DateTime $closingDay
     *
     * @return Closingdays
     */
    public function setClosingDay($closingDay)
    {
        $this->closingDay = $closingDay;

        return $this;
    }

    /**
     * Get closingDay
     *
     * @return \DateTime
     */
    public function getClosingDay()
    {
        return $this->closingDay;
    }
}

