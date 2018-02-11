<?php

namespace HotelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Invoice
 *
 * @ORM\Table(name="invoice")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\InvoiceRepository")
 */
class Invoice
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
     * @ORM\Column(name="orderDate", type="date")
     */
    private $orderDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkinDate", type="date")
     */
    private $checkinDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="checkoutDate", type="date")
     */
    private $checkoutDate;

    /**
     * @var int
     *
     * @ORM\Column(name="adults", type="integer")
     */
    private $adults;

    /**
     * @var int
     *
     * @ORM\Column(name="childeren", type="integer")
     */
    private $childeren;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="HotelBundle\Entity\Room", inversedBy="invoices")
     * @ORM\JoinTable(name="invoice_x_room")
     */
    private $rooms;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="HotelBundle\Entity\User", inversedBy="invoices")
     * @ORM\JoinTable(name="invoice_x_user")
     */
    private $users;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="HotelBundle\Entity\Season", inversedBy="invoices")
     * @ORM\JoinTable(name="invoice_x_season")
     */
    private $seasons;

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
     * Set orderDate
     *
     * @param \DateTime $orderDate
     *
     * @return Invoice
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set checkinDate
     *
     * @param \DateTime $checkinDate
     *
     * @return Invoice
     */
    public function setCheckinDate($checkinDate)
    {
        $this->checkinDate = $checkinDate;

        return $this;
    }

    /**
     * Get checkinDate
     *
     * @return \DateTime
     */
    public function getCheckinDate()
    {
        return $this->checkinDate;
    }

    /**
     * Set checkoutDate
     *
     * @param \DateTime $checkoutDate
     *
     * @return Invoice
     */
    public function setCheckoutDate($checkoutDate)
    {
        $this->checkoutDate = $checkoutDate;

        return $this;
    }

    /**
     * Get checkoutDate
     *
     * @return \DateTime
     */
    public function getCheckoutDate()
    {
        return $this->checkoutDate;
    }

    /**
     * Set adults
     *
     * @param integer $adults
     *
     * @return Invoice
     */
    public function setAdults($adults)
    {
        $this->adults = $adults;

        return $this;
    }

    /**
     * Get adults
     *
     * @return int
     */
    public function getAdults()
    {
        return $this->adults;
    }

    /**
     * Set childeren
     *
     * @param integer $childeren
     *
     * @return Invoice
     */
    public function setChilderen($childeren)
    {
        $this->childeren = $childeren;

        return $this;
    }

    /**
     * Get childeren
     *
     * @return int
     */
    public function getChilderen(){
        return $this->childeren;
    }

    public function __construct(){
        $this->rooms = new ArrayCollection();
        $this->seasons = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * Add room
     *
     * @param \HotelBundle\Entity\Room $room
     *
     * @return Invoice
     */
    public function addRoom(\HotelBundle\Entity\Room $room)
    {
        $this->rooms[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \HotelBundle\Entity\Room $room
     */
    public function removeRoom(\HotelBundle\Entity\Room $room)
    {
        $this->rooms->removeElement($room);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Add user
     *
     * @param \HotelBundle\Entity\User $user
     *
     * @return Invoice
     */
    public function addUser(\HotelBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \HotelBundle\Entity\User $user
     */
    public function removeUser(\HotelBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add season
     *
     * @param \HotelBundle\Entity\Season $season
     *
     * @return Invoice
     */
    public function addSeason(\HotelBundle\Entity\Season $season)
    {
        $this->seasons[] = $season;

        return $this;
    }

    /**
     * Remove season
     *
     * @param \HotelBundle\Entity\Season $season
     */
    public function removeSeason(\HotelBundle\Entity\Season $season)
    {
        $this->seasons->removeElement($season);
    }

    /**
     * Get seasons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeasons()
    {
        return $this->seasons;
    }
}
