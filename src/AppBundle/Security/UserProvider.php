<?php

namespace AppBundle\Security;

use AppBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityManager;

class UserProvider implements UserProviderInterface
{
    private $entityManager;

    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    public function loadUserByUsername($username)
    {
        return $this->fetchUser($username);
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }

    private function fetchUser($username)
    {
        // make a call to your webservice here
        $query = $this->entityManager->createQuery('SELECT u FROM AppBundle:User u WHERE (u.username = :username OR u.email = :username OR u.apiKey = :username) and u.isActive = :is_active');
        $query->setParameter('username',$username);
        $query->setParameter('is_active',true);
        $userData = $query->getOneOrNullResult();
        // pretend it returns an array on success, false if there is no user
        
        
        if ($userData) {
            return $userData;
        }

        throw new UsernameNotFoundException(
            sprintf('Pseudo or username "%s" does not exist.', $username)
        );
    }
}