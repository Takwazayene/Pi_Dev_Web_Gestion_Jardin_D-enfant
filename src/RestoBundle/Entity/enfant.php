<?php

namespace RestoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * enfant
 *
 * @ORM\Table(name="enfant")
 * @ORM\Entity(repositoryClass="RestoBundle\Repository\enfantRepository")
 */
class enfant
{
    /**
     * @var int
     *
     * @ORM\Column(name="idE", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idE;

    /**
     * @var int
     *
     * @ORM\Column(name="IdP", type="integer")
     */
    private $IdP;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=10)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var int
     *
     * @ORM\Column(name="IdG", type="integer")
     */
    private $idG;


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
     * Set idP
     *
     * @param integer $idP
     *
     * @return enfant
     */
    public function setIdP($idP)
    {
        $this->idP = $idP;

        return $this;
    }

    /**
     * Get idP
     *
     * @return int
     */
    public function getIdP()
    {
        return $this->idP;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return enfant
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return enfant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return enfant
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set idG
     *
     * @param integer $idG
     *
     * @return enfant
     */
    public function setIdG($idG)
    {
        $this->idG = $idG;

        return $this;
    }

    /**
     * Get idG
     *
     * @return int
     */
    public function getIdG()
    {
        return $this->idG;
    }

    public function __toString()
    {
        return $this->nom;
    }
}

