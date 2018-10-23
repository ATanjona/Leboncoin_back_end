<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use AppBundle\Entity\TypeUtilisateur;

class UserController extends BaseController
{

        /**
         * @Rest\View()
         * @Rest\Get("/liste")
        */

        public function getAllUserAction(Request $request){

            $users = $this->getDoctrine()->getRepository(User::class)->findAll();

            if (empty($users)) {
                return new JsonResponse(['message' => 'Utilisateur non trouvés'], Response::HTTP_NOT_FOUND);
            }
            return $users;
        }

        /**
         * @Rest\View()
         * @Rest\Get("/liste/{user_id}")
        */

        public function getUserAction($user_id){

            $users = $this->getDoctrine()->getRepository(User::class)->find($user_id);

            if (empty($users)) {
                return new JsonResponse(['message' => 'Utilisateur non trouvé'], Response::HTTP_NOT_FOUND);
            }

            return $users;
        }
        
        /**
         * @Rest\View(statusCode=Response::HTTP_CREATED)
         * @Rest\Post("/inscription")
         */
        public function postUserAction(Request $request)
        {
          
            $users = new User();
            $form = $this->createForm(UserType::class, $users);

            $form->submit($request->request->all());
            $em = $this->getDoctrine()->getManager();

                // check if user exist
                if($em->getRepository(User::class)->findOneBy(['username'=>$request->get('username')])){
                return new JsonResponse(['user'=>null,'message'=>'Cette utilisateur est déja enregistrer']);
                }
                // check if mail already used
                elseif($em->getRepository(User::class)->findOneBy(['email'=>$request->get('email')])) {
                return new JsonResponse(['email'=>null,'message'=>'Cette email est déja utiliser']);
                 } 
                else
                {
                    if(!($request->get('username'))){
                        $typeUtili = 'Professionnel';
                    }
                    else $typeUtili = 'Particulier';

                $encoder = $this->get('security.password_encoder');
                $encoded = $encoder->encodePassword($users, $users->getPassword());

                

                $typeUtilisa = $this->getDoctrine()->getRepository(TypeUtilisateur::class)->findOneBy(array("libelleTypeUtilisa"=>$typeUtili));

                $users->setTypeUtilisateur($typeUtilisa);


                $users->setPassword($encoded);
                //$users->setApiKey(md5($users->getUsername()));
                $users->setRoles(['ROLE_USER']);
                $users->setIsActive(false);
                $users->setActivationToken($this->random(32));
                $users->setActivationTokenDelay(strtotime("+3 days"));

                $message = (new \Swift_Message('Registration confirmation'))
                ->setFrom('no-reply@leboncoin.mg')
                ->setTo($users->getEmail())
                ->setBody(
                    $this->renderView(
                        'emails/confirmation.html.twig',
                        array('username'=>$users->getUsername(),
                              'email'=>$users->getEmail(),
                              'activationToken'=>$users->getActivationToken())
                    ),
                    'text/html'
                );

                $this->get('mailer')->send($message);
                $em->persist($users);
                $em->flush();
                /*return $this->renderJson(['message'=>'insert ok'],Response::HTTP_OK);*/
                return $this->renderJson(['message' => 'L\'email de vérification a été envoyé',
                                        'email'=>'Nous venons d\'envoyer un e-mail de vérification à' .$users->getEmail(). 'Veuillez cliquer sur le lien dans l\'e-mail pour activer votre compte'],Response::HTTP_OK);
                /*return new JsonResponse(['message' => 'L\'email de vérification a été envoyé',
                                        'email'=>'Nous venons d\'envoyer un e-mail de vérification à' .$users->getEmail(). 'Veuillez cliquer sur le lien dans l\'e-mail pour activer votre compte'], Response::HTTP_OK);*/
            }
        }

        private function random($length = 16)
        {
            if (function_exists('openssl_random_pseudo_bytes'))
            {
                $bytes = openssl_random_pseudo_bytes($length * 2);
    
                if ($bytes === false)
                {
                    // throw exception that unable to create random token
                }
    
                return substr(str_replace(array('/', '+', '='), '', base64_encode($bytes)), 0, $length);
            }
    
            return ;
        }

    /**
     * @param Request $request
     *
     * @Route("/compte/confirmation_email/{token}", name="confirm_account")
     */
    public function confirmationAction(Request $request, $token){
        $em = $this->getDoctrine()->getManager();
        /** @var user $user */
        $user = $this->getDoctrine()->getRepository(user::class)
            ->findOneBy(array('activationToken'=>$token));
        if(!is_null($user)){

            if(!$user->getIsActive()){
                $now = strtotime('now');
                // if token delay is ok
                if($now < $user->getActivationTokenDelay()){
                    $user->setIsActive(true);
                    $em->persist($user);
                    $em->flush();
                    return $this->redirect($this->getParameter('redirect_url'));
                    /*return new JsonResponse(['message' => 'Compte vérifié avec succès',
                                            'email'=> 'vous êtes maintenant invités à utiliser toutes les fonctionnalités de Leboncoin'], Response::HTTP_CREATED);*/
                }else{
                    // token delay is over
                    return new JsonResponse(['message' => 'Ce délai est terminé, veuillez prendre un nouveau jeton'], Response::HTTP_NOT_FOUND);
                }

            }else{
                return new JsonResponse(['message' => 'Le jeton est déjà utilisé, ce lien n\'est pas accessible'], Response::HTTP_NOT_FOUND);
            }
        }else{
            // user not found
            return new JsonResponse(['message' => 'Nous ne pouvons pas trouver cet utilisateur'], Response::HTTP_NOT_FOUND);
        }

    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/compte/supprimer/{id}")
     */
    public function removeUserAction(Request $request,$id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $user = $em->getRepository('AppBundle:User')
                    ->find($id);
        if ($user) {
            $em->remove($user);
            $em->flush();
            return new JsonResponse(['message' => 'Suppression avec succès'], Response::HTTP_CREATED);
        }
    }

     /**
      * @Rest\View()
      * @Rest\Put("/compte/modifier/{id}")
    */

    public function updateUserAction(Request $request, $id){

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $form = $this->createForm(UserType::class, $user);

        $form->submit($request->request->all());
        
        if($form->isValid())
        {   
            if (!empty($user->getPassword())) {
                $encoder = $this->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($encoded);
            }

            $em = $this->getDoctrine()->getManager();            
            $em->merge($user);
            $em->flush();

            return new JsonResponse(['message'=>'Modifier avec succès', Response::HTTP_CREATED]);

        }else
        {
            return new JsonResponse(['message'=>'', Response::HTTP_NOT_FOUND]);
        }

    }

}


