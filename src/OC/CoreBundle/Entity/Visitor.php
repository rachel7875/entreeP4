<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="visitor")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\VisitorRepository")
 */
class Visitor

{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="visitorName", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $visitorName;

    /**
     * @ORM\Column(name="visitorFirstName", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $visitorFirstName;
   
    /**
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Nationality")
     * @ORM\JoinColumn(nullable=true)
     */
    private $nationality;

    /**
     * @ORM\Column(name="country", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime")
     * @Assert\DateTime()
     */
    private $birthday;


    




    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of visitorName
     */ 
    public function getVisitorName()
    {
        return $this->visitorName;
    }

    /**
     * Set the value of visitorName
     *
     * @return  self
     */ 
    public function setVisitorName($visitorName)
    {
        $this->visitorName = $visitorName;

        return $this;
    }

    /**
     * Get the value of visitorFirstName
     */ 
    public function getVisitorFirstName()
    {
        return $this->visitorFirstName;
    }

    /**
     * Set the value of visitorFirstName
     *
     * @return  self
     */ 
    public function setVisitorFirstName($visitorFirstName)
    {
        $this->visitorFirstName = $visitorFirstName;

        return $this;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Visitor
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set nationality
     *
     * @param \OC\CoreBundle\Entity\Nationality $nationality
     *
     * @return Visitor
     */
    public function setNationality(\OC\CoreBundle\Entity\Nationality $nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return \OC\CoreBundle\Entity\Nationality
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
}
