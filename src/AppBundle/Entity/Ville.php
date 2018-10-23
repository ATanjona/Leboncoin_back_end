<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity()
* @ORM\Table(name="ville")}
* 
*/
class Ville
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
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Annonces", mappedBy="ville", cascade={"persist", "remove"})
     *
     */

    private $annonces;

    /**
     * @var int
     *
     * @ORM\Column(name="codePostal", type="integer", length=255)
     * 
     */

    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleVille", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $libelleVille;

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Ville
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set libelleVille
     *
     * @param string $libelleVille
     *
     * @return Ville
     */
    public function setLibelleVille($libelleVille)
    {
        $this->libelleVille = $libelleVille;

        return $this;
    }

    /**
     * Get libelleVille
     *
     * @return string
     */
    public function getLibelleVille()
    {
        return $this->libelleVille;
    }

}