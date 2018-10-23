<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity()
* @ORM\Table(name="typeAnnonce")}
* 
*/
class TypeAnnonce
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
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Annonces", mappedBy="typeAnnonce", cascade={"persist", "remove"})
     *
     */

    private $annonces;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleTypeAnnonce", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $libelleTypeAnnonce;

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
     * Set libelleTypeAnnonce
     *
     * @param string $libelleTypeAnnonce
     *
     * @return TypeAnnonce
     */
    public function SetLibelleTypeAnnonce($libelleTypeAnnonce)
    {
        $this->libelleTypeAnnonce = $libelleTypeAnnonce;

        return $this;
    }

    /**
     * Get libelleTypeAnnonce
     *
     * @return string
     */
    public function getLibelleTypeAnnonce()
    {
        return $this->libelleTypeAnnonce;
    }

}