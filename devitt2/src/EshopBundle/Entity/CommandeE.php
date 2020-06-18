<?php

namespace EshopBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * CommandeE
 * @ORM\Table(name="commandes")
 * @ORM\Entity(repositoryClass="EshopBundle\Repository\CommandeERepository")
 */
class CommandeE
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCommande", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer")
     */

    private $idUser;

    /**
     * @var \date
     *
     * @ORM\Column(name="dateCommande", type="date")
     */
    private $dateCommande;

    /**
     * @var \Date
     */
    private $dateLivraison;

    /**
     * @var float
     * @ORM\Column(name="prixTotal", type="float")

     */
    private $prixTotal;

    /**
     * @var bool
     */
    private $etatCommande;

    /**
     * @var int
     */
    private $idPanier;



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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return CommandeE
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return CommandeE
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set dateLivraison
     *
     * @param \DateTime $dateLivraison
     *
     * @return CommandeE
     */
    public function setDateLivraison($dateLivraison)
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    /**
     * Get dateLivraison
     *
     * @return \DateTime
     */
    public function getDateLivraison()
    {
        return $this->dateLivraison;
    }

    /**
     * Set prixTotal
     *
     * @param float $prixTotal
     *
     * @return CommandeE
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return float
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set etatCommande
     *
     * @param boolean $etatCommande
     *
     * @return CommandeE
     */
    public function setEtatCommande($etatCommande)
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }

    /**
     * Get etatCommande
     *
     * @return bool
     */
    public function getEtatCommande()
    {
        return $this->etatCommande;
    }

    /**
     * Set idPanier
     *
     * @param integer $idPanier
     *
     * @return CommandeE
     */
    public function setIdPanier($idPanier)
    {
        $this->idPanier = $idPanier;

        return $this;
    }

    /**
     * Get idPanier
     *
     * @return int
     */
    public function getIdPanier()
    {
        return $this->idPanier;
    }
}

