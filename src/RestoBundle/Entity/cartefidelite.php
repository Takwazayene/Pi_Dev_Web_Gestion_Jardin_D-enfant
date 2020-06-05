<?php

namespace RestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cartefidelite
 *
 * @ORM\Table(name="cartefidelite")
 * @ORM\Entity(repositoryClass="RestoBundle\Repository\cartefideliteRepository")
 */
class cartefidelite
{
    /**
     * @var int
     *
     * @ORM\Column(name="idC", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idC;

    /**
     * @var int
     *
     * @ORM\Column(name="idAb", type="integer")
     */
    private $idAb;

    /**
     * @var int
     *
     * @ORM\Column(name="nbpoint", type="integer")
     */
    private $nbpoint;

    /**
     * @var float
     *
     * @ORM\Column(name="credit", type="float")
     */
    private $credit;

    /**
     * @var float
     *
     * @ORM\Column(name="benefice", type="float")
     */
    private $benefice;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;


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
     * Set idAb
     *
     * @param integer $idAb
     *
     * @return cartefidelite
     */
    public function setIdAb($idAb)
    {
        $this->idAb = $idAb;

        return $this;
    }

    /**
     * Get idAb
     *
     * @return int
     */
    public function getIdAb()
    {
        return $this->idAb;
    }

    /**
     * Set nbpoint
     *
     * @param integer $nbpoint
     *
     * @return cartefidelite
     */
    public function setNbpoint($nbpoint)
    {
        $this->nbpoint = $nbpoint;

        return $this;
    }

    /**
     * Get nbpoint
     *
     * @return int
     */
    public function getNbpoint()
    {
        return $this->nbpoint;
    }

    /**
     * Set credit
     *
     * @param float $credit
     *
     * @return cartefidelite
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit
     *
     * @return float
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set benefice
     *
     * @param float $benefice
     *
     * @return cartefidelite
     */
    public function setBenefice($benefice)
    {
        $this->benefice = $benefice;

        return $this;
    }

    /**
     * Get benefice
     *
     * @return float
     */
    public function getBenefice()
    {
        return $this->benefice;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return cartefidelite
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}

