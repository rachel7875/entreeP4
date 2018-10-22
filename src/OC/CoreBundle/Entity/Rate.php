<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\RateRepository")
 */
class Rate 

{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="rateName", type="string", length=255)
     */
    private $rateName;

    /**
     * @ORM\Column(name="rateValue", type="decimal")
     */
    private $rateValue;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rateName
     *
     * @param string $rateName
     *
     * @return Rate
     */
    public function setRateName($rateName)
    {
        $this->rateName = $rateName;

        return $this;
    }

    /**
     * Get rateName
     *
     * @return string
     */
    public function getRateName()
    {
        return $this->rateName;
    }

    /**
     * Set rateValue
     *
     * @param string $rateValue
     *
     * @return Rate
     */
    public function setRateValue($rateValue)
    {
        $this->rateValue = $rateValue;

        return $this;
    }

    /**
     * Get rateValue
     *
     * @return string
     */
    public function getRateValue()
    {
        return $this->rateValue;
    }
}
