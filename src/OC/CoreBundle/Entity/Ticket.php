<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToOne(targetEntity="OC\CoreBundle\Entity\Booking")
     * @ORM\JoinColumn(nullable=false)
    */
    private $booking;

    /**
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Visitor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visitor;





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
     *
     * @param \stdClass $rate
     *
     * @return Ticket
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return \stdClass
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set booking
     *
     * @param \stdClass $booking
     *
     * @return Ticket
     */
    public function setBooking($booking)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \stdClass
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Set visitor
     *
     * @param \stdClass $visitor
     *
     * @return Ticket
     */
    public function setVisitor($visitor)
    {
        $this->visitor = $visitor;

        return $this;
    }

    /**
     * Get visitor
     *
     * @return \stdClass
     */
    public function getVisitor()
    {
        return $this->visitor;
    }
}

