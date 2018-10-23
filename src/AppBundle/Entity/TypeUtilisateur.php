<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity()
* @ORM\Table(name="typeUtilisa")}
* 
*/
class TypeUtilisateur
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
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Annonces", mappedBy="typeUtilisateur", cascade={"persist", "remove"})
     *
     */
    private $annonces;

    /**
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\User", mappedBy="typeUtilisateur", cascade={"persist", "remove"})
     *
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleTypeUtilisa", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $libelleTypeUtilisa;

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
     * Set libelleTypeUtilisa
     *
     * @param string $libelleTypeUtilisa
     *
     * @return TypeUtilisateur
     */
    public function SetLibelleTypeUtilisa($libelleTypeUtilisa)
    {
        $this->libelleTypeUtilisa = $libelleTypeUtilisa;

        return $this;
    }

    /**
     * Get libelleTypeUtilisa
     *
     * @return string
     */
    public function getLibelleTypeUtilisa()
    {
        return $this->libelleTypeUtilisa;
    }

}