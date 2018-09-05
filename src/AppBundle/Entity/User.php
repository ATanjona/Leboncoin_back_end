<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
* @ORM\Entity()
* @ORM\Table(name="user",
* uniqueConstraints={@ORM\UniqueConstraint(name="user_email_unique",columns={"email"})}
* )
*/
class User implements UserInterface, EquatableInterface
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
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     * 
     */
    
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     * 
     */

    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\NotBlank()
     * 
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="nomSociete", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nomSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseSociete", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $adresseSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="numStat", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $numStat;

    /**
     * @var string
     *
     * @ORM\Column(name="telSociete", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $telSociete;


    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $password;

      /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=254, unique=true, nullable=true)
     */
    private $activationToken;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $activationTokenDelay;

    /**
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Annonces", mappedBy="user", cascade={"persist", "remove"})
     *
     */
    private $annonces;

    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string",length=255, unique=true, nullable=true)
     */
    private $apiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string",length=255,nullable=true)
     */
    private $salt;

    
    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();

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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return User
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }
   
    /**
     * Set nomSociete
     * 
     * @param string $nomSociete
     * 
     * @return User
     */
    public function setNomSociete($nomSociete)
    {
        return $this->nomSociete = $nomSociete;
    }

    /**
     * Get nomSociete
     * 
     * @return string
     */
    public function getNomSociete()
    {
        return $this->nomSociete;
    }

    /**
     * Set adresseSociete
     * 
     * @param string $adresseSociete
     * 
     * @return User
     */
    public function setAdresseSociete($adresseSociete)
    {
        return $this->adresseSociete = $adresseSociete;
    }

    /**
     * Get adresseSociete
     * 
     * @return string
     */
    public function getAdresseSociete()
    {
        return $this->adresseSociete;
    }

    /**
     * Set numStat
     * 
     * @param string $numStat
     * 
     * @return User
     */
    public function setNumStat($numStat)
    {
        return $this->numStat = $numStat;
    }

    /**
     * Get numStat
     * 
     * @return string
     */
    public function getNumStat()
    {
        return $this->numStat;
    }

    /**
     * Set telSociete
     * 
     * @param string $telSociete
     * 
     * @return User
     */
    public function setTelSociete($telSociete)
    {
        return $this->telSociete = $telSociete;
    }

    /**
     * Get telSociete
     * 
     * @return string
     */
    public function getTelSociete()
    {
        return $this->telSociete;
    }

    /**
     * Set password
     * 
     * @param string $password
     * 
     * @return User
     */
    public function setPassword($password)
    {
        return $this->password = $password;
    }

    /**
     * Get password
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set activationToken
     *
     * @param string $activationToken
     *
     * @return User
     */
    public function setActivationToken($activationToken)
    {
        $this->activationToken = $activationToken;

        return $this;
    }

    /**
     * Get activationToken
     *
     * @return string
     */
    public function getActivationToken()
    {
        return $this->activationToken;
    }

    /**
     * Set activationTokenDelay
     *
     * @param integer $activationTokenDelay
     *
     * @return User
     */
    public function setActivationTokenDelay($activationTokenDelay)
    {
        $this->activationTokenDelay = $activationTokenDelay;

        return $this;
    }

    /**
     * Get activationTokenDelay
     *
     * @return integer
     */
    public function getActivationTokenDelay()
    {
        return $this->activationTokenDelay;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }


    public function getSalt()
    {
        return $this->salt;
    }
    public function eraseCredentials()
    {
        // Suppression des données sensibles
        $this->password = null;
    }

    /**
     * Set apiKey
     *
     * @param string $apiKey
     *
     * @return User
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->salt !== $user->getSalt()) {
            return false;
        }

        if ($this->nom !== $user->getNom()) {
            return false;
        }

        if ($this->email !== $user->getEmail()) {
            return false;
        }

        if ($this->apiKey !== $user->getApiKey()) {
            return false;
        }

        return true;
    }



}
