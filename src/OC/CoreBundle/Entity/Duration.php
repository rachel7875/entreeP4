<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;



/**
 * @ORM\Table(name="duration")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\DurationRepository")
 */
class Duration implements Translatable

{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Gedmo\Translatable
     * @ORM\Column(name="durationName", type="string", length=255)
     */
    private $durationName;

    /**
     * @ORM\Column(name="durationValue", type="float")
     */
    private $durationValue;

   /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     * and it is not necessary because globally locale can be set in listener
     */
    private $locale;

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

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

}