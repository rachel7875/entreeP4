<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="duration")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\DurationRepository")
 */
class duration 

{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="durationName", type="string", length=255)
     */
    private $durationName;

    /**
     * @ORM\Column(name="durationValue", type="decimal")
     */
    private $durationValue;


    public function getId()
    {
        return $this->id;
    }

    public function setDurationName($durationName)
    {
        $this->durationName = $durationName;

        return $this;
    }

    public function getDurationName()
    {
        return $this->durationName;
    }

    public function setDurationValue($durationValue)
    {
        $this->durationValue = $durationValue;

        return $this;
    }

    public function getDurationValue()
    {
        return $this->durationValue;
    }


}