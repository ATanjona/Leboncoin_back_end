<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity()
* @ORM\Table(name="categorie")}
* 
*/
class Categorie
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
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Annonces", mappedBy="categorie", cascade={"persist", "remove"})
     *
     */

    private $annonces;

    /**
     * @var string
     *
     * @ORM\Column(name="groupeCategorie", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $groupeCategorie;


    /**
     * @var string
     *
     * @ORM\Column(name="libelleTypeCategorie", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $libelleTypeCategorie;

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
     * Set groupeCategorie
     *
     * @param string $groupeCategorie
     *
     * @return Categorie
     */
    public function setGroupeCategorie($groupeCategorie)
    {
        $this->groupeCategorie = $groupeCategorie;

        return $this;
    }

    /**
     * Get groupeCategorie
     *
     * @return string
     */
    public function getGroupeCategorie()
    {
        return $this->groupeCategorie;
    }

    /**
     * Set libelleTypeCategorie
     *
     * @param string $libelleTypeCategorie
     *
     * @return Categorie
     */
    public function setLibelleTypeCategorie($libelleTypeCategorie)
    {
        $this->libelleTypeCategorie = $libelleTypeCategorie;

        return $this;
    }

    /**
     * Get libelleTypeCategorie
     *
     * @return string
     */
    public function getLibelleTypeCategorie()
    {
        return $this->libelleTypeCategorie;
    }

}