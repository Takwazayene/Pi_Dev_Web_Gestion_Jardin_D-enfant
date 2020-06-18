<?php

namespace DorsafBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;


/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="DorsafBundle\Repository\EventRepository")
 */
class Event extends FullCalendarEvent
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
     * @Assert\Length(max=10)
     * @Assert\NotBlank
     * @Assert\NotNull
     *  @Assert\Regex(
     *     pattern     = "/^[a-zA-Z_ ]+$/i",
     *     htmlPattern = "^[a-zA-Z_ ]+$"
     * )
     * @ORM\Column(name="nomEvent", type="string", length=255)
     */
    private $nomEvent;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\NotNull
     * @ORM\Column(name="categorieEvent", type="string", length=255)
     */
    private $categorieEvent;

    /**
     * @var int
     *  @Assert\Type(type="integer")
     *  @Assert\Regex(
     *     pattern     = "/^[1-9][0-9]*$/",
     *     htmlPattern = "/^[1-9][0-9]*$/"
     * )
     * @ORM\Column(name="nbrPlaceDispo", type="integer")
     */
    private $nbrPlaceDispo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEvent", type="date")
     */
    private $dateEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebutEvent", type="date",nullable=true)
     */
    private $datedebutEvent;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefinEvent", type="date",nullable=true)
     */
    private $datefinEvent;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\NotNull
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\NotNull
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }








    /**
     * @return \DateTime
     */
    public function getDatedebutEvent()
    {
        return $this->datedebutEvent;
    }

    /**
     * @param \DateTime $datedebutEvent
     */
    public function setDatedebutEvent($datedebutEvent)
    {
        $this->datedebutEvent = $datedebutEvent;
    }

    /**
     * @return \DateTime
     */
    public function getDatefinEvent()
    {
        return $this->datefinEvent;
    }

    /**
     * @param \DateTime $datefinEvent
     */
    public function setDatefinEvent($datefinEvent)
    {
        $this->datefinEvent = $datefinEvent;
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
     * Set nomEvent
     *
     * @param string $nomEvent
     *
     * @return Event
     */
    public function setNomEvent($nomEvent)
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    /**
     * Get nomEvent
     *
     * @return string
     */
    public function getNomEvent()
    {
        return $this->nomEvent;
    }

    /**
     * Set categorieEvent
     *
     * @param string $categorieEvent
     *
     * @return Event
     */
    public function setCategorieEvent($categorieEvent)
    {
        $this->categorieEvent = $categorieEvent;

        return $this;
    }

    /**
     * Get categorieEvent
     *
     * @return string
     */
    public function getCategorieEvent()
    {
        return $this->categorieEvent;
    }

    /**
     * Set nbrPlaceDispo
     *
     * @param integer $nbrPlaceDispo
     *
     * @return Event
     */
    public function setNbrPlaceDispo($nbrPlaceDispo)
    {
        $this->nbrPlaceDispo = $nbrPlaceDispo;

        return $this;
    }

    /**
     * Get nbrPlaceDispo
     *
     * @return int
     */
    public function getNbrPlaceDispo()
    {
        return $this->nbrPlaceDispo;
    }

    /**
     * Set dateEvent
     *
     * @param date $dateEvent
     *
     * @return Event
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get dateEvent
     *
     * @return date
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Event
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
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);

    }

}

