<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * GalerieAnnonce
 *
 * @ORM\Table(name="GalerieAnnonce")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GalerieAnnonceRepository")
 */
class GalerieAnnonce
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
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     *@ORM\ManyToOne(targetEntity="\AppBundle\Entity\Annonces", inversedBy="galerieAnnonce") 
     */
    private $annonces;

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
     * Set alt
     *
     * @param string $alt
     *
     * @return ImageArticle
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return ImageArticle
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set annonces
     *
     * @param \AppBundle\Entity\Annonces $annonces
     *
     * @return GalerieAnnonce
     */
    public function setAnnonces(\AppBundle\Entity\Annonces $annonces = null)
    {
        $this->annonces = $annonces;

        return $this;
    }

    /**
     * Get annonces
     *
     * @return \AppBundle\Entity\Annonces
     */
    public function getAnnonces()
    {
        return $this->annonces;
    }
}
