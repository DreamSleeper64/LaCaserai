<?php

namespace HotelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="HotelBundle\Repository\RoomRepository")
 */
class Room
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * One Room has many Images
     *
     * @ORM\OneToMany(targetEntity="HotelBundle\Entity\Media", mappedBy="room")
     */
    private $media;

    /**
     * One Room has many arrangements
     *
     * @ORM\OneToMany(targetEntity="HotelBundle\Entity\Arrangement", mappedBy="room")
     */
    private $arrangement;

    /**
     * @ORM\ManyToMany(targetEntity="HotelBundle\Entity\Invoice", mappedBy="rooms")
     */
    private $invoices;

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
     * Set name
     *
     * @param string $name
     *
     * @return Room
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Room
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Room
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Room
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    public function __construct(){
        $this->media = new ArrayCollection();
        $this->arrangement = new ArrayCollection();
        $this->invoices = new ArrayCollection();
    }

    /**
     * Add medium
     *
     * @param \HotelBundle\Entity\Media $medium
     *
     * @return Room
     */
    public function addMedia(\HotelBundle\Entity\Media $medium)
    {
        $this->media[] = $medium;

        return $this;
    }

    /**
     * Remove medium
     *
     * @param \HotelBundle\Entity\Media $medium
     */
    public function removeMedia(\HotelBundle\Entity\Media $medium)
    {
        $this->media->removeElement($medium);
    }

    /**
     * Get media
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedia()
    {
        return $this->media;
    }


    /**
     * Add arrangement
     *
     * @param \HotelBundle\Entity\Arrangement $arrangement
     *
     * @return Room
     */
    public function addArrangement(\HotelBundle\Entity\Arrangement $arrangement)
    {
        $this->arrangement[] = $arrangement;

        return $this;
    }

    /**
     * Remove arrangement
     *
     * @param \HotelBundle\Entity\Arrangement $arrangement
     */
    public function removeArrangement(\HotelBundle\Entity\Arrangement $arrangement)
    {
        $this->arrangement->removeElement($arrangement);
    }

    /**
     * Get arrangement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArrangement()
    {
        return $this->arrangement;
    }

    /**
     * Add invoice
     *
     * @param \HotelBundle\Entity\Invoice $invoice
     *
     * @return Room
     */
    public function addInvoice(\HotelBundle\Entity\Invoice $invoice)
    {
        $this->invoices[] = $invoice;

        return $this;
    }

    /**
     * Remove invoice
     *
     * @param \HotelBundle\Entity\Invoice $invoice
     */
    public function removeInvoice(\HotelBundle\Entity\Invoice $invoice)
    {
        $this->invoices->removeElement($invoice);
    }

    /**
     * Get invoices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvoices()
    {
        return $this->invoices;
    }
}
