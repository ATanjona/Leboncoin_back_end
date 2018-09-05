<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use AppBundle\Form\AnnoncesType;
use AppBundle\Entity\Annonces;
use AppBundle\Controller\UserController;
use AppBundle\Entity\User;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

class AnnoncesController extends Controller
{

    /**
     * @Rest\View()
     * @Rest\Get("/annonce/liste/{id_annonce}")
     */
   public function getAnnonceAction($id_annonce){
        $annonce = $this->getDoctrine()->getRepository(Annonces::class)->find($id_annonce);
        if(!$annonce){
            return new JsonRespons(['message'=>'Cette annonce n\'est pas enregister'], Response::HTTT_NOT_FOUND);
        }
        return $annonce;
    }

    /**
    * @Rest\View(statusCode=Response::HTTP_CREATED)
    * @Rest\Post("/deposer/annonce")
    */
    public function postAnnonceAction(Request $request)
    {
            
        $annonces = new Annonces();
        //$form = $this->createForm(AnnoncesType::class, $annonces);

        //$form->submit($request->request->all());
        //if($form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $users = $this->get('database_connection')->fetchAll('SELECT * FROM user where id = '.$this->getUser()->getId());
       
        $user->setPassword($users[0]['password']);

        $startDate = $request->request->get('startDate');
        $endDate = $request->request->get('endDate');
        $date_start = \DateTime::createFromFormat('Y-m-d', $startDate);
        $date_end = \DateTime::createFromFormat('Y-m-d', $endDate);
        
        $annonces->setUser($user);
        $annonces->setCategorie($request->get('categorie'));
        $annonces->setTypeUser($request->get('typeUser'));
        $annonces->setTypeAnnonc($request->get('typeAnnonc'));
        $annonces->setTitre($request->get('titre'));
        $annonces->setText($request->get('text'));
        $annonces->setPrix($request->get('prix'));
        $annonces->setFlyer($request->get('flyer'));
        $annonces->setCodePostal($request->get('codePostal'));
        $annonces->setAdresse($request->get('adresse'));
        //$annonces->setEmail($users[0]['email']);
        //$annonces->setNumberPhone($request->get('numTel'));
        $annonces->setStartDate($date_start);
        if ($endDate) $annonces->setEndDate($date_end);
        $annonces->setIspublish(false);
        $em->persist($annonces);
        $em->flush();
        return new JsonResponse(['message'=>'Ajout avec succès'], Response::HTTP_CREATED);
                
          /*  }
            else{
                return new JsonResponse(['message'=>'Vous n\'avez pas de compte'], Response::HTTP_NOT_FOUND);
            }*/
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/annonce/supprimer/{id_annonce}")
    */

   public function removeAnnonceAction($id_annonce){


        $user = $this->getUser();

        $users = $this->get('database_connection')->fetchAll('SELECT * FROM user where id = '.$this->getUser()->getId());
       
        $user->setPassword($users[0]['password']);

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository(Annonces::class)->find($id_annonce);
       
        $em->remove($annonce);
        $em->flush();
        return new JsonResponse(['message'=>'Suppression avec succès'], Response::HTTP_CREATED);
    }

     /**
     * @Rest\View()
     * @Rest\Put("/annonce/modifier/{id_annonce}")
    */

    public function updateAnnonceAction(Request $request, $id_annonce){

        $user = $this->getUser();

        $users = $this->get('database_connection')->fetchAll('SELECT * FROM user where id = '.$this->getUser()->getId());
       
        $user->setPassword($users[0]['password']);

        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository(Annonces::class)->find($id_annonce);


        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $date_start = \DateTime::createFromFormat('Y-m-d', $startDate);
        $date_end = \DateTime::createFromFormat('Y-m-d', $endDate);

        $annonces->setCategorie($request->get('categorie'));
        $annonces->setTypeUser($request->get('typeUser'));
        $annonces->setTypeAnnonc($request->get('typeAnnonc'));
        $annonces->setTitre($request->get('titre'));
        $annonces->setText($request->get('text'));
        $annonces->setPrix($request->get('prix'));
        $annonces->setFlyer($request->get('flyer'));
        $annonces->setCodePostal($request->get('codePostal'));
        $annonces->setAdresse($request->get('adresse'));
        $annonces->setStartDate($date_start);
        if ($endDate) $annonces->setEndDate($date_end);

        $em->persist($annonces);
        $em->flush();

        return new JsonResponse(['message'=>'Modification avec succès'], Response::HTTP_CREATED);
        
    }
 }
    

