<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity()
* @ORM\Table(name="annonces")}
* )
*/

class Annonces
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
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User", inversedBy="annonces")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $categorie;

    

    /**
     * @var string
     *
     * @ORM\Column(name="typeUser", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $typeUser;

    /**
     * @var string
     *
     * @ORM\Column(name="typeAnnonc", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $typeAnnonc;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $text;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="Flyer", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $flyer;

    /**
     * @var int
     *
     * @ORM\Column(name="codePostal", type="integer", length=255)
     * @Assert\NotBlank()
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $adresse;

    /**
     * @var \Date
     *
     * @ORM\Column(name="start_date", type="date", nullable=true)
     * @Assert\NotBlank()
     */
    private $startDate;

    /**
     * @var \Date
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     * @Assert\NotBlank()
     */
    private $endDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_publish", type="boolean")
     * @Assert\NotBlank()
     */
    private $isPublish;


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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Events
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Annonces
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }


    /**
     * Set typeUser
     *
     * @param string $typeUser
     *
     * @return Annonces
     */
    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    /**
     * Get typeUser
     *
     * @return string
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * Set typeAnnonc
     *
     * @param string $typeAnnonc
     *
     * @return Annonces
     */
    public function setTypeAnnonc($typeAnnonc)
    {
        $this->typeAnnonc = $typeAnnonc;

        return $this;
    }

    /**
     * Get typeAnnonc
     *
     * @return string
     */
    public function getTypeAnnonc()
    {
        return $this->typeAnnonc;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Annonces
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

        /**
     * Set text
     *
     * @param string $text
     *
     * @return Annonces
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Annonces
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set flyer
     *
     * @param string $flyer
     *
     * @return Annonces
     */
    public function setFlyer($flyer)
    {
        $this->flyer = $flyer;

        return $this;
    }

    /**
     * Get flyer
     *
     * @return string
     */
    public function getFlyer()
    {
        return $this->flyer;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     *
     * @return Annonces
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Annonces
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Annonces
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Annonces
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    /**
     * Set isPublish
     *
     * @param boolean $isPublish
     *
     * @return Annonces
     */
    public function setIsPublish($isPublish)
    {
        $this->isPublish = $isPublish;

        return $this;
    }

    /**
     * Get isPublish
     *
     * @return bool
     */
    public function getIsPublish()
    {
        return $this->isPublish;
    }

    


}
