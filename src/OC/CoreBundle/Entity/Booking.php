<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="OC\CoreBundle\Repository\BookingRepository")
 */
class Booking
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
     * @ORM\Column(name="visitDay", type="datetime")
     */
    private $visitDay;

    /**
     * @var int
     *
     * @ORM\Column(name="ticketsNumber", type="integer")
     */
    private $ticketsNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Duration")
     * @ORM\JoinColumn(nullable=false)
     */

    private $duration;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="tickets", type="object")
     */
    private $tickets;

    /**
     * @var string
     *
     * @ORM\Column(name="bookingCode", type="string", length=255, unique=true)
     */
    private $bookingCode;


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
     * Set visitDay
     *
     * @param \DateTime $visitDay
     *
     * @return Booking
     */
    public function setVisitDay($visitDay)
    {
        $this->visitDay = $visitDay;

        return $this;
    }

    /**
     * Get visitDay
     *
     * @return \DateTime
     */
    public function getVisitDay()
    {
        return $this->visitDay;
    }

    /**
     * Set ticketsNumber
     *
     * @param integer $ticketsNumber
     *
     * @return Booking
     */
    public function setTicketsNumber($ticketsNumber)
    {
        $this->ticketsNumber = $ticketsNumber;

        return $this;
    }

    /**
     * Get ticketsNumber
     *
     * @return int
     */
    public function getTicketsNumber()
    {
        return $this->ticketsNumber;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Booking
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set duration
     *
     * @param \stdClass $duration
     *
     * @return Booking
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \stdClass
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set bookingCode
     *
     * @param string $bookingCode
     *
     * @return Booking
     */
    public function setBookingCode($bookingCode)
    {
        $this->bookingCode = $bookingCode;

        return $this;
    }

    /**
     * Get bookingCode
     *
     * @return string
     */
    public function getBookingCode()
    {
        return $this->bookingCode;
    }

    /**
     * Get the value of tickets
     *
     * @return  \stdClass
     */ 
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set the value of tickets
     *
     * @param  \stdClass  $tickets
     *
     * @return  self
     */ 
    public function setTickets(\stdClass $tickets)
    {
        $this->tickets = $tickets;

        return $this;
    }
}
