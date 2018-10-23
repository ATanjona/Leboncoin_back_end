<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use AppBundle\Entity\TypeUtilisateur;

class AdminTypeUserController extends Controller
{

/**
     * @Rest\View()
     * @Rest\Get("/admin/listeTypeUtilisateur/{id_typeUtilisa}")
     */
   public function getTypeUtilisaAction($id_typeUtilisa){
        $typeUtil = $this->getDoctrine()->getRepository(TypeUtilisateur::class)->find($id_typeUtilisa);
        if(!$typeUtil){
            return new JsonRespons(['message'=>'Cette annonce n\'est pas enregister'], Response::HTTT_NOT_FOUND);
        }
        return $typeUtil;
    }

    /**
    * @Rest\View(statusCode=Response::HTTP_CREATED)
    * @Rest\Post("/admin/ajoutTypeUtilisateur")
    */
    public function postTypeUtilisaAction(Request $request)
    {
            
        $typeUtil = new TypeUtilisateur();
        //$form = $this->createForm(TypeUtilisateur::class, $typeUtil);

        //$form->submit($request->request->all());
        //if($form->isValid()){
        $typeUtil->setLibelleTypeUtilisa($request->get('libelleTypeUtilisa'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($typeUtil);
        $em->flush();
        return new JsonResponse(['message'=>'Ajout avec succès'], Response::HTTP_CREATED);
                
          /*  }
            else{
                return new JsonResponse(['message'=>'Vous n\'avez pas de compte'], Response::HTTP_NOT_FOUND);
            }*/
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/admin/supprimTypeUtilisateur/{id_typeUtilisa}")
    */

   public function removeTypeUtilisaAction($id_typeUtilisa){

        $em = $this->getDoctrine()->getManager();
        $typeUtil = $em->getRepository(TypeUtilisateur::class)->find($id_typeUtilisa);  
        $em->remove($typeUtil);
        $em->flush();
        return new JsonResponse(['message'=>'Suppression avec succès'], Response::HTTP_CREATED);
    }

     /**
     * @Rest\View()
     * @Rest\Put("/admin/modifierTypeUtilisateur/{id_typeUtilisa}")
    */

    public function updateVilleAction(Request $request, $id_typeUtilisa){

        
       	$em = $this->getDoctrine()->getManager();
        $typeUtil = $em->getRepository(TypeUtilisateur::class)->find($id_typeUtilisa);
		$typeUtil->setLibelleTypeUtilisa($request->get('libelleTypeUtilisa'));
        
        $em->persist($typeUtil);
        $em->flush();

        return new JsonResponse(['message'=>'Modification avec succès'], Response::HTTP_CREATED);
        
    }
 }
    

