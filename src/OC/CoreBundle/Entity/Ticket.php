<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\TicketRepository")
 */
class Ticket
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
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Rate")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rate;

    /**
     * @var Booking
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Booking",  inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
    */
    private $booking;


    /**
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Visitor", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $visitor;


    /**
     * @ORM\Column(name="reducedRate", type="boolean")
     */
    private $reducedRate;

    /**
     * @ORM\Column(name="price", type="decimal", precision=5, scale=2, nullable=false)
     */
    private $price;



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
     * Set rate
     */
    public function setRate(Rate $rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set booking
     */
    public function setBooking(Booking $booking)
    {
        $this->booking = $booking;
       
        return $this;
    }

    /**
     * Get booking
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Set visitor
     */
    public function setVisitor(Visitor $visitor)
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * Get visitor
     */
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of reducedRate
     */ 
    public function getReducedRate()
    {
        return $this->reducedRate;
    }

    /**
     * Set the value of reducedRate
     *
     * @return  self
     */ 
    public function setReducedRate($reducedRate)
    {
        $this->reducedRate = $reducedRate;

        return $this;
    }
}

