<?php

namespace EshopBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
/**
 * LigneCommandeE
 * @ORM\Table(name="lignecommandes")
 * @ORM\Entity(repositoryClass="EshopBundle\Repository\LigneCommandeERepository")
 */
class LigneCommandeE
{
    /**
     * @var int
     *
     * @ORM\Column(name="idLigneCommandes", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idCommande", type="integer")
     */

    private $idCommande;

    /**
     * @var int
     *
     * @ORM\Column(name="idProduit", type="integer")
     */
    private $idProduit;


    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;


    /**
     * @var float
     *
     * @ORM\Column(name="prixLigne", type="float")
     */
    private $prixLigne;




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
     * Set idCommande
     *
     * @param integer $idCommande
     *
     * @return LigneCommandeE
     */
    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;

        return $this;
    }

    /**
     * Get idCommande
     *
     * @return int
     */
    public function getIdCommande()
    {
        return $this->idCommande;
    }

    /**
     * Set idProduit
     *
     * @param integer $idProduit
     *
     * @return LigneCommandeE
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;

        return $this;
    }



    /**
     * Get idProduit
     *
     * @return int
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }


    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return LigneCommandeE
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set prixLigne
     *
     * @param float $prixLigne
     *
     * @return LigneCommandeE
     */
    public function setPrixLigne($prixLigne)
    {
        $this->prixLigne = $prixLigne;

        return $this;
    }

    /**
     * Get prixLigne
     *
     * @return float
     */
    public function getPrixLigne()
    {
        return $this->prixLigne;
    }

    public function __toString()
    {
        return  strval($this->id);

    }

    public function toStringIdCommande()
    {
        return strval($this->idCommande);
    }


}

