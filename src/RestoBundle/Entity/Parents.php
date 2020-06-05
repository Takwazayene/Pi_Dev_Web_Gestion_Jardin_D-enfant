<?php

namespace RestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * parent
 *
 * @ORM\Table(name="parent")
 * @ORM\Entity(repositoryClass="RestoBundle\Repository\parentRepository")
 */
class Parents
{
    /**
     * @var int
     *
     * @ORM\Column(name="idP", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idP;

    /**
     * @var string
     *
     * @ORM\Column(name="nomP", type="string", length=20)
     */
    private $nomP;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomP", type="string", length=20)
     */
    private $prenomP;

    /**
     * @var int
     *
     * @ORM\Column(name="numP", type="integer")
     */
    private $numP;

    /**
     * @var string
     *
     * @ORM\Column(name="adresP", type="string", length=255)
     */
    private $adresP;

    /**
     * @var string
     *
     * @ORM\Column(name="mailP", type="string", length=255)
     */
    private $mailP;

    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string", length=11)
     */
    private $cin;


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
     * Set nomP
     *
     * @param string $nomP
     *
     * @return parent
     */
    public function setNomP($nomP)
    {
        $this->nomP = $nomP;

        return $this;
    }

    /**
     * Get nomP
     *
     * @return string
     */
    public function getNomP()
    {
        return $this->nomP;
    }

    /**
     * Set prenomP
     *
     * @param string $prenomP
     *
     * @return parent
     */
    public function setPrenomP($prenomP)
    {
        $this->prenomP = $prenomP;

        return $this;
    }

    /**
     * Get prenomP
     *
     * @return string
     */
    public function getPrenomP()
    {
        return $this->prenomP;
    }

    /**
     * Set numP
     *
     * @param integer $numP
     *
     * @return parent
     */
    public function setNumP($numP)
    {
        $this->numP = $numP;

        return $this;
    }

    /**
     * Get numP
     *
     * @return int
     */
    public function getNumP()
    {
        return $this->numP;
    }

    /**
     * Set adresP
     *
     * @param string $adresP
     *
     * @return parent
     */
    public function setAdresP($adresP)
    {
        $this->adresP = $adresP;

        return $this;
    }

    /**
     * Get adresP
     *
     * @return string
     */
    public function getAdresP()
    {
        return $this->adresP;
    }

    /**
     * Set mailP
     *
     * @param string $mailP
     *
     * @return parent
     */
    public function setMailP($mailP)
    {
        $this->mailP = $mailP;

        return $this;
    }

    /**
     * Get mailP
     *
     * @return string
     */
    public function getMailP()
    {
        return $this->mailP;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return parent
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    public function __toString()
    {
        return $this->nomP;
    }


}