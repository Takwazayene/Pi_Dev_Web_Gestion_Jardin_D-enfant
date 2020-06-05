<?php

namespace RestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;

/**
 * paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity(repositoryClass="RestoBundle\Repository\paiementRepository")
 * @Notifiable(name="paiement")

 */
class paiement
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
     * @var int
     *
     * @ORM\Column(name="idC", type="integer")
     */
    private $idC;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float",nullable=true)
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set idC
     *
     * @param integer $idC
     *
     * @return paiement
     */
    public function setIdC($idC)
    {
        $this->idC = $idC;

        return $this;
    }

    /**
     * Get idC
     *
     * @return int
     */
    public function getIdC()
    {
        return $this->idC;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return paiement
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

    /**
     * Set total
     *
     * @param float $total
     *
     * @return paiement
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return paiement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

