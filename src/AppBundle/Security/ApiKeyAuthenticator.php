<?php
namespace AppBundle\Security;

use AppBundle\Security\ApiKeyUserProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApiKeyAuthenticator implements SimplePreAuthenticatorInterface,AuthenticationFailureHandlerInterface
{
    private $encoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $encoder,\Doctrine\ORM\EntityManager $em)
    {
        $this->encoder = $encoder;
        $this->entityManager = $em;
    }
    public function createToken(Request $request, $providerKey)
    {
        $token = null;
        $username = null;
        $password = null;

        if($request->headers->has('X-AUTH-TOKEN'))
        {
            $token = $request->headers->get('X-AUTH-TOKEN');
        }
        else
        {
            $username = $request->request->get('username');
            $password = $request->request->get('password');
        }
        
        // dump($username);
        // exit();
        $credentials =  ['token'=>$token, 'username'=>$username, 'password'=>$password];

        return new PreAuthenticatedToken(
            'anon.',
            $credentials,
            $providerKey
        );
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        if (!$userProvider instanceof UserProvider) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The user provider must be an instance of UserProvider (%s was given).',
                    get_class($userProvider)
                )
            );
        }

        $credentials = $token->getCredentials();
        $apiKey = $credentials['token'];
        $username = $credentials['username'];
        $user = null;
        if (null === $apiKey) {
            if(null === $username)
            {

            }
            else 
            {
                $user =  $userProvider->loadUserByUsername($username);
                $plainPassword = $credentials['password'];
                $isPasswordValid = $this->encoder->isPasswordValid($user,$plainPassword);
                if(!$isPasswordValid)
                {
                    $user = null;
                }
                else
                {
                    $em = $this->entityManager;
                    $apiKey = md5($user->getUsername());
                    $user->setApiKey($apiKey);
                    $em->flush();
                }
            }
        }
        else $user = $userProvider->loadUserByUsername($apiKey);
        // dump($user);
        // exit();
        if(!$user)
        {
            throw new CustomUserMessageAuthenticationException(
                sprintf('API Key "%s" does not exist.', $apiKey)
            );
        }
        return new PreAuthenticatedToken(
            $user,
            $apiKey,
            $providerKey,
            $user->getRoles()
        );
    }
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(
            strtr($exception->getMessageKey(), $exception->getMessageData()),
            401
        );
    }
}