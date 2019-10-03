<?php

namespace OC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use OC\CoreBundle\Validator\AntiClosingDays;
use OC\CoreBundle\Validator\AntiMaxTicketsNb;
use OC\CoreBundle\Validator\AntiDayDurationAfterTwoPM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;

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
     * @Assert\NotBlank( message = "notBlank",)
     * @Assert\Date( message = "booking.visitDay.date",)
     * @Assert\Range(
     *      min = "today",
     *      minMessage = "booking.visitDay.range",
     * )
     * @AntiClosingDays()
    */
    private $visitDay;

    /**
     * @var int
     *
     * @ORM\Column(name="ticketsNumber", type="integer")
     * @Assert\Choice(choices={1, 2, 3, 4, 5, 6, 7, 8, 9, 10}, strict="true")
     * @Assert\Range(
     *      max = 10,
     *      maxMessage = "booking.ticketsNumber.Range"
     * )
     * @AntiMaxTicketsNb
     */
    private $ticketsNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank( message = "notBlank",)
     * @Assert\Email(
     *      message = "booking.email.Email",
     *      checkMX = true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="OC\CoreBundle\Entity\Duration")
     * @ORM\JoinColumn(nullable=false)
     * @AntiDayDurationAfterTwoPM
     */
    private $duration;

    /**
     *  @ORM\OneToMany(targetEntity="OC\CoreBundle\Entity\Ticket", mappedBy="booking", cascade={"persist"})
     * @Assert\Valid()
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
        $this->tickets = new ArrayCollection();
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
    public function setDuration(Duration $duration)
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



    public function addTicket(Ticket $ticket)
    {
      $this->tickets[] = $ticket;
      $ticket->setBooking($this);
  
      return $this;
    }

    public function removeTicket(Ticket $ticket)
    {
      $this->tickets->removeElement($ticket);
    }
  

    /**
     * Get the value of tickets
     */ 
    public function getTickets()
    {
        return $this->tickets;
    }


}
