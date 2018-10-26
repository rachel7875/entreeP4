<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

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
     * @var \Date
     *
     * @ORM\Column(name="visitDay", type="date")
     * @Assert\NotBlank()
     * @Assert\Date( message = "'{{ value }}' n'est pas une date valide.",)
     * @Assert\Range(
     *      min = "now",
     *      minMessage = "Il n'est pas possible de réserver à une date antérieure à aujourd'hui.",
     * )
     */
    private $visitDay;

    /**
     * @var int
     *
     * @ORM\Column(name="ticketsNumber", type="integer")
     * @Assert\Choice(choices={1, 2, 3, 4, 5, 6, 7, 8, 9, 10}, strict="true")
     */
    private $ticketsNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 255)
     * @Assert\Email(
     *      message = "'{{ value }}' n'est pas un email valide.",
     *      checkMX = true)
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
     * @ORM\Column(name="tickets", type="object", nullable=true)
     */
    private $tickets;

    /**
     * @var string
     *
     * @ORM\Column(name="bookingCode", type="string", length=255, unique=true, nullable=true)
     */
    private $bookingCode;


    public function __construct()
    {
        // By default, the visitDay is the date of today
        $this->visitDay = new \Datetime();
    }


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
