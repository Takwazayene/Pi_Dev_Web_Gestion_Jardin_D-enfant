<?php

namespace RestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plat
 *
 * @ORM\Table(name="plat")
 * @ORM\Entity(repositoryClass="RestoBundle\Repository\PlatRepository")
 */
class Plat
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
     * @var float
     *
     * @ORM\Column(name="rat", type="float")
     */
    private $rat;

    /**
     * @var int
     *
     * @ORM\Column(name="plat", type="integer")
     */
    private $plat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrrat", type="integer")
     */
    private $nbrrat;


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
     * Set rat
     *
     * @param float $rat
     *
     * @return Plat
     */
    public function setRat($rat)
    {
        $this->rat = $rat;

        return $this;
    }

    /**
     * Get rat
     *
     * @return float
     */
    public function getRat()
    {
        return $this->rat;
    }

    /**
     * Set plat
     *
     * @param integer $plat
     *
     * @return Plat
     */
    public function setPlat($plat)
    {
        $this->plat = $plat;

        return $this;
    }

    /**
     * Get plat
     *
     * @return int
     */
    public function getPlat()
    {
        return $this->plat;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Plat
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nbrrat
     *
     * @param integer $nbrrat
     *
     * @return Plat
     */
    public function setNbrrat($nbrrat)
    {
        $this->nbrrat = $nbrrat;

        return $this;
    }

    /**
     * Get nbrrat
     *
     * @return int
     */
    public function getNbrrat()
    {
        return $this->nbrrat;
    }
}

