<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
* @ORM\Entity()
* @ORM\Table(name="annonces")}
* 
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
     * @var int
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Categorie", inversedBy="annonces")
     * @Assert\NotBlank()
     */
    private $categorie;

    
    /**
     * @var int
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\TypeUtilisateur", inversedBy="annonces")
     * @Assert\NotBlank()
     */
    private $typeUtilisateur;

    /**
     * @var int
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\TypeAnnonce", inversedBy="annonces")
     * @Assert\NotBlank()
     */
    private $typeAnnonce;

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
     * @ORM\Column(name="flyer", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $flyer;

    /**
     * @var UploadedFile
     */
    private $flyerFile;

    /**
     * @var int
     * 
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Ville", inversedBy="annonces")
     * @Assert\NotBlank()
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAnnonce", type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    private $emailAnnonce;

    /**
     * @var string
     *
     * @ORM\Column(name="telAnnonce", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $telAnnonce;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_isPublished", type="datetime", nullable=true)
     * @Assert\NotBlank()
     */
    private $isPublishDate;

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
     * @return Annonces
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
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Annonces
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    } 

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set typeUtilisateur
     *
     * @param \AppBundle\Entity\TypeUtilisateur $typeUtilisateur
     *
     * @return Annonces
     */
    public function setTypeUtilisateur(\AppBundle\Entity\TypeUtilisateur $typeUtilisateur = null)
    {
        $this->typeUtilisateur = $typeUtilisateur;

        return $this;
    } 

    /**
     * Get typeUtilisateur
     *
     * @return \AppBundle\Entity\TypeUtilisateur
     */
    public function getTypeUtilisateur()
    {
        return $this->typeUtilisateur;
    }

    /**
     * Set typeAnnonce
     *
     * @param \AppBundle\Entity\TypeAnnonce $typeAnnonce
     *
     * @return Annonces
     */
    public function setTypeAnnonce(\AppBundle\Entity\TypeAnnonce $typeAnnonce = null)
    {
        $this->typeAnnonce = $typeAnnonce;

        return $this;
    } 

    /**
     * Get typeAnnonce
     *
     * @return \AppBundle\Entity\TypeAnnonce
     */
    public function getTypeAnnonce()
    {
        return $this->typeAnnonce;
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
     * Set ville
     *
     * @param \AppBundle\Entity\Ville $ville
     *
     * @return Annonces
     */
    public function setVille(\AppBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    } 

    /**
     * Get ville
     *
     * @return \AppBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
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
     * Set emailAnnonce
     *
     * @param string $emailAnnonce
     *
     * @return Annonces
     */
    public function setEmailAnnonce($emailAnnonce)
    {
        $this->emailAnnonce = $emailAnnonce;

        return $this;
    }

    /**
     * Get emailAnnonce
     *
     * @return string
     */
    public function getEmailAnnonce()
    {
        return $this->emailAnnonce;
    }

        /**
     * Set telAnnonce
     *
     * @param string $telAnnonce
     *
     * @return Annonces
     */
    public function setTelAnnonce($telAnnonce)
    {
        $this->telAnnonce = $telAnnonce;

        return $this;
    }

    /**
     * Get telAnnonce
     *
     * @return string
     */
    public function getTelAnnonce()
    {
        return $this->telAnnonce;
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

    /**
     * Set isPublishDate
     *
     * @param \DateTime $isPublishDate
     *
     * @return Annonces
     */
    public function setIsPublishDate($isPublishDate)
    {
        $this->isPublishDate = $isPublishDate;

        return $this;
    }

    /**
     * Get isPublishDate
     *
     * @return \DateTime
     */
    public function getIsPublishDate()
    {
        return $this->isPublishDate;
    }

    /**
     * @return mixed
     */
    public function getFlyerFile()
    {
        return $this->flyerFile;
    }

    /**
     * @param mixed $flyerFile
     */
    public function setFlyerFile($flyerFile)
    {
        $this->flyerFile = $flyerFile;
    }

    public function upload(){
        if($this->flyerFile == null){
            return;
        }
        $filename = $this->generateUniqueName() . '.'.$this->flyerFile->getClientOriginalExtension();
        $this->flyerFile->move($this->getRootDir(),$filename);
        $this->flyer = $filename;
        return $this;
    }

    public function generateUniqueName(){
        return md5(uniqid());
    }

    public function getUploadDir(){
        return "uploads/annonces";
    }

    public function getRootDir(){
        return __DIR__.'/../../../web/'. $this->getUploadDir();
    }




}
