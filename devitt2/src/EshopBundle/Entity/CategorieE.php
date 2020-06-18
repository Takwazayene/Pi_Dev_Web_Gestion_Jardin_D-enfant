<?php

namespace EshopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieE
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="EshopBundle\Repository\CategorieERepository")
 */
class CategorieE
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCategorie", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, unique=true)
     */
    private $label;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function geetId()
    {
        return $this->id;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return CategorieE
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    public function __toString()
    {
        return  strval($this->id);

    }


}

