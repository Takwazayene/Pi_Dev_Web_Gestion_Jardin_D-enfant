<?php

namespace RestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;
/**
 * abonneresto
 *
 * @ORM\Table(name="abonneresto")
 * @ORM\Entity(repositoryClass="RestoBundle\Repository\abonnerestoRepository")
 * @Notifiable(name="abonneresto")
 */
class abonneresto
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
     * @ORM\Column(name="idAb", type="integer")
     */
    private $idAb;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="typeAbo", type="string", length=20)
     */
    private $typeAbo;

    /**
     * @var string
     *
     * @ORM\Column(name="typePension", type="string", length=50)
     */
    private $typePension;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="absence", type="integer")
     */
    private $absence;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAbo", type="datetime", nullable=true)
     */
    private $dateAbo;


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
     * Set idAb
     *
     * @param integer $idAb
     *
     * @return abonneresto
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
     * Set nom
     *
     * @param string $nom
     *
     * @return abonneresto
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
     * Set typeAbo
     *
     * @param string $typeAbo
     *
     * @return abonneresto
     */
    public function setTypeAbo($typeAbo)
    {
        $this->typeAbo = $typeAbo;

        return $this;
    }

    /**
     * Get typeAbo
     *
     * @return string
     */
    public function getTypeAbo()
    {
        return $this->typeAbo;
    }

    /**
     * Set typePension
     *
     * @param string $typePension
     *
     * @return abonneresto
     */
    public function setTypePension($typePension)
    {
        $this->typePension = $typePension;

        return $this;
    }

    /**
     * Get typePension
     *
     * @return string
     */
    public function getTypePension()
    {
        return $this->typePension;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return abonneresto
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set absence
     *
     * @param integer $absence
     *
     * @return abonneresto
     */
    public function setAbsence($absence)
    {
        $this->absence = $absence;

        return $this;
    }

    /**
     * Get absence
     *
     * @return int
     */
    public function getAbsence()
    {
        return $this->absence;
    }

    /**
     * Set dateAbo
     *
     * @param \DateTime $dateAbo
     *
     * @return abonneresto
     */
    public function setDateAbo($dateAbo)
    {
        $this->dateAbo = $dateAbo;

        return $this;
    }

    /**
     * Get dateAbo
     *
     * @return \DateTime
     */
    public function getDateAbo()
    {
        return $this->dateAbo;

     //   $date = new \Datetime($this->dateAbo);

      //  return $date;
    }
}

