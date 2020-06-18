<?php

namespace DorsafBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="DorsafBundle\Repository\ClubRepository")
 */
class Club
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
     *  @Assert\NotBlank
     * @Assert\NotNull
     *  @Assert\Regex(
     *     pattern     = "/^[a-zA-Z_ ]+$/i",
     *     htmlPattern = "^[a-zA-Z_ ]+$"
     * )
     * @ORM\Column(name="nomClub", type="string", length=255)
     */
    private $nomClub;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\NotNull
     *  @Assert\Regex(
     *     pattern     = "/^[a-zA-Z_ ]+$/i",
     *     htmlPattern = "^[a-zA-Z_ ]+$"
     * )
     * @ORM\Column(name="activiteClub", type="string", length=255)
     */
    private $activiteClub;

    /**
     * @var int
     *  @Assert\Type(type="integer")
     *  @Assert\Regex(
     *     pattern     = "/^[1-9][0-9]*$/",
     *     htmlPattern = "/^[1-9][0-9]*$/"
     * )
     * @ORM\Column(name="effectif", type="integer")
     */
    private $effectif;
    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer" )
     */



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
     * Set nomClub
     *
     * @param string $nomClub
     *
     * @return Club
     */
    public function setNomClub($nomClub)
    {
        $this->nomClub = $nomClub;

        return $this;
    }

    /**
     * Get nomClub
     *
     * @return string
     */
    public function getNomClub()
    {
        return $this->nomClub;
    }

    /**
     * Set activiteClub
     *
     * @param string $activiteClub
     *
     * @return Club
     */
    public function setActiviteClub($activiteClub)
    {
        $this->activiteClub = $activiteClub;

        return $this;
    }

    /**
     * Get activiteClub
     *
     * @return string
     */
    public function getActiviteClub()
    {
        return $this->activiteClub;
    }

    /**
     * Set effectif
     *
     * @param integer $effectif
     *
     * @return Club
     */
    public function setEffectif($effectif)
    {
        $this->effectif = $effectif;

        return $this;
    }

    /**
     * Get effectif
     *
     * @return int
     */
    public function getEffectif()
    {
        return $this->effectif;
    }
}

